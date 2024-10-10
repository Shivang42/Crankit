<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Relations\HasMany;

class ProjectExperience extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    protected $table = 'project_experiences';
    protected $guarded = [];
    public function media():\Awobaz\Compoships\Database\Eloquent\Relations\HasMany{
        return $this->hasMany(ProjectMedia::class,['user_id','project_id'],['user_id','project_id']);
    }
}
