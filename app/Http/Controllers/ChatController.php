<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Friends;
use App\Models\User;
use App\Models\Chats;

class ChatController extends Controller
{
    //
    private function sortChat($chat1,$chat2){
        if($chat1->created_at==$chat2->created_at){
            return 0;
        }
        return $chat1->created_at>$chat2->created_at?1:-1;
    }
    public function list(Request $req){
        $user = $req->user();
        $chats = ['Crankit'=>[]];

        // First admin chats are allocated
        $with = $user->friendWith;$of = $user->friendOf;
        foreach($of as $frof){
            $friendship = Friends::where(['friend2'=>$user->id,'friend1'=>$frof->id])->first();
            if($friendship->type=='pending'){
                array_push($chats['Crankit'],['from'=>$frof->uname,'fromid'=>$frof->identifier,'type'=>'friendrequest','created'=>$friendship->created_at]);
            }
        }

        foreach($with as $frwith){
            $friendship = Friends::where(['friend2'=>$frwith->id,'friend1'=>$user->id])->first();
            if($friendship->type=='pending'){
                continue;
            }
            $friendname = $frwith->uname;
            $sent = $friendship->chatsTo->map(function($schat) use($user){
                $schat['type'] = $schat['from']==$user->id?'sent':'recieved';
                unset($schat['from']);unset($schat['to']);
                return $schat;
            });
            $recieved = $friendship->chatsFrom->map(function($rchat) use($user){
                $rchat['type'] = $rchat['from']==$user->id?'sent':'recieved';
                unset($rchat['from']);unset($rchat['to']);
                return $rchat;
            });
            $chats[$friendname] = $sent->merge($recieved);
            $chats[$friendname]->sortBy('created_at');
        }

        foreach($of as $frof){
            $friendship = Friends::where(['friend1'=>$frof->id,'friend2'=>$user->id])->first();
            if($friendship->type=='pending'){
                continue;
            }
            $friendname = $frof->uname;
            $sent = $friendship->chatsTo->map(function($schat) use($user){
                $schat['type'] = $schat['from']==$user->id?'sent':'recieved';
                unset($schat['from']);unset($schat['to']);
                return $schat;
            });
            $recieved = $friendship->chatsFrom->map(function($rchat) use($user){
                $rchat['type'] = $rchat['from']==$user->id?'sent':'recieved';
                unset($rchat['from']);unset($rchat['to']);
                return $rchat;
            });
            if(isset($chats[$friendname])){
                $chats[$friendname] = $chats[$friendname]->merge($sent->merge($recieved));
            }else{
                $chats[$friendname] = $sent->merge($recieved);
            }

            $chats[$friendname]->sortBy('created_at');
        }
         return view('Noteboard',['user'=>$user,'chats'=>$chats]);  
    }
    public function add(Request $req):JsonResponse{
        $data = explode(',',trim($req->getContent(),'{}'));
        $body = [];
        foreach($data as $keyvalue){
            $d = explode(':', $keyvalue);
            $body[trim($d[0],'\"')] = trim($d[1],'\"');
        }
        $user = $req->user();

        $uname = $body['uname'];
        $chat =  $body['content'];
        if(!$chat){
            return response()->json(['msg'=>'No chat provided'],402);
        }
        // First admin chats are allocated
        $with = $user->friendWith;$of = $user->friendOf;
        $friend = $with->merge($of)->filter(function($fr) use($uname){
            return $fr->uname==$uname;
        })->first();
        if($friend){
            Chats::create(['from'=>$user->id,'to'=>$friend->id,'content'=>$chat]);
            return response()->json(['msg'=>'Chat success']);
        }
        else{
            return response()->json(['msg'=>'Friend not found'],401);
        }
    }
    public function del(Request $req):JsonResponse{
        $data = explode(',',trim($req->getContent(),'{}'));
        $body = [];
        foreach($data as $keyvalue){
            $d = explode(':', $keyvalue);
            $body[trim($d[0],'\"')] = trim($d[1],'\"');
        }
        $user = $req->user();

        $id = (int) $body['cref'];
        if(!$id){
            return response()->json(['msg'=>'No chat provided'],422);
        }
        // First admin chats are allocated
        $chat = Chats::find($id);
        if($chat){
            if($chat->from==$user->id || $chat->to==$user->id){
                $chat->delete();$msg = ['msg'=>'Delete successful'];
            }else{
                $msg = ['msg'=>'Unauthorized deletion',401];
            }
            return response()->json($msg);
        }
        else{
            return response()->json(['msg'=>'Chat not found'],406);
        }
    }
}
