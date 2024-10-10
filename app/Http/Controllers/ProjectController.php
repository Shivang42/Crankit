<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectExperience;use App\Models\ProjectMedia;

class ProjectController extends Controller
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
    public function store(Request $req)
    {
        $validation = $req->validate([
            'proj_name'=>'required|max:500',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'proj_media.*'=>'image',
            'description'=>''

        ]);
        $body = $req->all();$user = $req->user();
        $data = ProjectExperience::create(['name'=>$body['proj_name'],'user_id'=>$user->id,'start_date'=>$body['start_date'],'end_date'=>$body['end_date'],'description'=>$body['description']]);
        $media = $req->file('proj_media');
        print_r($media);
        foreach($media as $key=>$file){
            $file->move(public_path().'/projectmedia/'.$user->id.'/'.$data->id.'/',$key.".".($file->getClientOriginalExtension()));
            ProjectMedia::create(['user_id'=>$user->id,'project_id'=>$data->id,'file_path'=>$key.".".($file->getClientOriginalExtension())]);
        }
        return redirect()->route('user.edit');
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
