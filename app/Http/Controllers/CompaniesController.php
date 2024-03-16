<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'Admin') {
            $companies = Company::all();
            return view('pages.companies', compact('companies'));
        } else {
            abort(403, 'Unauthorized Access');
        }
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
        $companies = Company::find($id);
        return view('pages.edit_company', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role === 'Admin') {
            $companies = Company::find($id);
            $companies->company_name = $request->company_name;
            $companies->save();
            return redirect()->route('companies')->with('message', 'Company Updated Successfully');
        } else {
            abort(403, 'Unauthorized Access');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->role === 'Admin'){
            $companies = Company::find($id);
            $companies->delete();
            return redirect()->route('companies')->with('message', 'Company Deleted Successfully');
        }else{
            abort(403, 'Unauthorized Access');
        }
    }
}