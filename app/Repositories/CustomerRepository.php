<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Customer;
use Illuminate\Http\UploadedFile;

class CustomerRepository implements CustomerInterface 
{
    // use UploadAble;

    public function getAllCustomer()
    {
        return Customer::latest('id')->paginate(10);
    }
    
    public function CustomerStoreData(array $arrayData){

        $collection = collect($arrayData);
        $Store = new Customer;
        $Store->customer_code = 'S'.rand(100,999).'A'.rand(100,999).'IN'.rand(100,999);
        $Store->fname = ucwords($collection['fname']);
        $Store->lname = ucwords($collection['lname']);
        $Store->email = $collection['email'];
        $Store->phone = $collection['phone'];
        $Store->whatsapp = $collection['whatsapp'];
        $Store->company_name = $collection['company_name'];
        $Store->website = $collection['website'];
        $Store->contact_person = $collection['contact_person'];
        $Store->company_phone = $collection['company_phone'];
        $Store->address = $collection['address'];
        $Store->city = $collection['city'];
        $Store->state = $collection['state'];
        $Store->country = $collection['country'];
        $Store->pincode = $collection['pincode'];
        $Store->save();
        return $Store;
    }
    public function EditCustomerDetails($id){
        
        $customer = Customer::findOrFail($id);
        return $customer;
    }
    public function CustomerUpdateData($id, array $arrayData){
        $collection = collect($arrayData);
        $Update = Customer::findOrFail($id);
        $Update->fname = ucwords($collection['fname']);
        $Update->lname = ucwords($collection['lname']);
        $Update->email = $collection['email'];
        $Update->phone = $collection['phone'];
        $Update->whatsapp = $collection['whatsapp'];
        $Update->company_name = $collection['company_name'];
        $Update->website = $collection['website'];
        $Update->contact_person = $collection['contact_person'];
        $Update->company_phone = $collection['company_phone'];
        $Update->address = $collection['address'];
        $Update->city = $collection['city'];
        $Update->state = $collection['state'];
        $Update->country = $collection['country'];
        $Update->pincode = $collection['pincode'];
        $Update->save();
        return $Update;
    }
     public function toggleStatus($id){
         $toggle = Customer::findOrFail($id);
         $status = ($toggle->status == 1)? 0 : 1;
         $toggle->status = $status;
         $toggle->save();
         return $toggle;
     }

    public function DeleteCustomer($id){
        $delete = Customer::findOrFail($id);
        if($delete){
            $delete->delete();
            return $delete;
        }
    }
}