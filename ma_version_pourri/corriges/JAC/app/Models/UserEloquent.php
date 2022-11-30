<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEloquent extends Model
{
    use HasFactory;

    protected $table = 'UserEloquent';
    public $timestamps = false;

    /**
     * Get the article for the user.
     */
    public function articles()
    {
        return $this->hasMany(Article::class,'author_id');
    }
}
