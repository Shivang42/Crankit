<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\institute;use App\Models\InstCourse;
use App\Models\EducationExperience;use App\Models\Course;

class EducationController extends Controller
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
            'inst_name'=>'required|max:500',
            'inst_course'=>'string|required|max:500',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'description'=>''
        ]);
        $body = $req->all();$user = $req->user();
        if(!institute::where(['institute_name'=>$body['inst_name']])->exists()){
            $inst = institute::create(['institute_name'=>$body['inst_name']]);
        }else{
            $inst = institute::where(['institute_name'=>$body['inst_name']])->first();
        }
        if(!Course::where(['course_name'=>$body['inst_course']])->exists()){
            $course = Course::create(['course_name'=>$body['inst_course']]);
        }
        else{
            $course = Course::where(['course_name'=>$body['inst_course']])->first();
        }
        $ic = InstCourse::where(['institute'=>$inst->id,'course'=>$course->id]);
        if(!$ic->exists()){
            InstCourse::create(['institute'=>$inst->id,'course'=>$course->id]);
        }
        EducationExperience::create(['user_id'=>$user->id,'institute_id'=>$inst->id,'course_id'=>$course->id,'start_date'=>$body['start_date'],'end_date'=>$body['end_date'],'description'=>$body['description']]);
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
