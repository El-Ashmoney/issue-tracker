<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $issues_count = Issue::count();
        // $my_issues_count = Issue::where('created_by', Auth::user()->id)->count();
        $issues = Issue::with(['creator', 'owner', 'assignee', 'company'])->paginate(12);
        return view('pages.issues', compact('issues'));
    }

    public function issues()
    {
        // $issues_count = Issue::count();
        // $my_issues_count = Issue::where('created_by', Auth::user()->id)->count();
        $issues = Issue::with(['creator', 'owner', 'assignee', 'company'])->paginate(12);
        return view('pages.all_issues', compact('issues'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}