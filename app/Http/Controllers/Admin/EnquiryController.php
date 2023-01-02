<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Note;
use App\Models\Quotation;
use App\Models\EnquiryDetail;
use App\Interfaces\EnquiryInterface;

class EnquiryController extends Controller
{
    public function __construct(EnquiryInterface $EnquiryRepository){
        $this->EnquiryRepository = $EnquiryRepository;
    }

    public function index(){
        $Enquiry = Enquiry::latest()->paginate(10);
        return view('admin.enquiry.index', compact('Enquiry'));
    }
    public function add(){
        $Category = Category::where('status', 1)->get();
        $Service = Service::where('status', 1)->get();
        return view('admin.enquiry.add', compact('Service', 'Category'));
    }
    public function ajaxsearch(Request $request){
        $query = $request['query'];
        $FetchData = $this->EnquiryRepository->CustomerDataSearch($query);
        if(!$FetchData == null){
            $customer_name = $FetchData->fname.' '.$FetchData->lname;
            return response()->json(['status' => 200, 'id'=>$FetchData->id, 'customer_code'=>$FetchData->customer_code, 'customer_name'=>$customer_name, 'email'=>$FetchData->email,'phone'=>$FetchData->phone]);
        }else{
            return response()->json(['status' => 400, 'message' => 'Data Not Found !']);
        }
    }
    public function employeesearch(Request $request){
        $query = $request['query'];
        $FetchData = $this->EnquiryRepository->EmployeeDataSearch($query);
        if(!$FetchData == null){
            $employee_name = $FetchData->fname.' '.$FetchData->lname;
            return response()->json(['status' => 200, 'id'=>$FetchData->id, 'employee_name'=>$employee_name, 'email'=>$FetchData->email,'phone'=>$FetchData->phone]);
        }else{
            return response()->json(['status' => 400, 'message' => 'Data Not Found !']);
        }
    }
    public function category_wise_service(Request $request){
        $category_id = $request['category_id'];
        $FetchData = $this->EnquiryRepository->CatWistService($category_id);
        if($FetchData){
            return response()->json(['status' => 200, 'data'=>$FetchData]);
        }else{
            return response()->json(['status' => 400, 'message' => "Data Not Found !"]);
        }
    }
    public function store(Request $request){
        // dd($request->all());
        $data = $request->except('_token');
        $StoreData = $this->EnquiryRepository->EnqueryStoreData($data);
        if($StoreData){
            return redirect()->route('admin.enquiry.index');
        }else{
            return redirect()->route('admin.enquiry.index')->withInput($request->all());
        }
    }
    public function preview(Request $request){
        // dd($request->all());
        $category = $request->category;
        $service = $request->service;
        $width = $request->width;
        $height = $request->height;
        $quantity = $request->quantity;
        $rate = $request->rate;
        $data = array("employee_id" => "$request->employee_id", "EmpName" => "$request->EmpName", "EmpPhone" => "$request->EmpPhone", "EmpEmail" => "$request->EmpEmail", "customer_id" => "$request->customer_id", "customer_name" => "$request->customer_name", "customer_phone" => "$request->customer_phone", "customer_email" => "$request->customer_email");
        // dd($data);
        if($request->extra){
           $extra = $request->extra;
           $amount = $request->amount;
            return view('admin.enquiry.preview', compact('data', 'category', 'service', 'width', 'height', 'quantity', 'rate', 'extra', 'amount'));
        }else{
            return view('admin.enquiry.preview', compact('data', 'category', 'service', 'width', 'height', 'quantity', 'rate'));
        }
    }
    public function edit($id){
        $Category = Category::where('status', 1)->get();
        $Service = Service::where('status', 1)->get();
        $Enquiry = Enquiry::findOrFail($id);
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        $extra = $this->EnquiryRepository->GetExtraEnquiryDetails($id);
        return view('admin.enquiry.edit', compact('details', 'Category', 'Service', 'Enquiry', 'extra'));
    }
    public function view($id){
        $Enquiry = Enquiry::findOrFail($id);
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        $extra = $this->EnquiryRepository->GetExtraEnquiryDetails($id);
        // dd($details);
        return view('admin.enquiry.details', compact('details', 'Enquiry', 'extra'));
    }
    public function update(Request $request, $id){
        // dd($request->all());
        $data = $request->except('_token');
        $updateData = $this->EnquiryRepository->EnqueryUpdateData($id, $data);
        if($updateData){
            return redirect()->route('admin.enquiry.index');
        }else{
            return redirect()->route('admin.enquiry.index')->withInput($request->all());
        }
    }
    public function destroy(Request $request, $id){
        $data = $this->EnquiryRepository->DeleteEnquiry($id);
        if($data){
           return redirect()->route('admin.enquiry.index');
        }else{
           return redirect()->route('admin.enquiry.index')->withInput($request->all());
        }
    }
    public function invoice($id){
        $Enquiry = Invoice::where('enquiry_id', $id)->first();
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        $extra = $this->EnquiryRepository->GetExtraEnquiryDetails($id);
        // dd($extra);
        return view('admin.enquiry.invoice', compact('details', 'Enquiry', 'extra'));
    }
    public function status(Request $request){
        $data = $this->EnquiryRepository->toggleStatus($request);
        if($data){
            return response()->json(['status' => 200, 'data' => $data->status]);
         }else{
            return response()->json(['status' => 400]);
         }
    }
    public function detailsDelete($id){
        $data = $this->EnquiryRepository->DeleteEnquiryDetails($id);
        if($data){
           return redirect()->route('admin.enquiry.edit',$data);
        }else{
           return redirect()->route('admin.enquiry.edit', $data)->withInput($request->all());
        }
    }
    public function InvoiceStore($id){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y H:i:s');
        $Invoicestr = 0;
        $Enquiry = Enquiry::findOrFail($id);
        $getDetails = EnquiryDetail::where('enquiry_id', $Enquiry->id)->get();
        $quantity = array();
        $total_amount = array();
        foreach($getDetails as $details){
            $quantity[] = $details->quantity;
            $total_amount[] = $details->amount;
        }
        $Invoice = Invoice::latest('id')->first();
        // SIG/008/22-23
        // $currentYear = date('d M Y', strtotime(date('Y')));
        //     $current = substr($currentYear, 9);
        //     $before = $current-1;
        if($Invoice){
           $Invoicestr = substr($Invoice['invoice_code'], 10);
        //    $Invoicestr2 = substr($Invoicestr, 0,1);
        }
        $code = $Invoicestr+1;

        $switch = strlen($code);
        switch($switch){      
        case 1:      
            $finalCode = '000'.$code;
            //code to be executed  
            break;  
        case 2:      
            $finalCode = '00'.$code;
            break;  
        case 3:      
            $finalCode = '0'.$code;
            break;  
        default:    
            $finalCode = $code;   
        }  
        // I1923CO000000429
        $randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
        $rand = mt_rand(1000,9999);
        $invoiceCode = 'SIG'.$rand.$randomletter.$finalCode;

        $getInvoice = Invoice::where('enquiry_id', $id)->first();
        if($getInvoice){
            $getInvoice->delete();
        }
        $enquiryUpdate = Enquiry:: findOrFail($id);
        $enquiryUpdate->invoice = 1;
        $enquiryUpdate->save();
        $store = new Invoice;
        $store->invoice_code = $invoiceCode;
        $store->enquiry_id = $id;
        $store->customer_id = $Enquiry['customer_id'];
        $store->employee_id = $Enquiry['employee_id'];
        $store->items = count($getDetails);
        $store->quantity = array_sum($quantity);
        $store->total_amount = array_sum($total_amount);
        $store->gst = 0;
        $store->created_at = $date;
        $store->updated_at = $date;
        $store->save();
        return redirect()->route('admin.enquiry.index');
    }
    public function quotation($id){
        
        $getQuotation = Quotation::where('enquiry_id', $id)->first();
        $Enquiry = $this->EnquiryRepository->GetEnquiryById($id);
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        $extra = $this->EnquiryRepository->GetExtraEnquiryDetails($id);
        $currentYear = date('d M Y', strtotime(date('Y')));
        $current = substr($currentYear, 9);
        $before = $current-1;
        $code = $id+1;

        $switch = strlen($code);
        switch($switch){      
        case 1:      
            $finalCode = '000'.$code;
            //code to be executed  
            break;  
        case 2:      
            $finalCode = '00'.$code;
            break;  
        case 3:      
            $finalCode = '0'.$code;
            break;  
        default:    
            $finalCode = $code;   
        }  
        $invoiceCode = 'SIG/'.$finalCode.'/'.$before.'-'.$current;
        return view('admin.enquiry.quotation', compact('details', 'Enquiry', 'invoiceCode', 'getQuotation', 'extra'));
    }
    public function QuotationStatus($id){
        $enquiryUpdate = Enquiry:: findOrFail($id);
        $enquiryUpdate->quotation = 1;
        $enquiryUpdate->save();
        return redirect()->route('admin.enquiry.index');
    }

