<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use DataTables;
use App\Models\Articles;

class ArticlesController extends Controller
{
    public function index(){
        return view('properties.articles');
    }
    // function for adding article
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'account_code'=>'required|max:191',
            'account_title'=>'required|max:191',
            'account_type'=>'required|max:191',
            'article'=>'required|max:191',
            'article_for'=>'required|max:191'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            try{
                $article = new Articles();
                $article->account_code = $request->input('account_code');
                $article->account_title = $request->input('account_title');
                $article->account_type = $request->input('account_type');
                $article->article = $request->input('article');
                $article->article_for = $request->input('article_for');
                $article->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'New Article Added Successfully...',
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
        public function getArticlesList(){
            $articles = Articles::all();
            return DataTables::of($articles)
                            // ->addIndexColumn()
                            ->addColumn('action', function($row){})
                            ->rawColumns(['action'])
                            ->make(true);
        }
    // ===============================================
    // fetching data to and return to response modal
    public function edit($id){

        $article = Articles::find($id);

        if($article){
            return response()->json([
                'status'=>200,
                'article'=>$article,
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
        
        $article = Articles::find($id);
      
        if($article){
            $article->account_code = $request->input('account_code');
            $article->account_type = $request->input('account_type');
            $article->account_title = $request->input('account_title');
            $article->article = $request->input('article');
            $article->article_for = $request->input('article_for');
            $article->update();
            
            return response()->json([
                'status'=>200,
                'message'=>'Article Record Updated Successfully... :)'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Article Not Found... :(',
            ]);
        }
    }
        // Deleting data
        public function destroy($id){
            $article = Articles::find($id);
    
            if($article){
                $article->delete();
                
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
}
