<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Models\Offices;
use DataTables;

class OfficesController extends Controller
{
    public function index(){

        $offices = Offices::all();

        return view('properties.offices', [
            'offices' => $offices,
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'office_name'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            try{
                $office = new Offices();
                $office->office_name = $request->input('office_name');
                $office->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'New Office/Department Added Successfully...',
                ]);
            }catch(QueryException $ex){
                return response()->json([
                    'status'=>500,
                    'message'=>'Data already Exists...',
                ]);
            }
        }
    }

    // fetching data to and return to response modal
    public function edit($id){

        $office = Offices::find($id);

        if($office){
            return response()->json([
                'status'=>200,
                'office'=>$office,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Office Not Found... :(',
            ]);
        }
    }
    // updating the data
    public function update(Request $request, $id){
        
        $office = Offices::find($id);
      
        if($office){
            $office->office_name = $request->input('office_name');
            $office->update();
            
            return response()->json([
                'status'=>200,
                'message'=>'Office/Department Record Updated Successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Office/Deparmtent Not Found... :(',
            ]);
        }
    }
    // auto reload function
    public function reload(){
        $offices = Offices::all();
        return response()->json([
            'offices'=>$offices,
        ]);
    }
    // Deleting data
    public function destroy($id){
        $office = Offices::find($id);

        if($office){
            $office->delete();
            
            return response()->json([
                'status'=>200,
                'message'=>'Office/Department Record Deleted... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Office/Deparmtent Not Found... :(',
            ]);
        }
    }
    // get office list display to table
    public function getOfficeList(){
        $offices = Offices::all();
        return DataTables::of($offices)
                        // ->addIndexColumn()
                        ->addColumn('action', function($row){})
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
