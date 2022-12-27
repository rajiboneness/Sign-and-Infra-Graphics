<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_id', 'employee_id', 'enquiry_id', 'invoice_code', 'items', 'quantity', 'gst', 'total_amount'];

    public function customers() {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
    public function enquiries() {
        return $this->belongsTo('App\Models\Enquiry', 'enquiry_id', 'id');
    }
}
