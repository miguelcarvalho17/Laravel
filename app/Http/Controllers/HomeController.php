<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function companyHome(){
        $jobs = Job::where('company_id', Auth::id())->get();
        return view('companyHome')->with('jobs', $jobs);
    }

    public function adminHome(){
        $users = User::where('type', 'user')->get();
        return view('adminHome')->with('users', $users);
    }
}
