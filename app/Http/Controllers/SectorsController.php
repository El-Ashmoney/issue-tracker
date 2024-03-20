<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $sectors = Sector::with('entity')->findOrFail($id);
            $entityId = $sectors->entity_id;
            return view('pages.edit_sector', compact('sectors', 'entityId'));
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
            $sector = Sector::find($id);
            $sector->name = $request->sector_name;
            $sector->save();
            $entityId = $sector->entity->id;
            return redirect()->route('show_entity', $entityId)->with('message', 'Sector Updated Successfully');
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
            $sector = Sector::find($id);
            $sector->delete();
            $entityId = $sector->entity->id;
            return redirect()->route('show_entity', $entityId)->with('message', 'Sector Deleted Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }
}
