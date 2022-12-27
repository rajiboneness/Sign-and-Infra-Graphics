<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\EnquiryDetail;
use App\Interfaces\EnquiryInterface;

class EnquiryController extends Controller
{
    public function __construct(EnquiryInterface $EnquiryRepository){
        $this->EnquiryRepository = $EnquiryRepository;
    }

    public function index(){
        $Enquiry = Enquiry::latest()->paginate(10);
        // dd($Enquiry);
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
        $data = $request->except('_token');
        $StoreData = $this->EnquiryRepository->EnqueryStoreData($data);
        if($StoreData){
            return redirect()->route('admin.enquiry.index');
        }else{
            return redirect()->route('admin.enquiry.index')->withInput($request->all());
        }
    }
    public function edit($id){
        $Category = Category::where('status', 1)->get();
        $Service = Service::where('status', 1)->get();
        $Enquiry = Enquiry::findOrFail($id);
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        return view('admin.enquiry.edit', compact('details', 'Category', 'Service', 'Enquiry'));
    }
    public function view($id){
        $Enquiry = Enquiry::findOrFail($id);
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        // dd($details);
        return view('admin.enquiry.details', compact('details', 'Enquiry'));
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
        return view('admin.enquiry.invoice', compact('details', 'Enquiry'));
    }
    public function status(Request $request){
        // dd($request->all());
        $data = $this->EnquiryRepository->toggleStatus($request);
        if($data){
            return redirect()->route('admin.enquiry.index');
         }else{
            return redirect()->route('admin.enquiry.index')->withInput($request->all());
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
        $Invoicestr2 = 0;
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
        $currentYear = date('d M Y', strtotime(date('Y')));
            $current = substr($currentYear, 9);
            $before = $current-1;
        if($Invoice){
           $Invoicestr = substr($Invoice['invoice_code'], 4);
           $Invoicestr2 = substr($Invoicestr, 0,-6);
        }
        $code = $Invoicestr2+1;

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

        $getInvoice = Invoice::where('enquiry_id', $id)->first();
        if($getInvoice){
            $getInvoice->delete();
        }
        $enquiryUpdate = Enquiry:: findOrFail($id);
        $enquiryUpdate->quotation = 1;
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
        $store->save();
        // $store->items = $Enquiry['totalitems'];
        // $store->quantity = $Enquiry['quantity'];
        // $store->gst = $Enquiry['gst'];
        // $store->total_amount = $Enquiry['grandTotal'];
        // return $store;
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



    // Invoice Management
    public function allInvoice(){
        $data = $this->EnquiryRepository->GetAllInvoice();
        return view('admin.invoice.index', compact('data'));
    }

}
