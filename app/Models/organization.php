<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use App\Models\sector;use App\Models\OrgSector;

class organization extends Model
{
    use HasFactory;

     protected $guarded = [];
     public $table = 'work_organizations';
     public $timestamps = false;
     public function sectors():HasManyThrough{
        return $this->hasManyThrough(sector::class,OrgSector::class,'organization','id','id','sector');
    }
}
