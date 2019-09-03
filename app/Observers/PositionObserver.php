<?php

namespace App\Observers;

use App\Position;
use Illuminate\Support\Facades\Auth;

class PositionObserver
{
    /**
     * Handle the position "creating" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function creating(Position $position)
    {
        if (Auth::check()) {
            $userID = Auth::id();
            $position->admin_created_id = $userID;
            $position->admin_updated_id = $userID;
        }
    }

    /**
     * Handle the position "created" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function created(Position $position)
    {
        //
    }
  
    /**
     * Handle the position "updating" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function updating(Position $position)
    {
        if (Auth::check()) {
            $position->admin_updated_id = Auth::id();
        }
    }

    /**
     * Handle the position "updated" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function updated(Position $position)
    {
        //
    }

    /**
     * Handle the position "deleted" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function deleted(Position $position)
    {
        //
    }

    /**
     * Handle the position "restored" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function restored(Position $position)
    {
        //
    }

    /**
     * Handle the position "force deleted" event.
     *
     * @param  \App\Position  $position
     * @return void
     */
    public function forceDeleted(Position $position)
    {
        //
    }
}
