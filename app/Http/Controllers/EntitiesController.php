<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->role === 'Admin') {
            abort(403, 'Unauthorized Access');
        } else {
            $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
            return view('pages.add_entity', compact('sectorsWithEntities'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $entity = new Entity;
        $entity->name = $request->name;
        $entity->save();
        return redirect()->route('show_entity', ['id' => $entity->id])->with('message', 'Entity Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entity = Entity::findOrFail($id);
        $sectors = $entity->sectors()->paginate(10);
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.show_entity', compact('entity', 'sectors', 'sectorsWithEntities'));
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
