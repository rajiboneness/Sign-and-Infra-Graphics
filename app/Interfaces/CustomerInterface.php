<?php

namespace App\Interfaces;

interface CustomerInterface 
{
    /**
     * This method is to fetch list of all Banners
     */
    public function getAllCustomer();
    public function CustomerStoreData(array $arrayData);
    public function EditCustomerDetails($id);
    public function CustomerUpdateData($id, array $arrayData);
    public function toggleStatus($id);
    public function DeleteCustomer($id);

}