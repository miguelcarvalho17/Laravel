<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Job;

class AdminController extends Controller {

 
    public function removeJob($id)
    {
        if ($id != null) {
            $job = Job::findOrFail($id);
            $job->delete();
            return redirect('/formEditRemove')->with('sucessRemove', 'Job Removed Sucessefully');
        }
        return redirect('/formEditRemove');
    }

    public function listJobs()
    {
        $jobs = Job::all();
        return view('/removeJob', ['jobs' => $jobs]);
    }

    public function editJobs(Request $request, $id) {
        $job = Job::findOrFail($id);
        $job->title = $request->title;
        $job->salary = $request->salary;
        $job->location = $request->location;
        $job->contact = $request->contact;

        if($request->picture != null) {
            $job->picture = file_get_contents($request->logo);
        }
        $job->save();
        return redirect('formEditRemove')->with('sucessRemove', 'jobs Edited Sucessefully');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin()
    {
        return view('admin');
    }

}
