<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Enquiry;
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
        $customer_name = $FetchData->fname.' '.$FetchData->lname;
        if($FetchData){
            return response()->json(['status' => 200, 'id'=>$FetchData->id, 'customer_code'=>$FetchData->customer_code, 'customer_name'=>$customer_name, 'email'=>$FetchData->email,'phone'=>$FetchData->phone]);
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
            return response()->json(['status' => 400, 'message' => 'Data Not Found !']);
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
        $Enquiry = Enquiry::findOrFail($id);
        $details = $this->EnquiryRepository->GetEnquiryDetails($id);
        // dd($details);
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

}
