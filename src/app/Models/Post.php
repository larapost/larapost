<?php

namespace App\Larapost\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'larapost_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
