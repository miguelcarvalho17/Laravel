<?php

namespace App\Http\Controllers;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function validateJob(Request $request)
    {
        $array = array('title' => $request->title, 'typeJob' => $request->typeJob,'salary' => $request->salary, 'location' => $request->location,'content' => $request->job_content, 'logo' => $request->logo);
        return Validator::make($array, [
            'title' => ['required', 'string'],
            'typeJob' => ['required', 'string'],
            'salary' => ['required', 'string'],
            'location' => ['required', 'string'],
            'content' => ['required', 'string'],
            'logo' => ['required']
        ]);
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
            

            $query = User::where('id',Auth::id())->first();
            $job->contact = $query->email;
            $job->company_id = $query->id;
            $job->company = $query->name;

            $job->content = $request->job_content;
            $job->logo = file_get_contents($request->logo);
            $job->save();
        }
        return redirect('/form')->with('sucessInsert', 'Job inserted successfully');;
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
