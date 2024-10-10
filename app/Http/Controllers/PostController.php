<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Likes;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function comment(Request $req):JsonResponse{
        if($req->input('post_id')){
            $post = Posts::where('id','=',$req->input('post_id'))->first();
            if(!$post){
                return response()->json(['msg','Couldnt find post'],410);
            }
            $post->comments->save(new Comment([
                'content'=>$req->input('comment')
            ]));
            return response()->json(['msg','Successfully commented']);
        }
        else{
            return response()->json(['msg','Couldnt find post'],410);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        //
        $acctags = ["a","abbr","acronym","address","applet","area","article","aside","audio","b","base","basefont","bdi","bdo","bgsound","big","blink","blockquote","br","button","canvas","caption","center","cite","code","col","colgroup","content","data","datalist","dd","decorator","del","details","dfn","dir","div","dl","dt","element","em","embed","fieldset","figcaption","figure","font","footer","frameset","h1","h2","h3","h4","h5","h6","header","hgroup","hr","i","img","input","ins","isindex","kbd","keygen","label","legend","li","link","listing","main","map","mark","marquee","menu","menuitem","meta","meter","nav","nobr","object","ol","optgroup","option","output","p","param","plaintext","pre","progress","q","rp","rt","ruby","s","samp","section","select","shadow","small","spacer","span","strike","strong","sub","summary","sup","table","tbody","td","template","textarea","tfoot","th","thead","time","title","tr","track","tt","u","ul","var","video","wbr","xmp"];
        $user = $req->user();
        if($req->input('media_content')){
            $image = $req->file('media_cont');
            $newname = ($user->uname).time().".".($image->getClientOriginalExtension());
            $image->move(public_path().'/postmedia',$newname);
            $post = Posts::create([
            'title'=>'',
            'image'=>$newname,
            'content'=>strip_tags($req->input('media_content'),$acctags),
            'creator'=>$user->id,
            'is_media'=>true
            ]);
        }else{
            $post = Posts::create([
            'title'=>$req->input('post_title'),
            'content'=>strip_tags($req->input('post_content'),$acctags),
            'creator'=>$user->id,
            'is_media'=>false
            ]);
        }
        if($post){
                error_log($post);
                session()->flash("msg","Successfully posted");
        }
        else{
            // Add some error handling
            session()->flash("error","Could not create post");
        }
        return back();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
        //
    }
    
    public function comment(Request $req)
    {
        //
    }
}
