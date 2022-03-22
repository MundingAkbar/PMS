<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offices;
use App\Models\Requests;
use App\Models\Equipment;
use App\Models\Vehicles;
use App\Models\Maintenances;
use App\Models\Articles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use DB;
use DataTables;

class RequestController extends Controller
{
    public function index(){
        $users = User::all();
        $offices = Offices::all();
        $articles = Articles::all();
        $equipment = DB::table('equipment')
        ->leftjoin('articles','articles.id','=','equipment.article')
        ->leftjoin('users','users.id','=','equipment.requisitioner')
        ->leftjoin('offices','offices.id','=','equipment.deployment')
        ->select('equipment.*','articles.article AS article_name','articles.account_code','users.first_name','users.last_name','offices.office_name')
        ->get();
        $vehicles = DB::table('vehicles')
        ->leftjoin('articles','articles.id','=','vehicles.article')
        ->leftjoin('users','users.id','=','vehicles.requisitioner')
        ->leftjoin('offices','offices.id','=','vehicles.deployment')
        ->select('vehicles.*','articles.article AS article_name','articles.account_code','users.first_name','users.last_name','offices.office_name')
        ->get();

        return view('users.request',[
            'equipment'=>$equipment,
            'vehicles'=>$vehicles,
            'offices'=>$offices,
            'users'=>$users,
        ]);
    }
    // saving request to database
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'effective_date'=>'required',
            'date_of_request'=>'required',
            'office'=>'required',
            'units'=>'required',
            'nature_of_request'=>'required',
            'status'=>'required',
            'requested_by'=>'required',
            'assigned_personnel'=>'required',
            'accepted_by'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            try{
                $req = new Requests();
                $req->effective_date = $request->input('effective_date');
                $req->date_of_request = $request->input('date_of_request');
                $req->office = $request->input('office');
                $req->quantity = $request->input('units');
                $req->nature_of_request = $request->input('nature_of_request');
                $req->replaced_parts = $request->input('replaced_parts');
                $req->amount_of_replaced_parts = $request->input('amount_of_replaced_parts');
                $req->status = $request->input('status');
                $req->requested_by = $request->input('requested_by');
                $req->assigned_personnel = $request->input('assigned_personnel');
                $req->date_received = $request->input('date_received');
                $req->findings = $request->input('findings');
                $req->action_taken = $request->input('action_taken');
                $req->recommending_for = $request->input('recommending_for');
                $req->date_returned_by = $request->input('date_returned_by');
                $req->accepted_by = $request->input('accepted_by');
                $req->save();

                $latest_id = Requests::select('id')->latest('id')->first();
                return response()->json([
                    'status'=>200,
                    'message'=>'New Request Added Successfully...',
                    'id'=>$latest_id->id
                ]);
            }catch(QueryException $ex){
                return response()->json([
                    'status'=>500,
                    'message'=>'Data already Exists...',
                ]);
            }
        }
    }
    // ==============================================================
    // function for fetching data live
    // get office list display to table
    public function getRequestsList(){

        $req = DB::table('requests')
                ->leftjoin('offices', 'offices.id','=','requests.office')
                ->leftjoin('users as u','u.id','=','requests.requested_by')
                ->leftjoin('users as u2','u2.id','=','requests.assigned_personnel')
                ->leftjoin('users as u3','u3.id','=','requests.date_returned_by')
                ->leftjoin('users as u4','u4.id','=','requests.accepted_by')
                ->select('requests.*','offices.office_name','u.first_name  as requested_by_fname',
                'u.last_name as requested_by_lname','u2.first_name as assigned_personnel_fname',
                'u2.last_name as assigned_personnel_lname','u3.first_name as returned_by_fname',
                'u3.last_name as returned_by_lname','u4.first_name as accepted_by_fname','u4.last_name as accepted_by_lname')
                ->get();
                         return DataTables::of($req)
                        // ->addIndexColumn()
                        ->addColumn('action', function($row){})
                        ->rawColumns(['action'])
                        ->make(true);
    }
    // updating items request
    public function update_equipment(Request $request, $id){

        $equipment = Equipment::find($id);
        if($equipment){
            $equipment->request = $request->input('request_id');
            $equipment->update();

            return response()->json([
                'status'=>200,
                'message'=>'Maitenance Schedule Updated Successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'Something went wrong... :)'
            ]);
        }
    }
    public function update_vehicles(Request $request, $id){

        $vehicle = Vehicles::find($id);
        if($vehicle){
            $vehicle->request = $request->input('request_id');
            $vehicle->update();

            return response()->json([
                'status'=>200,
                'message'=>'Request for Vehicle added successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'Something went wrong... :)'
            ]);
        }
    }
    // fetching data to and return to response modal
    public function edit($id){

        $request = Requests::find($id);

        if($request){
            return response()->json([
                'status'=>200,
                'request'=>$request,
                ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Request Not Found... :(',
            ]);
        }
    }
        // updating the data
        public function update(Request $request, $id){
        
            $req = Requests::find($id);
          
            if($req){
                $req->effective_date = $request->input('effective_date');
                $req->date_of_request = $request->input('date_of_request');
                $req->office = $request->input('office');
                $req->quantity = $request->input('units');
                $req->nature_of_request = $request->input('nature_of_request');
                $req->replaced_parts = $request->input('replaced_parts');
                $req->amount_of_replaced_parts = $request->input('amount_of_replaced_parts');
                $req->status = $request->input('status');
                $req->requested_by = $request->input('requested_by');
                $req->assigned_personnel = $request->input('assigned_personnel');
                $req->date_received = $request->input('date_received');
                $req->findings = $request->input('findings');
                $req->action_taken = $request->input('action_taken');
                $req->recommending_for = $request->input('recommending_for');
                $req->date_returned_by = $request->input('date_returned_by');
                $req->accepted_by = $request->input('accepted_by');
                $req->update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Request Record Updated Successfully... :)'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Request Not Found... :(',
                ]);
            }
        }
    // Deleting data
     public function destroy($id){
        $req = Requests::find($id);

        if($req){
            $req->delete();
            
            return response()->json([
                'status'=>200,
                'message'=>'Request Record Deleted... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Request Schedule Not Found... :(',
            ]);
        }
    }
}
