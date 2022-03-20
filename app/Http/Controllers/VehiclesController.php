<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\Offices;
use App\Models\Articles;
use App\Models\Vehicles;
use DB;
use DataTables;

class VehiclesController extends Controller
{
    public function index(){

        $users = User::all();
        $offices = Offices::all();
        $articles = Articles::where('article_for','=','Vehicles')->get();

        $distinct_articles = DB::table('articles')->where('article_for','=','Vehicles')->distinct()->get(['article']);
        $disctinct_users = DB::table('users')->select('users.first_name','users.last_name')->groupBy('first_name')->groupBy('last_name')->get();
        $distinct_articles_codes = DB::table('articles')->distinct()->get(['account_code']);

        return view('properties.vehicles',[
            'users'=>$users,
            'offices'=>$offices,
            'articles'=>$articles,
            'distinct_articles'=>$distinct_articles,
            'disctinct_users'=>$disctinct_users,
            'distinct_articles_codes'=>$distinct_articles_codes
        ]);
    }
    // ======================================================
    // function for fetching data live
    // get office list display to table
        public function getVehiclesList(){
            $equipment = DB::table('vehicles')
            ->leftjoin('articles','articles.id','=','vehicles.article')
            ->leftjoin('users','users.id','=','vehicles.requisitioner')
            ->leftjoin('offices','offices.id','=','vehicles.deployment')
            ->select('vehicles.*','articles.article AS article_name','articles.account_code','users.first_name','users.last_name','offices.office_name')
            ->get();
            return DataTables::of($equipment)
                            // ->addIndexColumn()
                            ->addColumn('action', function($row){})
                            ->rawColumns(['action'])
                            ->make(true);
        }
           // function for adding equipment
           public function store(Request $request){

            $validator = Validator::make($request->all(),[
                'property_number'=>'required|max:191',
                'units'=>'required|max:191',
                'unit_value'=>'required|max:191',
            ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            }else{
                try{
                    $vehicle = new Vehicles();
                    $vehicle->article = $request->input('article')=='NULL'?NULL:$request->input('article');
                    $vehicle->requisitioner = $request->input('requisitioner')=='NULL'?NULL:$request->input('requisitioner');
                    $vehicle->deployment = $request->input('deployment')=='NULL'?NULL:$request->input('deployment');
                    $vehicle->property_number = $request->input('property_number');
                    $vehicle->registration_date = $request->input('registration_date');
                    $vehicle->remarks = $request->input('remarks');
                    $vehicle->units = $request->input('units');
                    $vehicle->unit_value = $request->input('unit_value');
                    $vehicle->total_value = $request->input('total_value');
                    $vehicle->description = $request->input('description');
                    $vehicle->save();
    
                    return response()->json([
                        'status'=>200,
                        'message'=>'New Vehicle Added Successfully...',
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
        // fetching data to and return to response modal
        public function edit($id){

            $vehicle = Vehicles::find($id);

            if($vehicle){
                return response()->json([
                    'status'=>200,
                    'vehicle'=>$vehicle,
                    ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Vehicle Not Found... :(',
                ]);
            }
        }
        // updating the data
    public function update(Request $request, $id){
        
        $vehicle = Vehicles::find($id);
        
        if($vehicle){

            try{
                $vehicle->article = $request->input('article')=='NULL'?NULL:$request->input('article');
                $vehicle->requisitioner = $request->input('requisitioner')=='NULL'?NULL:$request->input('requisitioner');
                $vehicle->deployment = $request->input('deployment')=='NULL'?NULL:$request->input('deployment');
                $vehicle->property_number = $request->input('property_number');
                $vehicle->registration_date = $request->input('registration_date');
                $vehicle->remarks = $request->input('remarks');
                $vehicle->units = $request->input('units');
                $vehicle->unit_value = $request->input('unit_value');
                $vehicle->total_value = $request->input('total_value');
                $vehicle->description = $request->input('description');
                $vehicle->update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Vehicle Updated Successfully... :)'
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
                'message'=>'Equipment Not Found... :(',
            ]);
        }
    }
      // Deleting data
      public function destroy($id){
        $vehicle = Vehicles::find($id);

        if($vehicle){
            $vehicle->delete();
            
            return response()->json([
                'status'=>200,
                'message'=>'Equipment Record Deleted... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Equipment Not Found... :(',
            ]);
        }
    }
}
