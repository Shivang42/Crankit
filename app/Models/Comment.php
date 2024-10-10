<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $guarded = [];
    public $timestamps = true;

    public function commentable():MorphTo{
        return $this->morphTo(__FUNCTION__,'comment_id','comment_type');
    }
    public function creator():BelongsTo{
        return $this->belongsTo(User::class,'author','id');
    }
    // public function comments():MorphMany{
    //     return $this->morphMany($this,'commentable');
    // }
}
