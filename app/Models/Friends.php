<?php

namespace App\Models;
// namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCompositePrimaryKey {
    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
     protected function setKeysForSaveQuery( $query)
    {
        $query
            ->where('friend1', '=', $this->getAttribute('friend1'))
            ->where('friend2', '=', $this->getAttribute('friend2'));

        return $query;
    }
    }
class Friends extends Model
{
    use HasFactory;

    use \Awobaz\Compoships\Compoships;
    use HasCompositePrimaryKey;
    
    protected $guarded = [];
    public $timestamps = true;

    

    public function chatsTo():HasMany{
        return $this->hasMany(Chats::class,'to',['friend1','friend2']);
    }
    public function chatsFrom():HasMany{
        return $this->hasMany(Chats::class,['from','to'],['friend1','friend2']);
    }

}
