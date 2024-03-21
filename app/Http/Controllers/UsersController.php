<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(12);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        return view('pages.users', compact('users', 'sectors', 'sectorsWithEntities'));
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
            $user = User::find($id);
            $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
            return view('pages.edit_user', compact('user', 'sectorsWithEntities'));
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
            $user = User::find($id);
            $user->username = $request->username;
            $user->role     = $request->role;
            $user->save();
            return redirect()->route('users')->with('message', 'User Updated Successfully');
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
            $user = User::find($id);
            $user->delete();
            return redirect()->route('users')->with('message', 'User Deleted Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }
}