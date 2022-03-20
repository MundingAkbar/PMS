<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offices;
use DB;
use DataTables;

class UserController extends Controller
{
    public function index(){
        // fetching general data
        $users = User::all();
        $offices = Offices::all();
        // fetching particular data
        $users_office = DB::table('users')->distinct('office')->get();
        $users_first_name = DB::table('users')->distinct('first_name')->get();
        $users_last_name = DB::table('users')->distinct('last_name')->get();

        return view('users.users', [
            'users' => $users, 
            'users_office' => $users_office,
            'users_first_name' => $users_first_name,
            'users_last_name' => $users_last_name,
            'offices' => $offices,
        ]);
    }

    public function edit($id){
        $user = User::find($id);
        if($user){
            return response()->json([
                'status'=>200,
                'user'=>$user,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'User Not Found... :(',
            ]);
        }
    }

    public function update(Request $request, $id){
        
        $user = User::find($id);
      
        if($user){
            $user->office = $request->input('office');
            $user->role = $request->input('role');
            $user->update();
            
            return response()->json([
                'status'=>200,
                'message'=>'User Record Updated Successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'User Not Found... :(',
            ]);
        }
    }
    // Live fetching of data to table
    public function getUsersList(){
        $users = DB::table('users')
                ->join('offices','offices.id','=','users.office')
                ->select('users.*','offices.office_name')
                ->get();
        return DataTables::of($users)
                        // ->addIndexColumn()
                        ->addColumn('action', function($row){})
                        ->rawColumns(['action'])
                        ->make(true);
    }
        // Deleting data
        public function destroy($id){
            $user = User::find($id);
    
            if($user){
                $user->delete();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'User Record Deleted... :)'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'User Not Found... :(',
                ]);
            }
        }
}
