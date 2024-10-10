<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\organization;use App\Models\Position;
use App\Models\OrgPost;use App\Models\WorkExperience;


class WorkController extends Controller
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
            'org_name'=>'required|max:500',
            'org_pos'=>'string|required|max:500',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'description'=>''
        ]);
        $body = $req->all();$user = $req->user();
        if(!organization::where(['organization_name'=>$body['org_name']])->exists()){
            $org = organization::create(['organization_name'=>$body['org_name']]);
        }else{
            $org = organization::where(['organization_name'=>$body['org_name']])->first();
        }
        if(!Position::where(['position_name'=>$body['org_pos']])->exists()){
            $pos = Position::create(['position_name'=>$body['org_pos']]);
        }
        else{
            $pos = Position::where(['position_name'=>$body['org_pos']])->first();
        }
        $ic = OrgPost::where(['organization'=>$org->id,'position'=>$pos->id]);
        if(!$ic->exists()){
            OrgPost::create(['organization'=>$org->id,'position'=>$pos->id]);
        }
        WorkExperience::create(['user_id'=>$user->id,'org_id'=>$org->id,'job_id'=>$pos->id,'start_date'=>$body['start_date'],'end_date'=>$body['end_date'],'description'=>$body['description']]);
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
