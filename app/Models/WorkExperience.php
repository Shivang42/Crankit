<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\organization;use App\Models\Position;

class WorkExperience extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function organization():HasOne{
        return $this->hasOne(organization::class,'id','org_id');
    }
    public function position():HasOne{
        return $this->hasOne(Position::class,'id','job_id');
    }
}