    public function InvoiceUpdate(Request $request){
        $data = $request->except('_token');
        $UpdateData = $this->EnquiryRepository->InvoiceStoreData($data);
        if($UpdateData){
            return response()->json(["status" => 200]);
        }else{
            return response()->json(["status" => 400]);
        }
    }
    
    public function QuotationStore(Request $request){
        $data = $request->except('_token');
        $UpdateData = $this->EnquiryRepository->QuotationStoreData($data);
        if($UpdateData){
            return response()->json(["status" => 200]);
        }else{
            return response()->json(["status" => 400]);
        }
    }

    public function allNotes($id){
        $data = $this->EnquiryRepository->EnquiryIdWiseNotes($id);
        // if(count($data)){
            return view('admin.enquiry.notes', compact('data', 'id'));
        // }else{
        //     return view('admin.enquiry.notes', compact('data'));
        // }
    }
    public function addNotes(Request $request){
        $data = $request->except('_token');
        $StoreData = $this->EnquiryRepository->EnqueryNoteStore($data);
        if($StoreData){
            return redirect()->route('admin.enquiry.notes', $request->enquiry_id);
        }else{
            return redirect()->route('admin.enquiry.notes', $request->enquiry_id)->withInput($request->all());
        }
    }
    public function editNotes(Request $request, $id){
        $data = $request->except('_token');
        $updateData = $this->EnquiryRepository->EnqueryNoteUpdate($id, $data);
        if($updateData){
            return redirect()->route('admin.enquiry.notes', $request->enquiry_id);
        }else{
            return redirect()->route('admin.enquiry.notes', $request->enquiry_id)->withInput($request->all());
        }
    }
    public function deleteNotes($id){
        $getInvoice = Note::findOrFail($id);
        if($getInvoice){
            $getInvoice->delete();
            return redirect()->route('admin.enquiry.notes', $getInvoice->enquiry_id);
        }else{
            return redirect()->route('admin.enquiry.notes', $getInvoice->enquiry_id);
        }
    }
    public function report(){
        $getEnquiry = Enquiry::where('quotation', 1)->get();
        return view('admin.enquiry.report', compact('getEnquiry'));
    }

    // Invoice Management
    public function allInvoice(){
        $data = $this->EnquiryRepository->GetAllInvoice();
        return view('admin.invoice.index', compact('data'));
    }

}
