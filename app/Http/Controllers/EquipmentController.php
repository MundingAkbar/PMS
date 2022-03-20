<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Offices;
use App\Models\Articles;
use App\Models\Equipment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use DB;
use DataTables;

class EquipmentController extends Controller
{
    public function index(){

        $users = User::all();
        $offices = Offices::all();
        $articles = Articles::where('article_for','=','Equipment')->get();

        $disctinct_users = DB::table('users')->select('users.first_name','users.last_name')->groupBy('first_name')->groupBy('last_name')->get();
        $distinct_articles = DB::table('articles')->where('article_for','=','Equipment')->distinct()->get(['article']);
        $distinct_articles_codes = DB::table('articles')->distinct()->get(['account_code']);
        $distinct_property_number = DB::table('equipment')->distinct()->get(['property_number']);
        // $distinct_account_number = DB::table('articles')->distinct()->get(['account_numbersss']);

        return view('properties.equipments',[
            'users'=>$users,
            'offices'=>$offices,
            'articles'=>$articles,
            'disctinct_users'=>$disctinct_users,
            'distinct_articles'=>$distinct_articles,
            'distinct_property_number'=>$distinct_property_number,
            'distinct_articles_codes'=>$distinct_articles_codes,
        ]);
    }
// ======================================================
// function for fetching data live
    // get office list display to table
    public function getEquipmentList(){
        $equipment = DB::table('equipment')
        ->leftjoin('articles','articles.id','=','equipment.article')
        ->leftjoin('users','users.id','=','equipment.requisitioner')
        ->leftjoin('offices','offices.id','=','equipment.deployment')
        ->select('equipment.*','articles.article AS article_name','articles.account_code','users.first_name','users.last_name','offices.office_name')
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
                $equipment = new Equipment();
                $equipment->article = $request->input('article')=='NULL'?NULL:$request->input('article');
                $equipment->requisitioner = $request->input('requisitioner')=='NULL'?NULL:$request->input('requisitioner');
                $equipment->deployment = $request->input('deployment')=='NULL'?NULL:$request->input('deployment');
                $equipment->property_number = $request->input('property_number');
                $equipment->remarks = $request->input('remarks');
                $equipment->units = $request->input('units');
                $equipment->unit_value = $request->input('unit_value');
                $equipment->total_value = $request->input('total_value');
                $equipment->description = $request->input('description');
                $equipment->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'New Equipment Added Successfully...',
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

        $equipment = Equipment::find($id);

        if($equipment){
            return response()->json([
                'status'=>200,
                'equipment'=>$equipment,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Equipment Not Found... :(',
            ]);
        }
    }
    // updating the data
    public function update(Request $request, $id){
        
        $equipment = Equipment::find($id);
        
        if($equipment){

            try{
                $equipment->article = $request->input('article')=='NULL'?NULL:$request->input('article');
                $equipment->requisitioner = $request->input('requisitioner')=='NULL'?NULL:$request->input('requisitioner');
                $equipment->deployment = $request->input('deployment')=='NULL'?NULL:$request->input('deployment');
                $equipment->property_number = $request->input('property_number');
                $equipment->remarks = $request->input('remarks');
                $equipment->units = $request->input('units');
                $equipment->unit_value = $request->input('unit_value');
                $equipment->total_value = $request->input('total_value');
                $equipment->description = $request->input('description');
                $equipment->update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Equipment Updated Successfully... :)'
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
        $equipment = Equipment::find($id);

        if($equipment){
            $equipment->delete();
            
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
