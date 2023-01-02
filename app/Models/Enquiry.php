<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'customer_id', 'employee_id', 'emp_name', 'emp_phone', 'emp_email',  'name', 'email', 'phone', 'status', 'quotation', 'quotation_date', 'invoice'];
    protected $dates = [ 'deleted_at' ];

    public function customers() {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
    // public function quotations() {
    //     return $this->hasOne('App\Models\Quotation', 'id', 'enquiry_id');
    // }
    public function employees() {
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
    }
    
}
