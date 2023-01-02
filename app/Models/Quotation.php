<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['quotation_code', 'enquiry_id', 'items', 'quantity', 'gst', 'total_amount', 'created_at', 'updated_at'];

    public function enquiries() {
        return $this->belongsTo('App\Models\Enquiry', 'enquiry_id', 'id');
    }
    
}
