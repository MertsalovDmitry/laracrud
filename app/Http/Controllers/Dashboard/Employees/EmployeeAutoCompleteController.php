<?php

namespace App\Http\Controllers\Dashboard\Employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;

class EmployeeAutoCompleteController extends Controller
{
    /**
    * Get the employee list for autocomplete
    *
    * @return \Illuminate\Http\Response
    */
    public function autocomplete(Request $request)
    {
        $data = Employee::select("id","name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);       
    }
}
