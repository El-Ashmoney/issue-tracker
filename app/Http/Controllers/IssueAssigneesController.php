<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use App\Models\IssueAssignee;
use Illuminate\Support\Facades\Auth;

class IssueAssigneesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issue_assignees = IssueAssignee::paginate(12);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.issue_assaignees', compact('issue_assignees', 'sectors', 'sectorsWithEntities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $issue_assignee = IssueAssignee::find($id);
            $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
            return view('pages.edit_issue_assignee', compact('issue_assignee', 'sectorsWithEntities'));
        } else {
            abort(403, 'Unauthorized Access');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $issue_assignee = IssueAssignee::find($id);
            $issue_assignee->assignee_name = $request->assignee_name;
            $issue_assignee->save();
            return redirect()->route('issue_assignees')->with('message', 'Issue Assignee Updated Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $issue_assignee = IssueAssignee::find($id);
            $issue_assignee->delete();
            return redirect()->route('issue_assignees')->with('message', 'Issue Assignee Deleted Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }
}
