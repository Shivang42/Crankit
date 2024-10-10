<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;use App\Models\Posts;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function create(Request $req):JsonResponse
    {
        // Append auth check
        $res = [];
        if($req->query('id')){
            $cpost = Posts::where('id',intval($req->query('id')))->get()[0];
            $clike = Like::where('user_id',$req->user()->id)->where('post_id',intval($req->query('id')))->exists();
            if($clike){
                $res = array_merge($res,['status'=>201,'msg'=>'Already liked']);
            }
            else if(isset($cpost)){
                $cpost->likes = $cpost->likes+1;
                $cpost->save();
                Like::create(['post_id'=>$req->query('id'),'user_id'=>$req->user()->id]);
                $res = array_merge($res,['status'=>200,'msg'=>'Liked the post']);
                // Here append a like to the Like model
            }
            else{
                $res = array_merge($res,['status'=>400,'msg'=>'No such post exists']);
            }
            
        }
        else{
            $res = array_merge($res,['status'=>400,'msg'=>'Please provide an id']);
        }
        return response()->json($res);
    }
    public function destroy(String $id):JsonResponse
    {
        // Append auth check
        $res = [];
        if($id){
            $cpost = Posts::where('id',intval($id))->get()[0];
            $clike = !Like::where('user_id',Auth::user()->id)->where('post_id',intval($id))->exists();
            if($clike){
                $res = array_merge($res,['status'=>201,'msg'=>'Already not liked']);
            }
            else if(isset($cpost)){
                $cpost->likes--;
                $cpost->save();
                Like::where('post_id',$id)->where('user_id',Auth::user()->id)->delete();
                $res = array_merge($res,['status'=>200,'msg'=>'Liked the post']);
                // Here append a like to the Like model
            }
            else{
                $res = array_merge($res,['status'=>400,'msg'=>'No such post exists']);
            }
            
        }
        else{
            $res = array_merge($res,['status'=>400,'msg'=>'Please provide an id']);
        }
        return response()->json($res);
    }
}
