<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Landholdings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use DB;
use DataTables;

class LandholdingsController extends Controller
{
    public function index(){
        $distinct_locations = DB::table('landholdings')->distinct()->get(['location']);
        $distinct_how_acquired = DB::table('landholdings')->distinct()->get(['how_acquired']);
        $distinct_utilization = DB::table('landholdings')->distinct()->get(['current_utilization']);

        return view('properties.landholdings',[
            'distinct_locations'=>$distinct_locations,
            'distinct_how_acquired'=>$distinct_how_acquired,
            'distinct_utilization'=>$distinct_utilization,
        ]);
    }
    // function for adding equipment
    public function store(Request $request){

    $validator = Validator::make($request->all(),[
        // 'property_number'=>'required|max:191',
        // 'units'=>'required|max:191',
        // 'unit_value'=>'required|max:191',
    ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>400,
            'errors'=>$validator->messages(),
        ]);
    }else{
        try{
            $landholding = new Landholdings();
            $landholding->lot_number = $request->input('lot_number');
            $landholding->classification = $request->input('classification')=='NULL'?NULL:$request->input('classification');;
            $landholding->location = $request->input('location');
            $landholding->date_acquired = $request->input('date_acquired');
            $landholding->how_acquired = $request->input('how_acquired')=='NULL'?NULL:$request->input('how_acquired');;
            $landholding->is_titled = $request->input('is_titled')=='NULL'?NULL:$request->input('is_titled');;
            $landholding->total_area = $request->input('total_area');
            $landholding->area_type = $request->input('area_type');
            $landholding->current_utilization = $request->input('current_utilization')=='NULL'?NULL:$request->input('current_utilization');
            $landholding->save();

            return response()->json([
                'status'=>200,
                'message'=>'Land-holding Added Successfully...',
            ]);
        }catch(QueryException $ex){
            return response()->json([
                'status'=>500,
                'message'=>$ex->getMessage(),
            ]);
        }
    }
}
// ======================================================
// function for fetching data live
    // get office list display to table
    public function getLandholdingsList(){
        $landholdings = Landholdings::all();
        return DataTables::of($landholdings)
                        // ->addIndexColumn()
                        ->addColumn('action', function($row){})
                        ->rawColumns(['action'])
                        ->make(true);
    }
           // ===============================================
    // fetching data to and return to response modal
    public function edit($id){

        $landholding = Landholdings::find($id);

        if($landholding){
            return response()->json([
                'status'=>200,
                'landholding'=>$landholding,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Land holding Not Found... :(',
            ]);
        }
    }
      // updating the data
      public function update(Request $request, $id){
        
        $landholding = Landholdings::find($id);
        
        if($landholding){

            try{
                $landholding->lot_number = $request->input('lot_number');
                $landholding->classification = $request->input('classification')=='NULL'?NULL:$request->input('classification');;
                $landholding->location = $request->input('location');
                $landholding->date_acquired = $request->input('date_acquired');
                $landholding->how_acquired = $request->input('how_acquired')=='NULL'?NULL:$request->input('how_acquired');;
                $landholding->is_titled = $request->input('is_titled')=='NULL'?NULL:$request->input('is_titled');;
                $landholding->total_area = $request->input('total_area');
                $landholding->area_type = $request->input('area_type');
                $landholding->current_utilization = $request->input('current_utilization')=='NULL'?NULL:$request->input('current_utilization');
                $landholding->update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Land holding Updated Successfully... :)'
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
                'message'=>'Land holding Not Found... :(',
            ]);
        }
    }
    // Deleting data
    public function destroy($id){
        $landholding = Landholdings::find($id);

        if($landholding){
            $landholding->delete();
            
            return response()->json([
                'status'=>200,
                'message'=>'Land holding Record Deleted... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Land holding Not Found... :(',
            ]);
        }
    }
}
