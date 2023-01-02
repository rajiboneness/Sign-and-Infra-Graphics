<?php

namespace App\Repositories;

use App\Interfaces\EnquiryInterface;
use App\Models\Enquiry;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\EnquiryDetail;
use App\Models\Employee;
use App\Models\Note;
use App\Models\Quotation;
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
    public function EmployeeDataSearch($query)
    {
        $data = Employee::orWhere('fname', 'like', $query . '%')
        ->orWhere('lname', 'like',  $query . '%')
        ->orWhere('email', 'like', $query . '%')
        ->orWhere('phone', 'like', $query . '%')->first();
        return $data;
    }
    public function CatWistService($category_id){
        $data = Service::findOrFail($category_id);
    }
    public function EnqueryStoreData(array $arraydata){
        $collection = collect($arraydata);
        // dd($collection);
        $store = new Enquiry;
        $store->customer_id = $collection['customer_id'];
        $store->name = $collection['customer_name'];
        $store->email = $collection['customer_email'];
        $store->phone = $collection['customer_phone'];
        $store->employee_id = $collection['employee_id'];
        $store->emp_name = $collection['EmpName'];
        $store->emp_phone = $collection['EmpPhone'];
        $store->emp_email = $collection['EmpEmail'];
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
        if(isset($collection['amount'])){
            $ExtraAmount = $collection['amount'];
            $extra = $collection['extra'];
            foreach($ExtraAmount as $Extrakey => $amountData){
                $extraStore = new EnquiryDetail;
                $extraStore->enquiry_id = $store->id;
                $extraStore->rate = $amountData;
                $extraStore->extra_service = $extra[$Extrakey];
                $extraStore->save();
            }
        }
        return $arrayStore;
    }
    public function GetEnquiryById($id){
        return Enquiry::findOrFail($id);
    }
    public function EnqueryUpdateData($id, array $arraydata){
        $collection = collect($arraydata);
        // dd($collection);
        $update = Enquiry::findOrFail($id);
        $update->name = $collection['customer_name'];
        $update->email = $collection['customer_email'];
        $update->phone = $collection['customer_phone'];
        $update->customer_id = $collection['customer_id'];
        $update->employee_id = $collection['employee_id'];
        $update->emp_name = $collection['emp_name'];
        $update->emp_phone = $collection['emp_phone'];
        $update->emp_email = $collection['emp_email'];
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
        if(isset($collection['amount'])){
            $ExtraAmount = $collection['amount'];
            $extra = $collection['extra'];
            foreach($ExtraAmount as $updateKey => $amountData){
                $extra_details_id = $collection['extra_details_id'][$updateKey];
                    $extraStore = EnquiryDetail::findOrFail($extra_details_id);
                    $extraStore->enquiry_id = $update->id;
                    $extraStore->rate = $amountData;
                    $extraStore->extra_service = $extra[$updateKey];
                    $extraStore->save();
            }
        }
       
        if(isset($collection['amount_new'])){
            $ExtraAmount_new = $collection['amount_new'];
            $extra_new = $collection['extra_new'];
            foreach($ExtraAmount_new as $newKey => $newData){
                $extraStore = new EnquiryDetail;
                $extraStore->enquiry_id = $update->id;
                $extraStore->rate = $newData;
                $extraStore->extra_service = $extra_new[$newKey];
                $extraStore->save();
            }
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
        $toggle = Enquiry::findOrFail($request->id);
        $toggle->status = $request->status;
        $toggle->save();
        return $toggle;
    }
    public function GetExtraEnquiryDetails($id){
        return EnquiryDetail::where('enquiry_id', $id)->where('service_id', '=', null)->get();
    }
    public function GetEnquiryDetails($id){
        return EnquiryDetail::where('enquiry_id', $id)->where('service_id', '!=', null)->get();
    }
    public function InvoiceStoreData(array $Enquiry){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y H:i:s');
        $collection = collect($Enquiry);
        $updateInvoice = Invoice::where('invoice_code', $collection['invoiceCode'])->first();
        $updateInvoice->items = $collection['totalitems'];
        $updateInvoice->quantity = $collection['quantity'];
        $updateInvoice->gst = $collection['gst'];
        $updateInvoice->total_amount = $collection['grandTotal'];
        $updateInvoice->created_at = $date;
        $updateInvoice->updated_at = $date;
        $updateInvoice->save();
        return $updateInvoice;
    }
    public function QuotationStoreData(array $Enquiry){
        $collection = collect($Enquiry);
        $ExistQuotation = Quotation::where('quotation_code', $collection['invoiceCode'])->first();
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y H:i:s');
        if(isset($ExistQuotation)){
            $ExistQuotation->quotation_code = $collection['invoiceCode'];
            $ExistQuotation->enquiry_id = $collection['enquiry_id'];
            $ExistQuotation->items = $collection['totalitems'];
            $ExistQuotation->quantity = $collection['quantity'];
            $ExistQuotation->gst = $collection['gst'];
            $ExistQuotation->total_amount = $collection['grandTotal'];
            $ExistQuotation->created_at = $date;
            $ExistQuotation->updated_at = $date;
            $ExistQuotation->save();
            return $ExistQuotation;
        }else{
            $updateInvoice = new Quotation;
            $updateInvoice->quotation_code = $collection['invoiceCode'];
            $updateInvoice->enquiry_id = $collection['enquiry_id'];
            $updateInvoice->items = $collection['totalitems'];
            $updateInvoice->quantity = $collection['quantity'];
            $updateInvoice->gst = $collection['gst'];
            $updateInvoice->total_amount = $collection['grandTotal'];
            $updateInvoice->created_at = $date;
            $updateInvoice->updated_at = $date;
            $updateInvoice->save();
            return $updateInvoice;
        }
        
    }

    // Invoice Management

    public function GetAllInvoice(){
        return Invoice::latest('id')->get();
    }
    public function EnquiryIdWiseNotes($id){
        $getDetails = Note::where('enquiry_id', $id)->latest('id')->get();
        return $getDetails;
    }
    public function EnqueryNoteStore(array $arraydata){
        $collection = collect($arraydata);
        // dd($collection);
        $store = new Note;
        $store->enquiry_id = $collection['enquiry_id'];
        $store->notes = $collection['notes'];
        $store->save();
        return $store;
    }
    public function EnqueryNoteUpdate($id, array $arraydata){
        $collection = collect($arraydata);
        // dd($collection);
        $update = Note::findOrFail($id);
        $update->enquiry_id = $collection['enquiry_id'];
        $update->notes = $collection['notes'];
        $update->save();
        return $update;
    }
   
}