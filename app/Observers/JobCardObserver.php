<?php

namespace App\Observers;

use App\Models\JobCard;
use Illuminate\Support\Facades\Auth;

class JobCardObserver
{
    public function created(JobCard $jobCard): void
    {

    }

    public function updated(JobCard $jobCard): void
    {
    }

    public function deleted(JobCard $jobCard): void
    {
        $jobCard->user_id = Auth::id();
        $jobCard->save();
    }

    public function restored(JobCard $jobCard): void
    {
    }

    public function forceDeleted(JobCard $jobCard): void
    {
    }
}
