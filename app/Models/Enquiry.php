<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;
    protected $fillable = ['customer_id', 'name', 'email', 'phone', 'status'];
    protected $dates = [ 'deleted_at' ];

    public function customers() {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
    
}
