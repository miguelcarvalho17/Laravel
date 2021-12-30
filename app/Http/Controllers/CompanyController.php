<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function validateJob(Request $request)
    {
            $array = array('title' => $request->title, 'salary' => $request->salary, 'location' => $request->location, 'contact' => $request->contact,'content' => $request->job_content, 'picture' => $request->picture);
            $validator = Validator::make($array, [
                'title' => ['required', 'string'],
                'salary' => ['required', 'string'],
                'location' => ['required', 'string'],
                'contact' => ['required', 'string'],
                'content' => ['required', 'string'],
                'picture' => ['required']
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
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->contact = $request->contact;

            $query =  User::where('email', $job->contact)->first();
          
            $job->company_id = $query->id;
            $job->company = $query->name;

            $job->content = $request->job_content;
            $job->logo = file_get_contents($request->picture);
            $job->save();
        }
        return redirect('/form');
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
