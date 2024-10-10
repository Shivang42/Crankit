<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Comment;use App\Models\Posts;

class CommentController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req,$postid)
    {
        if($postid){
            $post = Posts::where('id','=',$postid)->first();
            if(!$post){
                return response()->json(['msg','Couldnt find post'],410);
            }
            $post->comments()->save(new Comment([
                'content'=>$req->input('comment'),
                'author'=>$req->user()->id
            ]));
            return response()->json(['msg','Successfully commented']);
        }
        else{
            return response()->json(['msg','Couldn\'t find the post ' ]);
        }
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
