<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function validateJob(Request $request)
    {
            $array = array('title' => $request->title, 'company' => $request->company, 'location' => $request->location, 'content' => $request->job_content, 'picture' => $request->picture);
            $validator = Validator::make($array, [
                'title' => ['required', 'string'],
                'company' => ['required', 'string'],
                'location' => ['required', 'string'],
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
            $job->company = $request->company;
            $job->location = $request->location;
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
