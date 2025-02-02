<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class reviewes extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'name', 'rating', 'review'];

    public function book()
    {

        return $this->belongsTo(books::class, 'book_id');
    }
}
