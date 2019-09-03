<?php

namespace App\Http\Controllers\Dashboard\Positions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Position;

class PositionListController extends Controller
{
    /**
    * Get the list of positions.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response $position list
    */
    public function list(Request $request)
    {
        $positions = [];

        if($request->has('q')) {
            $search = $request->q;
            $positions = Position::where('name','LIKE',"%$search%")->get();
        }
        else 
            $positions = Position::all();

        return response()->json($positions);
    }
}
