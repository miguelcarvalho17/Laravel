<?php

namespace App\Http\Controllers;
use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Job;

class AdminController extends Controller {

    public function removeJob($id)
    {
        if ($id != null) {
            $job = Job::findOrFail($id);
            $job->delete();
            return redirect('/removeJobAdmin')->with('sucessRemove', 'Job Removed Sucessefully');
        }
        return redirect('/removeJobAdmin');
    }

    public function listJobs()
    {
        $jobs = Job::all();
        return view('/removeJobAdmin', ['jobs' => $jobs]);
    }

    public function rejectJob($id)
    {
        $job = Job::findOrFail($id);
        if ($job->is_active == 0) {
            $job->update(['is_active' => 1]);
            $job->save();
            return redirect('/formAdmin')->with('sucessRemove', 'Job status Updated Sucessefully');
        }
            $job->update(['is_active' => 0]);
            $job->save();
            return redirect('/formAdmin')->with('sucessRemove', 'Job status Updated Sucessefully');
    }

    public function showJobs(Request $request) {

        $query = Job::query()
            ->latest();
        $jobs = $query->get();
        return view('formAdmin', compact('jobs'));
    }

    public function setAdmin($id){
        $user = User::findOrFail($id);
            $user->update(['type' => 'admin']);
            $user->save();
            return redirect('/admin/home');
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
            $user->delete();
            if ($user->type === 'company') {
                $jobs = Job::where('company_id', $user->id)->get();
                foreach ($jobs as $job) {
                    if (JobOffer::where('idJob', $job->id)->exists()) {
                        $jobOffers = JobOffer::where('idJob', $job->id)->get();
                        foreach ($jobOffers as $jobOffer) {
                            $jobOffer->delete();
                        }
                    }
                    $job->delete();
                }
                return redirect('/admin/home');
            }
                $jobOffers = JobOffer::where('idUser', $user->id);
                foreach ($jobOffers as $jobOffer){
                    $jobOffer->delete();
                }
            return redirect('/admin/home');
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
