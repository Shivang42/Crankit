<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Friends;use App\Models\Comment;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'uname'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected function identifier(): Attribute{
        return Attribute::make(
            get: fn (mixed $value,array $attributes) => base64_encode($attributes['id']."-".$attributes['name']),
        );
    }
    protected function comments():HasMany{
        return $this->hasMany(Comment::class);
    }
     protected function friendWith():HasManyThrough{
        return $this->hasManyThrough(User::class,Friends::class,'friend1','id','id','friend2');
    }
    protected function friendOf():HasManyThrough{
        return $this->hasManyThrough(User::class,Friends::class,'friend2','id','id','friend1');
    }

    protected function friendbelong():BelongsToMany{
        return $this->belongsToMany(User::class,'friends','friend2','id','friend2','id')->withPivot('friend1', 'friend2','chats','created_at');
    }
    protected function institutes():HasMany{
        return $this->hasMany(EducationExperience::class,'user_id');
    }
    protected function jobs():HasMany{
        return $this->hasMany(WorkExperience::class,'user_id');
    }
    protected function projects():HasMany{
        return $this->hasMany(ProjectExperience::class,'user_id');
    }
}
