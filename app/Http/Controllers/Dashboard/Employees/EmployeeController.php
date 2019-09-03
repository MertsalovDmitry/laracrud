<?php

namespace App\Http\Controllers\Dashboard\Employees;

use App\Http\Controllers\Controller;
use App\Employee;
use App\EmployeeUploadImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Response;
use App\Http\Requests\Employees\StoreEmployeeRequest;
use App\Http\Requests\Employees\UpdateEmployeeRequest;
use Image;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        if(request()->ajax()) {
            return datatables()->of(Employee::latest()->with('position', 'adminCreated', 'adminUpdated', 'head'))
            ->addColumn('action', 'dashboard.action_button')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('dashboard.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {        
        $data = $request->all();
        if ($file = $request->file('photo')) {
            $uploadImage = new EmployeeUploadImage($file);
            $uploadImage->upload();
            $data['photo'] = $uploadImage->getName();
        }
        $parent = Employee::find($request->parent_id);
        $employee = Employee::create($data);
        $parent->appendNode($employee);

        // Employee::fixTree();
        return response()->json(['status'=>'success', 
                                 'msg'=>'Employee created successfully.']); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $employee  = Employee::where($where)->with('position', 'adminCreated', 'adminUpdated', 'head')->first();
     
        return Response::json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee->count()){
            $data = $request->all();
            if ($file = $request->file('photo')) { 
                $uploadImage = new EmployeeUploadImage($file);
                $uploadImage->upload();
                $data['photo'] = $uploadImage->getName();
            }
            $employee->update($data);
            $employee->save();
            $parent = Employee::find($request->parent_id);
            $parent->appendNode($employee);
            // Employee::fixTree();
            return response()->json(['status'=>'success', 
                                    'msg'=>'Employee updated successfully.']);
        }

        return response()->json(['status'=>'error','msg'=>'Error in updating Employee']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->delete();
 
        return Response::json($employee);
    }
}
