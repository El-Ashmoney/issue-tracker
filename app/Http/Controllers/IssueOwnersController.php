<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\IssueOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueOwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issue_owners = IssueOwner::paginate(10);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.issue_owners', compact('issue_owners', 'sectors', 'sectorsWithEntities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $issue_owners = IssueOwner::find($id);
            $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
            return view('pages.edit_issue_owner', compact('issue_owners', 'sectorsWithEntities'));
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
            $issue_owners = IssueOwner::find($id);
            $issue_owners->owner_name = $request->owner_name;
            $issue_owners->save();
            return redirect()->route('issue_owners')->with('message', 'Issue Owner Updated Successfully');
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
            $issue_owners = IssueOwner::find($id);
            $issue_owners->delete();
            return redirect()->route('issue_owners')->with('message', 'Issue Owner Deleted Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }
}
