<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CustomerInterface;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct(CustomerInterface $CustomerRepository){
        $this->CustomerRepository = $CustomerRepository;
    }
    public function index(){
        $data = $this->CustomerRepository->getAllCustomer();
        return view('admin.customer.index', compact('data'));
    }
    public function add(){
        return view('admin.customer.add');

    }
    public function view($id){
        $data= $this->CustomerRepository->EditCustomerDetails($id);
        return view('admin.customer.details', compact('data'));
    }
    public function edit($id){
        $data= $this->CustomerRepository->EditCustomerDetails($id);
        return view('admin.customer.edit', compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            "fname" => "required|string|max:255",
            "lname" => "required|string|max:255",
            "email" => "required|string|email|unique:customers",
            "phone" => "required|integer|unique:customers",
            "company_name" => "required|string|max:255",
            "company_phone" => "required|integer",
            "address" => "required|string|max:255",
            "city" => "required|string|max:255",
            "state" => "required|string|max:255",
            "country" => "required|string|max:255",
            "pincode" => "required|integer",
        ]);
        $data = $request->except('_token');
        $StoreData = $this->CustomerRepository->CustomerStoreData($data);
        if($StoreData){
            return redirect()->route('admin.customer.index');
        }else{
            return redirect()->route('admin.customer.index')->withInput($request->all());
        }
    }

    public function update(Request $request, $id){
        // $request->validate([
        //     "email" => "required|string|email|unique:customers",
        //     "phone" => "required|integer|unique:customers",
        // ]);
        $data = $request->except('_token');
        $UpdateData = $this->CustomerRepository->CustomerUpdateData($id, $data);
        if($UpdateData){
            return redirect()->route('admin.customer.edit', $id);
        }else{
            return redirect()->route('admin.customer.edit', $id)->withInput($request->all());
        }
    }
    public function status(Request $request, $id){
        $data = $this->CustomerRepository->toggleStatus($id);
        if($data){
           return redirect()->route('admin.customer.index');
        }else{
           return redirect()->route('admin.customer.index')->withInput($request->all());
        }
    }
    public function destroy(Request $request, $id){
        $data = $this->CustomerRepository->DeleteCustomer($id);
        if($data){
           return redirect()->route('admin.customer.index');
        }else{
           return redirect()->route('admin.customer.index')->withInput($request->all());
        }
    }
}
