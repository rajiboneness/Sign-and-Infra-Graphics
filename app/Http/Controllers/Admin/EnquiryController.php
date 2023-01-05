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

    public function index(Request $request){
        
        $data = array();
        $startDate = '';
        $endDate = '';
        $exportstatus = 10;
        if(isset($request->start_date) && $request->exportstatus == 'all'){
            $params = $request->all();
            $Enquiry = $this->EnquiryRepository->DateStatusWiseData($params);
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $exportstatus = $request->exportstatus;
         }elseif($request->exportstatus!=10  && isset($request->start_date)){ 
            //  dd($request->all());
            $params = $request->all();
            $Enquiry = $this->EnquiryRepository->DateStatusWiseData($params);
            $exportstatus = $request->exportstatus;
            $startDate = $request->start_date;
            $endDate = $request->end_date;
         }elseif($request->exportstatus==10  && isset($request->start_date)){ 
           $params = $request->all();
           $Enquiry = $this->EnquiryRepository->DateStatusWiseData($params);
           $exportstatus = $request->exportstatus;
           $startDate = $request->start_date;
           $endDate = $request->end_date;
        }elseif(isset($request->exportstatus)){
            $params = $request->all();
            $Enquiry = $this->EnquiryRepository->DateStatusWiseData($params);
            $exportstatus = $request->exportstatus;
         }else{
            $Enquiry = Enquiry::latest()->paginate(10);
         }
        //  dd($startDate, $exportstatus);
        return view('admin.enquiry.index', compact('Enquiry', 'startDate', 'endDate', 'exportstatus'));
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
    public function customer(Request $request){
        $query = $request['query'];
        $FetchData = $this->EnquiryRepository->EnquiryCustomerSearch($query);
        if(!$FetchData == null){
            return response()->json(['status' => 200, 'customer_name'=>$FetchData->name]);
        }else{
            return response()->json(['status' => 400, 'message' => 'Data Not Found !']);
        }
    }
    public function employee(Request $request){
        $query = $request['query'];
        $FetchData = $this->EnquiryRepository->EnquiryEmployeeSearch($query);
        if(!$FetchData == null){
            return response()->json(['status' => 200, 'employee_name'=>$FetchData->emp_name]);
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
    public function report(Request $request){
        
        $getEnquiry = array();
        $startDate = 0;
        $endDate = 0;
        $cname = 0;
        $ename = 0;
        if(isset($request->start_date)){
            $params = $request->all();
            $getEnquiry = $this->EnquiryRepository->DateWiseReportData($params);
            $startDate = $request->start_date;
            $endDate = $request->end_date;
         }elseif(isset($request->customer_name)){
            $params = $request->all();
            $cname = $request->customer_name;
            $getEnquiry = $this->EnquiryRepository->DateWiseReportData($params);
         }elseif(isset($request->employee_name)){
            //  dd('HERE');
            $params = $request->all();
            $ename = $request->employee_name;
            $getEnquiry = $this->EnquiryRepository->DateWiseReportData($params);
         }else{
            $getEnquiry = Enquiry::where('quotation', 1)->get();
         }
        //  dd($startDate, $cname);
        return view('admin.enquiry.report', compact('getEnquiry', 'startDate', 'endDate', 'cname', 'ename'));
    }
    public function Export(Request $request){
        if(isset($request->startDate) && $request->exportstatus == 'all'){
            // dd($request->all());
            $data = array("start_date" => "$request->startDate", "end_date"=>"$request->EndDate", "exportstatus"=>"$request->exportstatus");
            $Exportdata = $this->EnquiryRepository->DateStatusWiseData($data);
        }elseif($request->exportstatus!=10  && isset($request->startDate)){
            // dd($request->all());
            $data = array("start_date" => "$request->startDate", "end_date"=>"$request->EndDate", "exportstatus"=>"$request->exportstatus");
            $Exportdata = $this->EnquiryRepository->DateStatusWiseData($data);
        }elseif($request->exportstatus==10  && isset($request->startDate)){
            $data = array("start_date" => "$request->startDate", "end_date"=>"$request->EndDate", "exportstatus"=>"");
            $Exportdata = $this->EnquiryRepository->DateStatusWiseData($data);
        }elseif(isset($request->exportstatus)){
            $data = array("start_date" => "", "end_date"=>"", "exportstatus"=>"$request->exportstatus");
            $Exportdata = $this->EnquiryRepository->DateStatusWiseData($data);
        }else{
            $data = array("start_date" => "$request->startDate", "end_date"=>"$request->EndDate", "exportstatus"=>"");
            $Exportdata = $this->EnquiryRepository->DateStatusWiseData($data);
        }
        if (count($Exportdata) > 0) {
            $delimiter = ",";
            $filename = "SAIG-Enquiry-List-".date('Y-m-d').".csv"; 
            // Create a file pointer 
            $f = fopen('php://memory', 'w');
             // Set column headers 
             $fields = array('SR', 'Customer Name', 'Customer Mobile', 'Customer Email', 'Employee Name', 'Employee Mobile', 'Employee Email', 'Status',  'Date');  
             fputcsv($f, $fields, $delimiter);
             $count = 1;  
            foreach($Exportdata as $row) {
                $statusdata = $row['status'];
                switch ($statusdata) {
                case "0":
                    $status = "Cancelled";
                    break;
                case "1":
                    $status = "New";
                    break;
                case "2":
                    $status = "Ongoing";
                    break;
                case "3":
                    $status = "Quotation Provided";
                    break;
                default:
                    $status = "Order Generated";
                }
                // dd($getenquiryDetails);
                $datetime = date('j F, Y h:i A', strtotime($row['created_at']));
                $lineData = array($count, $row['name'],$row['phone'], $row['email'], $row['emp_name'],  $row['emp_phone'], $row['emp_email'], $status, $datetime);
                fputcsv($f, $lineData, $delimiter);
                $count++;
            }
            // Move back to beginning of file
            fseek($f, 0);
            // Set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            //output all remaining data on a file pointer
            fpassthru($f);
        }
    }
    public function reportExport(Request $request){
        // dd($request->all());
        if(!$request->customerName==0){
            $data = array("customer_name" => "$request->customerName", "employee_name"=>"");
            $Exportdata = $this->EnquiryRepository->DateWiseReportData($data);
        }elseif(!$request->employeeName==0){
            $data = array("employee_name" => "$request->employeeName","customer_name"=>"");
            $Exportdata = $this->EnquiryRepository->DateWiseReportData($data);
        }else{
            $data = array("start_date" => "$request->startDate", "end_date"=>"$request->EndDate", "customer_name"=>"", "employee_name"=>"");
            $Exportdata = $this->EnquiryRepository->DateWiseReportData($data);
        }
        if (count($Exportdata) > 0) {
            $delimiter = ",";
            $filename = "SAIG-Report-List-".date('Y-m-d').".csv"; 
            // Create a file pointer 
            $f = fopen('php://memory', 'w');
             // Set column headers 
                $fields = array('SR', 'Date', 'Customer Name', 'Employee Name', 'Quotation Date', 'Quotation Amount(GST)', 'Invoice Generate', 'Invoice Amount(GST)', 'Invoice Date'); 
             fputcsv($f, $fields, $delimiter);
             $count = 1;  
            foreach($Exportdata as $row) {
                $getQuotation = Quotation::where('enquiry_id', $row['id'])->first();
                $getInvoice = Invoice::where('enquiry_id', $row['id'])->first();
                $invoice = $row['invoice'] == 1 ? "Yes" : "No";
                $InvoiceAmount = $row['invoice'] == 1 ? 'Rs '.$getInvoice->total_amount.'('.$getInvoice->gst.')' : "Rs. 00.00";
                $invoiceDate = $row['invoice'] == 1 ? $getInvoice->created_at : ".....................";
                $Enquiry = Enquiry::where('id', $row->enquiry_id)->first();
                $datetime = date('j F, Y h:i A', strtotime($row['created_at']));
                $lineData = array($count, $datetime, $row['name'],$row['emp_name'], $getQuotation->created_at,  'Rs '.$getQuotation->total_amount.'('.$getQuotation->gst.')', $invoice, $InvoiceAmount, $invoiceDate);
                fputcsv($f, $lineData, $delimiter);
                $count++;
            }
            // Move back to beginning of file
            fseek($f, 0);
            // Set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            //output all remaining data on a file pointer
            fpassthru($f);
        }
    }

   

}
