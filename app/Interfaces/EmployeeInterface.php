<?php

namespace App\Interfaces;

interface EmployeeInterface 
{
    /**
     * This method is to fetch list of all Banners
     */
    public function getAllEmployee();
    public function EmployeeStoreData(array $arrayData);
    public function EditEmployeeDetails($id);
    public function EmployeeUpdateData($id, array $arrayData);
    public function toggleStatus($id);
    public function DeleteEmployee($id);

}