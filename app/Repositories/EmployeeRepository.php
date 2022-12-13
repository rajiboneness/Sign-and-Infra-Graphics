<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Http\UploadedFile;

class EmployeeRepository implements EmployeeInterface 
{
    // use UploadAble;

    public function getAllEmployee()
    {
        return Employee::latest('id')->paginate(10);
    }
    
    public function EmployeeStoreData(array $arrayData){

        $collection = collect($arrayData);
        $Store = new Employee;
        $Store->fname = ucwords($collection['fname']);
        $Store->lname = ucwords($collection['lname']);
        $Store->email = $collection['email'];
        $Store->phone = $collection['phone'];
        $Store->designation = $collection['designation'];
        $Store->joining_date = $collection['joining_date'];
        $Store->address = $collection['address'];
        $Store->save();
        return $Store;
    }
    public function EditEmployeeDetails($id){
        $Employee = Employee::findOrFail($id);
        return $Employee;
    }
    public function EmployeeUpdateData($id, array $arrayData){
        $collection = collect($arrayData);
        $Update = Employee::findOrFail($id);
        $Update->fname = ucwords($collection['fname']);
        $Update->lname = ucwords($collection['lname']);
        $Update->email = $collection['email'];
        $Update->phone = $collection['phone'];
        $Update->address = $collection['address'];
        $Update->designation = $collection['designation'];
        $Update->joining_date = $collection['joining_date'];
        $Update->save();
        return $Update;
    }
     public function toggleStatus($id){
         $toggle = Employee::findOrFail($id);
         $status = ($toggle->status == 1)? 0 : 1;
         $toggle->status = $status;
         $toggle->save();
         return $toggle;
     }

    public function DeleteEmployee($id){
        $delete = Employee::findOrFail($id);
        if($delete){
            $delete->delete();
            return $delete;
        }
    }
}