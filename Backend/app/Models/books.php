<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    protected $fillable = ['title', 'author', 'book_created', 'description'];

    public function userReviewes()
    {

        return $this->hasMany(reviewes::class);
    }
}
