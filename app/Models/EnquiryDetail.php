<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquiryDetail extends Model
{
    protected $fillable = ['enquiry_id', 'category_id', 'service_id', 'width', 'height'];
    
    public function enquiries() {
        return $this->belongsTo('App\Models\Enquiry', 'enquiry_id', 'id');
    }
    public function categories() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function services() {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }
}
