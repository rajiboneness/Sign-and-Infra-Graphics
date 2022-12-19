<?php

namespace App\Repositories;

use App\Interfaces\EnquiryInterface;
use App\Models\Enquiry;
use App\Models\Customer;
use App\Models\Service;
use App\Models\EnquiryDetail;
use Illuminate\Http\UploadedFile;
use DB;

class EnquiryRepository implements EnquiryInterface 
{
    // use UploadAble;

    public function CustomerDataSearch($query)
    {
        $data = Customer::orWhere('fname', 'like', $query . '%')
        ->orWhere('lname', 'like',  $query . '%')
        ->orWhere('email', 'like', $query . '%')
        ->orWhere('phone', 'like', $query . '%')
        ->orWhere('customer_code', 'like', $query . '%')->first();
        return $data;
    }
    public function CatWistService($category_id){
        $data = Service::findOrFail($category_id);
    }
    public function EnqueryStoreData(array $arraydata){
        $collection = collect($arraydata);
        $store = new Enquiry;
        $store->customer_id = $collection['customer_id'];
        $store->name = $collection['customer_name'];
        $store->email = $collection['customer_email'];
        $store->phone = $collection['customer_phone'];
        // $store->category_id = $collection['category'];
        // $store->service_id = $collection['service'];
        // $store->width = $collection['width'];
        // $store->height = $collection['height'];
        $store->save();
        $categories = $collection['category'];
        foreach($categories as $key =>$data){
            $arrayStore = new EnquiryDetail;
            $arrayStore->enquiry_id = $store->id;
            $arrayStore->category_id = $data;
            $amount =  $collection['quantity'][$key] *  $collection['rate'][$key];
            $arrayStore->quantity = $collection['quantity'][$key];
            $arrayStore->rate = $collection['rate'][$key];
            $arrayStore->service_id = $collection['service'][$key];
            $arrayStore->width = $collection['width'][$key];
            $arrayStore->height = $collection['height'][$key];
            $arrayStore->amount = $amount;
            $arrayStore->save();
        }
        return $arrayStore;
    }
    public function EnqueryUpdateData($id, array $arraydata){
        $collection = collect($arraydata);
        // dd($collection);
        $update = Enquiry::findOrFail($id);
        $update->name = $collection['customer_name'];
        $update->email = $collection['customer_email'];
        $update->phone = $collection['customer_phone'];
        $update->save();
        $category_new = $collection['category_new'];
        // dd($category_new);
            $i = 0;
            foreach($category_new as $key =>$new_data){
                if($key != 0){
                    $arrayStore_new = new EnquiryDetail;
                    $arrayStore_new->enquiry_id = $id;
                    $amount =  $collection['quantity_new'][$key] *  $collection['rate_new'][$key];
                    $arrayStore_new->category_id = $new_data;
                    $arrayStore_new->quantity = $collection['quantity_new'][$key];
                    $arrayStore_new->rate = $collection['rate_new'][$key];
                    $arrayStore_new->service_id = $collection['service_new'][$key];
                    $arrayStore_new->width = $collection['width_new'][$key];
                    $arrayStore_new->height = $collection['height_new'][$key];
                    $arrayStore_new->amount = $amount;
                    $arrayStore_new->save();
                }
            }
            // echo '<pre>'; print_r($category_new); die;
        // update
        $categories = $collection['category'];
        // dd($categories);
        foreach($categories as $key =>$data){
            $details_id = $collection['enquiry_details_id'][$key];
            $arrayStore = EnquiryDetail::findOrFail($details_id);
            $arrayStore->enquiry_id = $update->id;
            $amount =  $collection['quantity'][$key] *  $collection['rate'][$key];
            $arrayStore->category_id = $data;
            $arrayStore->quantity = $collection['quantity'][$key];
            $arrayStore->rate = $collection['rate'][$key];
            $arrayStore->service_id = $collection['service'][$key];
            $arrayStore->width = $collection['width'][$key];
            $arrayStore->height = $collection['height'][$key];
            $arrayStore->amount = $amount;
            $arrayStore->save();
        }
        return $arrayStore;
    }
    public function DeleteEnquiry($id){
        EnquiryDetail::where('enquiry_id',$id)->delete();
        Enquiry::where('id',$id)->delete();
        return true;
    }
    public function DeleteEnquiryDetails($id){
        $delete = EnquiryDetail::findOrFail($id);
        // $delete = EnquiryDetail::where('id',$id)->delete();
        $delete->delete();
        return $delete->enquiry_id;
    }
    public function toggleStatus($request){
        $toggle = Enquiry::findOrFail($request->enquiry_id);
        $toggle->status = $request->status;
        $toggle->save();
        return $toggle;
    }
    public function GetEnquiryDetails($id){
        return EnquiryDetail::where('enquiry_id', $id)->get();
    }
   
}