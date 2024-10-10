<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Chats extends Model
{
    use HasFactory;

    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];

    public function from():BelongsTo{
        return $this->belongsTo(User::class,['from','to'],['friend1','friend2']);
    }
    public function to():BelongsTo{
        return $this->belongsTo(User::class,['from','to'],['friend2','friend1']);
    }
    public function getChats(){
        $one = $this->fromOne->merge($this->to);
    }
}
