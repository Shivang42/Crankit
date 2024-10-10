<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Friends;
use App\Models\User;

class FriendController extends Controller
{
    //
    public function sendRequest(Request $req):JsonResponse{
        if(!$req->query('to')){
            print_r($req->query('to'));
            return response()->json(['msg'=>'no identifier found'],401);
        }
        $fromid = Auth::user()->id;
        $to = $req->query('to');
        $requestee = User::cursor()->filter(function ($user) use($to){
            return $user->identifier==$to;
        })->collect()->first();
        if(!isset($requestee->id)){
            return response()->json(['msg'=>'no requestee found'],401);
        }else{
            $toid = $requestee->id;
            if(Friends::where(['friend1'=>$fromid,'friend2'=>$toid])->exists() || Friends::where(['friend2'=>$fromid,'friend1'=>$toid])->exists()){
                return response()->json(['msg'=>'request already exists'],402);
            }
            Friends::create([
                'friend1'=>$fromid,
                'friend2'=>$toid
            ]);
            return response()->json(['msg'=>'request sent']);
        }
    }
    public function acceptRequest(Request $req,string $id):JsonResponse{
        if($req->user()==null){
            return response()->json(['msg'=>'you are not authenticated'],401);
        }
            $user = $req->user();$friend = $user->friendOf->filter(function($fr) use($id){
                    return $fr->identifier==$id;
            })->first();
            if($user->id!=''){
                    $friendship = Friends::where(['friend1'=>$friend->id,'friend2'=>$user->id])->first();
                    if(!$friendship){
                        return response()->json(['msg'=>'no such request'],412);
                    }
                    else if($friendship->type!='pending'){
                        return response()->json(['msg'=>'already friended'],413);
                    }else{
                        $friendship->update(['type'=>'friends']);
                        return response()->json(['msg'=>'success'],200);
                    }
                    
            }else{
                return response()->json(['msg'=>'id not provided'],403);
            }
    }
    public function sendMessage(Request $req):JsonResponse{

    }
    public function deleteMessage(Request $req):JsonResponse{

    }
    public function unfriend(Request $req):JsonResponse{

    }

}
