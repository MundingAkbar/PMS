<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;

class ProfileController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        $user = DB::table('users')
                ->where('users.id',$id)
                ->leftjoin('offices','offices.id','=','users.office')
                ->select('users.*', 'offices.office_name')->get();

        // $users = DB::table('users')
        // ->join('offices','offices.id','=','users.office')
        // ->select('users.*','offices.office_name')
        // ->get();
        return view('users.profile',[
            'user' => $user
        ]);
    }
}
