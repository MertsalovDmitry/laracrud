<?php

namespace App\Observers;

use App\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeObserver
{    
    /**
     * Handle the employee "creating" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function creating(Employee $employee)
    {
        if (Auth::check()) {
            $userID = Auth::id();
            $employee->admin_created_id = $userID;
            $employee->admin_updated_id = $userID;
        }
    }

    /**
     * Handle the employee "created" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        // Employee::fixTree();
    }
    
    /**
     * Handle the employee "updating" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function updating(Employee $employee)
    {
        if (Auth::check()) {
            $employee->admin_updated_id = Auth::id();
        }
    }


    /**
     * Handle the employee "updated" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
    }

    /**
     * Handle the employee "deleted" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        // Employee::fixTree();
    }

    /**
     * Handle the employee "restored" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        // Employee::fixTree();
    }

    /**
     * Handle the employee "deleting" event.
     *
     * @param  \App\Employee  $post
     * @return void
     */
    public function deleting(Employee $employee)
    {
        $parentID = $employee->head()->id;
            $employees = Employee::where('parent_id', $employee->id)
            ->update('parent_id', $parentID);
    }


    /**
     * Handle the employee "force deleted" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }
}
