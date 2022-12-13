<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = ['customer_code', 'fname', 'lname', 'email', 'phone', 'whatsapp', 'company_name', 'website', 'contact_person', 'company_phone', 'address', 'country', 'state', 'city', 'pincode', 'status'];
    protected $dates = [ 'deleted_at' ];
}
