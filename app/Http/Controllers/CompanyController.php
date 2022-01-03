<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function validateJob(Request $request)
    {
        $array = array('title' => $request->title, 'typeJob' => $request->typeJob,'salary' => $request->salary, 'location' => $request->location, 'contact' => $request->contact,'content' => $request->job_content, 'logo' => $request->logo);
        $validator = Validator::make($array, [
            'title' => ['required', 'string'],
            'typeJob' => ['required', 'string'],
            'salary' => ['required', 'string'],
            'location' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'content' => ['required', 'string'],
            'logo' => ['required']
        ]);
        return $validator;
    }

    public function store(Request $request)
    {
        $validator = $this->validateJob($request);
        if ($validator->fails()) {
            return redirect('/form')->withErrors($validator)->withInput();
        } else {
            $job = new Job();
            $job->title = $request->title;
            $job->typeJob = $request->typeJob;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->contact = $request->contact;

            $query =  User::where('email', $job->contact)->first();

            $job->company_id = $query->id;
            $job->company = $query->name;

            $job->content = $request->job_content;
            $job->logo = file_get_contents($request->logo);
            $job->save();
        }
        return redirect('/form');
    }

    public function removeJob($id)
    {
        if ($id != null) {
            $job = Job::findOrFail($id);
            $job->delete();
            return redirect('/formEditRemoveCompany')->with('sucessRemove', 'Job Removed Sucessefully');
        }
        return redirect('/formEditRemoveCompany');
    }

    public function listJobs()
    {
        $jobs = Job::where('company_id', Auth::id())->get();
        return view('/removeJob', ['jobs' => $jobs]);
    }

    public function editJobs(Request $request, $id) {
        $job = Job::findOrFail($id);
        $job->title = $request->title;
        $job->salary = $request->salary;
        $job->location = $request->location;
        // $job->contact = $request->contact;

        if($request->logo != null) {
            $job->logo = file_get_contents($request->logo);
        }
        $job->save();
        return redirect('formEditRemoveCompany')->with('sucessRemove', 'jobs Edited Sucessefully');
    }

    public function create()
    {
        return view('form');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function company()
    {
        return view('company');
    }

}
