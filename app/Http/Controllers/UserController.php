<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id','!=',1)->with('roles')->get();

        return view('pages.users.index',[
            'user'      => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles  = Role::get();
        return view('pages.users.create',[
            'user'      => [],
            'roles'     => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pwd    = bcrypt('secret');
        $this->validate($request, [
            'email'     =>  'required|unique:users',
        ]);

        $insert = User::create([
            'name'          => $request->name,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'username'      => $request->email,
            'active'        => '1',
            'password'      => 'secret',
            'encrypted_id'  => '-'
        ]);

        // dd('insert->id '.$insert->id,$insert->id.Carbon::now(),'md5 Now'.md5(Carbon::now()),'md5 uniq '.md5($insert->id.Carbon::now()));

        $encrypted_id   = md5($insert->id.Carbon::now());

        if($insert){
            $insert->update(['encrypted_id'  => $encrypted_id]);
        }
        $insert->syncRoles($request->roles);
        // $insert->assignRole($request->roles);

        return redirect('user/index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // dd($slug);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $user   = User::where('encrypted_id',$slug)->with('roles')->first();
        $roles  = Role::get();
        return view('pages.users.edit',[
            'user'      => $user,
            'roles'     => $roles,
        ]);
        // dd($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // dd($request,$slug);
        $user   = User::where('encrypted_id',$slug)->with('roles')->first();
        $user->update([
            'gender'    => $request->gender,
            'name'      => $request->name,
        ]);
        $user->syncRoles($request->roles);

        return redirect('user/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
