<?php

namespace App\Interfaces;

interface CategoryInterface 
{
    /**
     * This method is to fetch list of all Banners
     */
    public function getAllCategory();
    public function CategoryStoreData(array $arrayData);
    public function CategoryUpdateData($id, array $arrayData);
    public function toggleStatus($id);
    public function DeleteCategory($id);

}