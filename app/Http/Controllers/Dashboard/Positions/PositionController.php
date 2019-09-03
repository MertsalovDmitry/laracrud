<?php

namespace App\Http\Controllers\Dashboard\Positions;

use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Response;
use App\Http\Requests\Positions\StorePositionRequest;

class PositionController extends Controller
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
            return datatables()->of(Position::latest())
            ->addColumn('action', 'dashboard.action_button')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('dashboard.positions.index');
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
    public function store(StorePositionRequest $request)
    {
        $position = new Position;
        $position->name = $request->name;
        $position->save();

        return response()->json(['status'=>'success', 
                                 'msg'=>'Position created successfully.']);     
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
        $position  = Position::where($where)->first();

        return Response::json($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePositionRequest $request, $id)
    {
        $position = Position::find($id);
        if ($position->count()){
            $position->update($request->all());
            $position->save();
            return response()->json(['status'=>'success', 
                                    'msg'=>'Position updated successfully.']);
        }

        return response()->json(['status'=>'error','msg'=>'Error in updating Position']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::where('id', $id)->delete();  
        return response()->json(['status'=>'success','msg' =>'deleted']); 
    }                 
}
