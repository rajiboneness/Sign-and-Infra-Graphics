<?php

namespace App\Repositories;

use App\Interfaces\InvoiceInterface;
use App\Models\Invoice;
use Illuminate\Http\UploadedFile;

class InvoiceRepository implements InvoiceInterface 
{
    // use UploadAble;
    public function GetAllInvoice(){
        return Invoice::latest('id')->get();
    }
    public function DateWiseInvoiceData(array $data){
        $collectedData = collect($data);
        if(!empty($collectedData['invoice_code'])){
            $invoiceCode = $collectedData['invoice_code'];
            $allData = Invoice::where('invoice_code', $invoiceCode)->get();
            return $allData;
        }else{
            $endDate=$startDate="";
            $from = $collectedData['start_date'];
            $startDate=$from;
            $from=$from." 00:00:00";
            $to = $collectedData['end_date'];
            $endDate=$to;
            $to=$to." 23:59:59";
            $allData = Invoice::where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
            return $allData;
        }
        
        
        
    }
   


    
}