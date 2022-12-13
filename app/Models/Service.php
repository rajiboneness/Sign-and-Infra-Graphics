<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'category_id', 'status'];
    protected $dates = [ 'deleted_at' ];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
