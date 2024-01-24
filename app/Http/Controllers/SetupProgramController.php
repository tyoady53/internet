<?php

namespace App\Http\Controllers;

use App\Models\SetupProgram;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class SetupProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = SetupProgram::where('id',1)->first();
        dd($user);

        return view('pages.setup',[
            'user'      => $user,
        ]);
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
    public function show(SetupProgram $setupProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SetupProgram $setupProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SetupProgram $setupProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SetupProgram $setupProgram)
    {
        //
    }
}
