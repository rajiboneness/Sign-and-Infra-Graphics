<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;
    protected $fillable = ['customer_id', 'employee_id', 'emp_name', 'emp_phone', 'emp_email',  'name', 'email', 'phone', 'status'];
    protected $dates = [ 'deleted_at' ];

    public function customers() {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
    public function employees() {
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
    }
    
}
