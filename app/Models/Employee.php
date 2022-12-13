<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = ['designation', 'fname', 'lname', 'email', 'phone', 'joining_date', 'status'];
    protected $dates = [ 'deleted_at' ];
}
