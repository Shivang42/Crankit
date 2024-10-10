<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EducationExperience extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'educational_experiences';
    public $timestamps = false;

    public function institute():HasOne{
        return $this->hasOne(institute::class,'id','institute_id');
    }
    public function course():HasOne{
        return $this->hasOne(Course::class,'id','course_id');
    }
}
