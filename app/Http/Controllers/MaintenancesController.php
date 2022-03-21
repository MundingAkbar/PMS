<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offices;
use App\Models\Equipment;
use App\Models\Maintenances;
use App\Models\Articles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use DB;
use DataTables;

class MaintenancesController extends Controller
{
    public function index(){
        $offices = Offices::all();
        $articles = Articles::all();
        $equipment = DB::table('equipment')
        ->leftjoin('articles','articles.id','=','equipment.article')
        ->leftjoin('users','users.id','=','equipment.requisitioner')
        ->leftjoin('offices','offices.id','=','equipment.deployment')
        ->select('equipment.*','articles.article AS article_name','articles.account_code','users.first_name','users.last_name','offices.office_name')
        ->get();

        return view('properties.maintenances',[
            'equipment'=>$equipment,
            'offices'=>$offices,
            'articles'=>$articles,
        ]);
    }
      // function for adding article
      public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'date_start'=>'required',
            'date_end'=>'required',
            'working_days'=>'required',
            'office'=>'required',
            'units'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            try{
                $maintenance = new Maintenances();
                $maintenance->date_start = $request->input('date_start');
                $maintenance->date_end = $request->input('date_end');
                $maintenance->working_days = $request->input('working_days');
                $maintenance->office = $request->input('office');
                $maintenance->units = $request->input('units');
                $maintenance->save();

                $latest_id = Maintenances::select('id')->latest('id')->first();
                return $latest_id->id;
            }catch(QueryException $ex){
                return response()->json([
                    'status'=>500,
                    'message'=>$ex->getMessage(),
                ]);
            }
        }
    }
    // update equipment maintenance
    public function addEquipmentSched(Request $request, $id){
        $equipment = Equipment::find($id);
        
        if($equipment){

            try{
                $equipment->maintenance = $request->input('maintenance_id');
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
}
