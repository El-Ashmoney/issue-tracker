<?php

namespace App\Http\Controllers;

use App\Models\Entity;
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

    public function create(Request $request)
    {
        if (!Auth::user()->role === 'Admin') {
            abort(403, 'Unauthorized Access');
        }

        $entityId = $request->query('entity_id');
        if ($entityId) {
            session(['last_selected_entity_id' => $entityId]);
        } else {
            $entityId = session('last_selected_entity_id', null);
        }

        $entity = null;
        if ($entityId) {
            $entity = Entity::find($entityId);
        }

        $entities = Entity::all(); // Assuming you want to list all entities in the dropdown
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.add_sector_page', compact('entities', 'entity', 'sectorsWithEntities'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->role === 'Admin') {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'entity_id' => 'required|exists:entities,id',
            'name' => 'required|string|max:255',
        ]);

        $sector = new Sector;
        $sector->entity_id = $request->entity_id;
        $sector->name = $request->name;
        $sector->save();

        return redirect()->route('show_entity', ['id' => $sector->entity_id])->with('message', 'Sector Added Successfully');
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
            $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
            return view('pages.edit_sector', compact('sectors', 'entityId', 'sectorsWithEntities'));
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
