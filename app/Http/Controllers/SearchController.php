<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Sector;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'sector_id' => 'required|exists:sectors,id',
        ]);

        $query = $request->input('query');
        $sectorId = $validated['sector_id'];

        // Build the query using conditional clauses
        $issues = Issue::when($query, function ($q) use ($query) {
            return $q->where('issue_description', 'like', '%' . $query . '%');
        })
        ->when($sectorId, function ($q) use ($sectorId) { // Use $sectorId directly
            return $q->where('sector_id', $sectorId);
        })
        ->get();

        // Redirect to a form pre-filled with the query and selected sector if no issues found
        if ($issues->isEmpty() && $query) {
            return redirect()->route('add_searched_issue_page', ['query' => $query, 'sector_id' => $sectorId]);
        }

        // Prepare sectors for dropdown in search results page
        $sectors = Sector::all();
        return view('pages.search_results', compact('issues', 'sectors', 'query', 'sectorId'));
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