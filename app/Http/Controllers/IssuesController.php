<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Issue;
use App\Models\IssueAssignee;
use App\Models\IssueOwner;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::with(['creator', 'owner', 'assignee', 'company'])->paginate(12);
        return view('pages.issues', compact('issues'));
    }

    public function issues()
    {
        $issues = Issue::with(['creator', 'owner', 'assignee', 'company'])->paginate(12);
        return view('pages.all_issues', compact('issues'));
    }

    public function create_page()
    {
        $sectors        = Sector::all();
        $owners         = IssueOwner::all();
        $assignees      = IssueAssignee::all();
        $companies      = Company::all();
        $scaleOption    = ['Low', 'Medium', 'High'];
        $statusOption   = ['On Process', 'Finished'];
        $azureOption    = ['Pending', 'Resolved', 'Closed', 'Not Listed'];
        return view('pages.add_issue', compact('sectors', 'owners', 'assignees', 'companies', 'scaleOption', 'statusOption', 'azureOption'));
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
        return view('pages.edit_issue', compact('issue', 'sectors', 'owners', 'assignees', 'companies', 'scaleOption', 'statusOption', 'azureOption'));
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
        return redirect()->route('issues')->with('message', 'Issue Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $issue = Issue::find($id);
            $issue->delete();
            return redirect()->route('issues')->with('message', 'Issue Updated Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }
}