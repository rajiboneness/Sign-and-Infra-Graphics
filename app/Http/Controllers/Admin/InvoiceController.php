<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\InvoiceInterface;
use App\Models\Invoice;
use App\Models\Enquiry;

class InvoiceController extends Controller
{
    public function __construct(InvoiceInterface $InvoiceRepository){
        $this->InvoiceRepository = $InvoiceRepository;
    }
     // Invoice Management
    public function allInvoice(Request $request){
        $data = array();
        $startDate = "";
        $endDate = "";
        $invoice_code = "";
         if(isset($request->invoice_code)){
            $params = $request->all();
            $data = $this->InvoiceRepository->DateWiseInvoiceData($params);
            $invoice_code = $request->invoice_code;
            $startDate = "";
         }elseif(isset($request->start_date)){
            $params = $request->all();
            $data = $this->InvoiceRepository->DateWiseInvoiceData($params);
            $startDate = $request->start_date;
            $endDate = $request->end_date;
         }else{
            $data = $this->InvoiceRepository->GetAllInvoice();
         }
         return view('admin.invoice.index', compact('data', 'startDate', 'endDate', 'invoice_code'));
    }
    public function exportData(Request $request){
// dd($request->all());
        if($request->invoiceCode){
            $data = array("invoice_code"=>"$request->invoiceCode");
            $Exportdata = $this->InvoiceRepository->DateWiseInvoiceData($data);
        }else{
            $data = array("start_date" => "$request->startDate", "end_date"=>"$request->EndDate", "invoice_code"=>"");
            $Exportdata = $this->InvoiceRepository->DateWiseInvoiceData($data);
        }
        if (count($Exportdata) > 0) {
            $delimiter = ",";
            $filename = "SAIG-Invoice-List-".date('Y-m-d').".csv"; 
            // Create a file pointer 
            $f = fopen('php://memory', 'w');
             // Set column headers 
                $fields = array('SR', 'Invoice Code', 'Name', 'Mobile', 'Email', 'Total Items', 'Total Quantity', 'Toral Amount', 'GST', 'Employee Name', 'Employee Mobile', 'Employee Email',  'Date'); 
             fputcsv($f, $fields, $delimiter);
             $count = 1;  
            foreach($Exportdata as $row) {
                $Enquiry = Enquiry::where('id', $row->enquiry_id)->first();
                $datetime = date('j F, Y h:i A', strtotime($row['created_at']));
                $lineData = array($count, $row['invoice_code'], $Enquiry->name, $Enquiry->phone, $Enquiry->email, $row['items'],$row['quantity'], 'Rs '.$row['total_amount'],  $row['gst'], $Enquiry->emp_name, $Enquiry->emp_phone, $Enquiry->emp_email, $datetime );
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
        }else{

        }
    }
}
