<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.users',compact('users'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::user()->role === 'Admin'){
            $user = User::find($id);
            return view('pages.edit_user', compact('user'));
        }else{
            abort(403, 'Unauthorized Access');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Auth::user()->role === 'Admin'){
            $user = User::find($id);
            $user->username = $request->username;
            $user->role     = $request->role;
            $user->save();
            return redirect()->route('users')->with('message', 'User Updated Successfully');
        }else{
            abort(403, 'Unauthorized Access');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->role === 'Admin'){
            $user = User::find($id);
            $user->delete();
            return redirect()->route('users')->with('message', 'User Deleted Successfully');
        }else{
            abort(403, 'Unauthorized Access');
        }
    }
}