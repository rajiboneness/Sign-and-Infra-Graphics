<?php

namespace App\Interfaces;

interface EnquiryInterface 
{
    public function EnqueryStoreData(array $arraydata);
    public function DeleteEnquiry($id);
    public function EnqueryUpdateData($id, array $arraydata);
    public function DeleteEnquiryDetails($id);
    public function InvoiceStoreData(array $Enquiry);
    public function GetAllInvoice();
}