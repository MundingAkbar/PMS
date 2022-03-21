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
            'units'=>'required',
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
                $maintenance->article = $request->input('article');
                $maintenance->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'New Maintenance Schedule Successfully...',
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
    public function getSchedulesList(){
        $maintenance = DB::table('maintenances')
                        ->leftjoin('articles','articles.id','=','maintenances.article')
                        ->leftjoin('offices','offices.id','=','maintenances.office')
                        ->select('maintenances.*','offices.office_name','articles.article AS article_name')
                        ->get();
                         return DataTables::of($maintenance)
                        // ->addIndexColumn()
                        ->addColumn('action', function($row){})
                        ->rawColumns(['action'])
                        ->make(true);
    }
      // ===============================================
    // fetching data to and return to response modal
    public function edit($id){

        $maintenance = Maintenances::find($id);

        if($maintenance){
            return response()->json([
                'status'=>200,
                'maintenance'=>$maintenance,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Schedule Not Found... :(',
            ]);
        }
    }
     // updating the data
     public function update(Request $request, $id){
        
        $maintenance = Maintenances::find($id);
      
        if($maintenance){
            $maintenance->date_start = $request->input('date_start');
            $maintenance->date_end = $request->input('date_end');
            $maintenance->working_days = $request->input('working_days');
            $maintenance->office = $request->input('office');
            $maintenance->units = $request->input('units');
            $maintenance->article = $request->input('article');
            $maintenance->update();
            
            return response()->json([
                'status'=>200,
                'message'=>'Maitenance Schedule Updated Successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Maintenance Schedule Not Found... :(',
            ]);
        }
    }
     // Deleting data
     public function destroy($id){
        $maintenance = Maintenances::find($id);

        if($maintenance){
            $maintenance->delete();
            
            return response()->json([
                'status'=>200,
                'message'=>'Maintennace Schedule Record Deleted... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Maintennace Schedule Not Found... :(',
            ]);
        }
    }
}
