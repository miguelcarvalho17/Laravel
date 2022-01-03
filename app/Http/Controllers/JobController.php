<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function indexMainPage(Request $request) {

        $query = Job::query()
            ->where('is_active', true)
            ->latest();

        if ($request->has('s')) {
            $searchQuery = trim($request->get('s'));

            $query->where(function (Builder $builder) use ($searchQuery) {
                $builder
                    ->orWhere('title', 'like', "%{$searchQuery}%")
                    ->orWhere('company', 'like', "%{$searchQuery}%")
                    ->orWhere('location', 'like', "%{$searchQuery}%");
            });
        }

        $jobs = $query->get();

        return view('welcome', compact('jobs'));
    }

    public function validateJobOffer(Request $request)
    {
        $array = array('userId' => $request->userId, 'jobId' => $request->jobId,'offer_content' => $request->offer_content, 'cv' => $request->cv);
        $validator = Validator::make($array, [
            'userId' => ['required'],
            'jobId' => ['required'],
            'offer_content' => ['required', 'string'],
            'cv' => ['required']
        ]);
        return $validator;
    }

    public function store(Request $request){
        $validator = $this->validateJobOffer($request);
        if ($validator->fails()) {
            return redirect('/applyJob')->withErrors($validator)->withInput();
        }else {
            $jobOffer = new JobOffer();
            $job = Job::where('title', $request->jobId)->first();
            $jobOffer->jobId = $job->id;
            $jobOffer->userId= Auth::id();
            $jobOffer->content = $request->offer_content;
            $jobOffer->cv = file_get_contents($request->cv);
            $jobOffer->save();
        }
        return redirect('/applyJob');
    }

    public function create($id)
    {
        $job = Job::where('id', $id)->first();
        return view('applyJob')->with('job', $job);
    }

    public function show(Job $job)
    {
        return view('showJob', compact('job'));
    }
}
