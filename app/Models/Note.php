<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['enquiry_id', 'notes'];

    public function enquiries() {
        return $this->belongsTo('App\Models\Enquiry', 'enquiry_id', 'id');
    }
}
