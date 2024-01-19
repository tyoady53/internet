<?php

namespace App\Http\Controllers;

use App\Models\BenchMarkGroup;
use App\Models\BenchMarkQuestion;
use App\Models\QuickResponseQuestion;
use App\Models\RolePlayGroup;
use App\Models\RolePlayQuestion;
use App\Models\RolePlaySubGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rolename = '';
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        // $rolenames = $user->getRoleNames();
        // if(count($rolenames)){
        //     $rolename = $rolenames[0];
        // }
        return view('pages.dashboard',[
            'role'      => $rolename,
        ]);
    }
}
