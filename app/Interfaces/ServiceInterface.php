<?php

namespace App\Interfaces;

interface ServiceInterface 
{
    /**
     * This method is to fetch list of all Banners
     */
    public function getAllService();
    public function ServiceStoreData(array $arrayData);
    public function ServiceUpdateData($id, array $arrayData);
    public function toggleStatus($id);
    public function DeleteService($id);

}