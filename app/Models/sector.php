<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use App\Models\organization;use App\Models\OrgSector;

class sector extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function companies():HasManyThrough{
        return $this->hasManyThrough(organization::class,OrgSector::class,'organization','id','id','sector');
    }
}
