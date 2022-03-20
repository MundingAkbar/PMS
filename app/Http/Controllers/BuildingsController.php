<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Models\Buildings;
use DB;
use DataTables;

class BuildingsController extends Controller
{
    public function index(){
        $distinct_locations = DB::table('buildings')->distinct()->get(['location']);
        $distinct_how_acquired = DB::table('buildings')->distinct()->get(['how_acquired']);
        return view('properties.buildings',[
            'distinct_locations'=>$distinct_locations,
            'distinct_how_acquired'=>$distinct_how_acquired,
        ]);
    }
    // ======================================================
    // function for fetching data live
        // get office list display to table
        public function getBuildingsList(){
            $buildings = Buildings::all();

            return DataTables::of($buildings)
                            // ->addIndexColumn()
                            ->addColumn('action', function($row){})
                            ->rawColumns(['action'])
                            ->make(true);
        }
    // function for adding equipment
    public function store(Request $request){

    $validator = Validator::make($request->all(),[
        'name_of_building'=>'required|max:191',
        'area_acquired'=>'required|max:191',
        'make'=>'required|max:191',
        'number_of_floors'=>'required|max:191',
        'total_floor_area'=>'required|max:191',
        'condition'=>'required|max:191',
        'current_use'=>'required|max:191',
        'cost'=>'required|max:191',
    ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>400,
            'errors'=>$validator->messages(),
        ]);
    }else{
        try{
            $building = new Buildings();
            $building->name_of_building = $request->input('name_of_building');
            $building->area_acquired = $request->input('area_acquired');
            $building->location = $request->input('location');
            $building->make = $request->input('make');
            $building->num_of_floors = $request->input('number_of_floors');
            $building->total_floor_area = $request->input('total_floor_area');
            $building->condition = $request->input('condition');
            $building->current_use = $request->input('current_use');
            $building->num_of_rooms = $request->input('num_of_rooms');
            $building->date_constructed = $request->input('date_constructed');
            $building->how_acquired = $request->input('how_acquired');
            $building->cost = $request->input('cost');
            $building->save();

            return response()->json([
                'status'=>200,
                'message'=>'New Building Added Successfully...',
            ]);
        }catch(QueryException $ex){
            return response()->json([
                'status'=>500,
                'message'=>$ex->getMessage(),
            ]);
        }
    }
}
     // ===============================================
    // fetching data to and return to edit modal
    public function edit($id){

        $building = Buildings::find($id);

        if($building){
            return response()->json([
                'status'=>200,
                'building'=>$building,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Building Not Found... :(',
            ]);
        }
    }
    // updating the data
    public function update(Request $request, $id){
    
        $building = Buildings::find($id);
        
        if($building){

            try{
                $building->name_of_building = $request->input('name_of_building');
                $building->area_acquired = $request->input('area_acquired');
                $building->location = $request->input('location');
                $building->make = $request->input('make');
                $building->num_of_floors = $request->input('num_of_floors');
                $building->total_floor_area = $request->input('total_floor_area');
                $building->condition = $request->input('condition');
                $building->current_use = $request->input('current_use');
                $building->num_of_rooms = $request->input('num_of_rooms');
                $building->date_constructed = $request->input('date_constructed');
                $building->how_acquired = $request->input('how_acquired');
                $building->cost = $request->input('cost');
                $building->update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Building Updated Successfully... :)'
                ]);
            }catch(QueryException $ex){
                return response()->json([
                    'status'=>404,
                    'message'=>'Something went wrong when saving data..',
                ]);
            }
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Building Not Found... :(',
            ]);
        }
    }
    // Deleting data
    public function destroy($id){
        $building = Buildings::find($id);

        if($building){
            $building->delete();
            
            return response()->json([
                'status'=>200,
                'message'=>'Building Record Deleted... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Building Not Found... :(',
            ]);
        }
    }
}
