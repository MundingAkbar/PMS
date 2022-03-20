<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use DataTables;
use App\Models\Landimprovements;

class LandimprovementsController extends Controller
{
    public function index(){
        return view('properties.landimprovements');
    }
    // function for adding article
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name_of_project'=>'required|max:191',
            'location'=>'required|max:191',
            'project_cost'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            try{
                $landimprovement = new Landimprovements();
                $landimprovement->name_of_project = $request->input('name_of_project');
                $landimprovement->location = $request->input('location');
                $landimprovement->project_cost = $request->input('project_cost');
                $landimprovement->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'New Land improvement Successfully...',
                ]);
            }catch(QueryException $ex){
                return response()->json([
                    'status'=>500,
                    'message'=>'Something went wrong when saving data..',
                ]);
            }
        }
    }
      // ======================================================
    // function for fetching data live
    // get office list display to table
    public function getLandimprovementsList(){
        $landimprovement = Landimprovements::all();
        return DataTables::of($landimprovement)
                        // ->addIndexColumn()
                        ->addColumn('action', function($row){})
                        ->rawColumns(['action'])
                        ->make(true);
    }
    // ===============================================
    // fetching data to and return to response modal
    public function edit($id){

        $landimprovement = Landimprovements::find($id);

        if($landimprovement){
            return response()->json([
                'status'=>200,
                'landimprovement'=>$landimprovement,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Article Not Found... :(',
            ]);
        }
    }
     // updating the data
     public function update(Request $request, $id){
        
        $landimprovement = Landimprovements::find($id);
      
        if($landimprovement){
            $landimprovement->name_of_project = $request->input('name_of_project');
            $landimprovement->location = $request->input('location');
            $landimprovement->project_cost = $request->input('project_cost');
            $landimprovement->update();
            
            return response()->json([
                'status'=>200,
                'message'=>'Land improvement Record Updated Successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Land improvement Not Found... :(',
            ]);
        }
    }
         // Deleting data
         public function destroy($id){
            $landimprovement = Landimprovements::find($id);
    
            if($landimprovement){
                $landimprovement->delete();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Land improvement Record Deleted... :)'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Land improvement Not Found... :(',
                ]);
            }
        }
}
