<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProjectExperience;

class ProjectMedia extends Model
{
    use \Awobaz\Compoships\Compoships;
    use HasFactory;
    protected $table = 'projectmedia';
    public $timestamps = true;
    public $guarded = [];

    public function parent():BelongsTo{
        return $this->belongsTo(ProjectExperience::class,['user_id','project_id'],['user_id','project_id']);
    }
}
