<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Issue;
use App\Models\Sector;
use App\Models\Company;
use App\Models\IssueOwner;
use Illuminate\Http\Request;
use App\Models\IssueAssignee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::where('created_by', Auth::id())->with(['creator', 'owner', 'assignee', 'company'])->paginate(12);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.issues', compact('issues', 'sectors', 'sectorsWithEntities'));
    }

    public function issues()
    {
        $issues = Issue::with(['creator', 'owner', 'assignee', 'company'])->paginate(12);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.all_issues', compact('issues', 'sectors', 'sectorsWithEntities'));
    }

    public function create_page()
    {
        $owners         = IssueOwner::all();
        $assignees      = IssueAssignee::all();
        $companies      = Company::all();
        $scaleOption    = ['Low', 'Medium', 'High'];
        $statusOption   = ['Pending', 'On Process', 'Finished'];
        $azureOption    = ['Pending', 'Resolved', 'Closed', 'Not Listed'];
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.add_issue', compact('owners', 'assignees', 'companies', 'scaleOption', 'statusOption', 'azureOption', 'sectorsWithEntities'));
    }

    public function createFromSearch(Request $request)
    {
        $sectors        = Sector::all();
        $owners         = IssueOwner::all();
        $assignees      = IssueAssignee::all();
        $companies      = Company::all();
        $scaleOption    = ['Low', 'Medium', 'High'];
        $statusOption   = ['Pending', 'On Process', 'Finished'];
        $azureOption    = ['Pending', 'Resolved', 'Closed', 'Not Listed'];

        $query = $request->input('query');
        $selectedSectorId = $request->input('sector_id');

        // Fetch sectors for dropdown
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        // Return the view with optional pre-filled data
        return view('pages.add_searched_issue_page', compact('sectors', 'query', 'selectedSectorId', 'owners', 'assignees', 'companies', 'scaleOption', 'statusOption', 'azureOption', 'sectorsWithEntities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'issue_description' => 'required|string|max:255',
            'sector_id'         => 'required|exists:sectors,id',
            'owner_id'          => 'required|exists:issue_owners,owner_id',
            'assignee_id'       => 'required|exists:issue_assignees,assignee_id',
            'company_id'        => 'required|exists:companies,company_id',
            'scale'             => 'required',
            'status'            => 'required',
            'azure_status'      => 'required',
        ]);
        $issue = new Issue;
        $issue->issue_description = $request->issue_description;
        $issue->created_by        = Auth::id();
        $issue->sector_id         = $request->sector_id;
        $issue->owner_id          = $request->owner_id;
        $issue->assignee_id       = $request->assignee_id;
        $issue->company_id        = $request->company_id;
        $issue->scale             = $request->scale;
        $issue->time_duration     = $request->time_duration;
        $issue->status            = $request->status;
        $issue->azure_status      = $request->azure_status;
        $issue->save();
        return redirect()->route('issues')->with('message', 'Issue Added Successfully');
    }

    public function exportIssues()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headings
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Created By');
        $sheet->setCellValue('C1', 'Issue Description');
        $sheet->setCellValue('D1', 'Sector');
        $sheet->setCellValue('E1', 'Issue Owner');
        $sheet->setCellValue('F1', 'Issue Assignee');
        $sheet->setCellValue('G1', 'Company');
        $sheet->setCellValue('H1', 'Scale');
        $sheet->setCellValue('I1', 'Time Duration');
        $sheet->setCellValue('J1', 'Created At');
        $sheet->setCellValue('K1', 'Issue Status');
        $sheet->setCellValue('L1', 'Azure Status');

        $headingStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF002060',
                ],
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
        ];
        $sheet->getStyle('A1:L1')->applyFromArray($headingStyle);

        // Retrieve issues from database
        $issues = Issue::with(['creator', 'owner', 'assignee', 'company', 'sector'])->get();
        $row = 2;

        // Iterate through the issues to fill the spreadsheet
        foreach ($issues as $issue) {
            $sheet->setCellValue('A' . $row, $issue->issue_id);
            $sheet->setCellValue('B' . $row, $issue->creator->username);
            $sheet->setCellValue('C' . $row, $issue->issue_description);
            $sheet->setCellValue('D' . $row, $issue->sector->name);
            $sheet->setCellValue('E' . $row, $issue->owner->owner_name);
            $sheet->setCellValue('F' . $row, $issue->assignee->assignee_name);
            $sheet->setCellValue('G' . $row, $issue->company->company_name);
            $sheet->setCellValue('H' . $row, $issue->scale);
            $sheet->setCellValue('I' . $row, $issue->time_duration);
            $sheet->setCellValue('J' . $row, $issue->created_at ? $issue->created_at->format('Y-m-d') : '');
            $sheet->setCellValue('K' . $row, $issue->status);
            $sheet->setCellValue('L' . $row, $issue->azure_status);
            $row++;
        }

        // Redirect output to a client’s web browser (Excel5)
        $writer = new Xlsx($spreadsheet);

        $fileName = "issues_export_" . date('Ymd') . ".xlsx";
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create a StreamedResponse to download file
        $response = new StreamedResponse(
            function () use ($writer, $temp_file) {
                $writer->save($temp_file);
                readfile($temp_file);
                unlink($temp_file);
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $issue          = Issue::find($id);
        $sectors        = Sector::all();
        $owners         = IssueOwner::all();
        $assignees      = IssueAssignee::all();
        $companies      = Company::all();
        $scaleOption    = ['Low', 'Medium', 'High'];
        $statusOption   = ['On Process', 'Finished'];
        $azureOption    = ['Pending', 'Resolved', 'Closed', 'Not Listed'];
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.edit_issue', compact('issue', 'sectors', 'owners', 'assignees', 'companies', 'scaleOption', 'statusOption', 'azureOption', 'sectorsWithEntities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'issue_description' => 'required|string|max:255',
            'sector_id'         => 'required|exists:sectors,id',
            'owner_id'          => 'required|exists:issue_owners,owner_id',
            'assignee_id'       => 'required|exists:issue_assignees,assignee_id',
            'company_id'        => 'required|exists:companies,company_id',
            'scale'             => 'required',
            'status'            => 'required',
            'azure_status'      => 'required',
        ]);
        $issue = Issue::findOrFail($id);
        if ($request->status === 'Finished' && is_null($issue->resolved_at)) {
            $issue->resolved_at = now();
        }
        $issue->issue_description = $request->issue_description;
        $issue->sector_id         = $request->sector_id;
        $issue->owner_id          = $request->owner_id;
        $issue->assignee_id       = $request->assignee_id;
        $issue->company_id        = $request->company_id;
        $issue->scale             = $request->scale;
        $issue->time_duration     = $request->time_duration;
        $issue->status            = $request->status;
        $issue->azure_status      = $request->azure_status;
        $issue->save();
        return redirect()->route('issues')->with('message', 'Issue updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $issue = Issue::find($id);
            $issue->delete();
            return redirect()->route('issues')->with('message', 'Issue deleted successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }
}
