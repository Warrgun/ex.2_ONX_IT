<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviewes extends Model
{
    protected $fillable = ['name', 'raitng', 'review'];

    public function book()
    {

        return $this->belongsTo(books::class);
    }
}
