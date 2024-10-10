<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title','content','creator','likes','image'
    ];

    public function comments():MorphMany{
        return $this->morphMany(Comment::class,'commentable');
}
}