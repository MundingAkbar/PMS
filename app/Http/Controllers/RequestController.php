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

class RequestController extends Controller
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

        return view('users.request',[
            'equipment'=>$equipment,
        ]);
    }
}
