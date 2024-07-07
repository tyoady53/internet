<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()){
            $user_id = auth()->user()->id;
        }
        $permissions = Permission::get();
        // dd($permissions);

        return view('pages.permissions.index',[
            'data'      => $permissions,
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
        // dd($request);
        if($request){
            Permission::create([
                'name'  => $request->permission_name,
                'guard' => 'web'
            ]);

            return redirect('permissions/index')->with('success','created');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($permission)
    {
        // $role = Permission::with('permissions')->findOrFail($id);
        // $permissions = Permission::all();
        // $permission_array = array();
        // foreach($role->permissions as $permission){
        //     $permission_array[] = $permission->id;
        // }

        // return view('pages.roles.edit',[
        //     'role'          => $role,
        //     'permissions'   => $permissions,
        //     'permission_array'  => $permission_array,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permission)
    {
        //
    }
}
