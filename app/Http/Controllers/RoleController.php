<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()){
            $user_id = auth()->user()->id;
        }
        $user = User::where('id',$user_id)->first();
        $rolenames = $user->getRoleNames();
        $roles = Role::with('permissions')->get();
        // dd($roles);

            return view('pages.roles.index',[
                'data'      => $roles,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.roles.create',[
            'user'      => [],
            'roles'     => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $insert = Role::create([
            'name'      => $request->rolename,
            'guard_name'=> 'web'
        ]);

        return redirect('role/index');
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
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        $permission_array = array();
        foreach($role->permissions as $permission){
            $permission_array[] = $permission->id;
        }

        return view('pages.roles.edit',[
            'role'          => $role,
            'permissions'   => $permissions,
            'permission_array'  => $permission_array,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request,$id);
        $role = Role::where('id',$id)->first();
        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
