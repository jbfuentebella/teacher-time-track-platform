<?php

namespace App\Observers;

use App\Log;

class LogObserver
{
    /**
     * Handle the log "creating" event.
     *
     * @param  \App\Log $log
     * @return void
     */
    public function creating(Log $log)
    { 
        $log->account_id = auth()->user()->id;
        $log->login_dt = date('Y-m-d');
        $log->login_time = date('H:i:s');
        $log->status = Log::STATUS_CLOCK_IN;
        $log->slug = Log::generateUniqueSlug();
    }

    /**
     * Handle the log "created" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function created(Log $log)
    {
        //
    }

    /**
     * Handle the log "updated" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function updated(Log $log)
    {
        //
    }

    /**
     * Handle the log "deleted" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function deleted(Log $log)
    {
        //
    }

    /**
     * Handle the log "restored" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function restored(Log $log)
    {
        //
    }

    /**
     * Handle the log "force deleted" event.
     *
     * @param  \App\Log  $log
     * @return void
     */
    public function forceDeleted(Log $log)
    {
        //
    }
}
