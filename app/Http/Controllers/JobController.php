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
                    ->orWhere('location', 'like', "%{$searchQuery}%")
                    ->orWhere('typeJob', 'like', "%{$searchQuery}%");
            });
        }

        $jobs = $query->get();

        return view('welcome', compact('jobs'));
    }

    public function validateJobOffer(Request $request)
    {
        $array = array('userId' => $request->userId, 'jobId' => $request->jobId,'nameUser' => $request->nameUser, 'offer_content' => $request->offer_content, 'cv' => $request->cv);
        $validator = Validator::make($array, [
            'userId' => ['required'],
            'jobId' => ['required'],
            'nameUser' => ['required'],
            'offer_content' => ['required', 'string'],
            'cv' => ['required|mimes:pdf|max:2000'],
        ]);
        return $validator;
    }

    public function store(Request $request){

            $jobOffer = new JobOffer();
            $job = Job::where('title', $request->jobId)->first();
            $jobOffer->idJob = $job->id;
            $jobOffer->idUser= Auth::id();
            $jobOffer->nameUser = User::where('id', Auth::id())->value('name');
            $jobOffer->content = $request->offer_content;
            $jobOffer->cv = file_get_contents($request->cv);
            $jobOffer->save();
            return redirect('/');
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
