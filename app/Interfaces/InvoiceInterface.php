<?php

namespace App\Interfaces;

interface InvoiceInterface 
{
    /**
     * This method is to fetch list of all Banners
     */
    public function GetAllInvoice();
    public function DateWiseInvoiceData(array $data);

}