<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\EmployeeInterface;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct(EmployeeInterface $EmployeeRepository){
        $this->EmployeeRepository = $EmployeeRepository;
    }
    public function index(){
        $data = $this->EmployeeRepository->getAllEmployee();
        return view('admin.employee.index', compact('data'));
    }
    public function add(){
        return view('admin.employee.add');

    }
    public function view($id){
        $data= $this->EmployeeRepository->EditEmployeeDetails($id);
        return view('admin.employee.details', compact('data'));
    }
    public function edit($id){
        $data= $this->EmployeeRepository->EditEmployeeDetails($id);
        return view('admin.employee.edit', compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            "fname" => "required|string|max:255",
            "lname" => "required|string|max:255",
            "email" => "required|string|email|unique:employees",
            "phone" => "required|integer|unique:employees",
            "address" => "required|string",
            "designation" => "required|string",
            "joining_date" => "required|string",
        ]);
        $data = $request->except('_token');
        $StoreData = $this->EmployeeRepository->EmployeeStoreData($data);
        if($StoreData){
            return redirect()->route('admin.employee.index');
        }else{
            return redirect()->route('admin.employee.index')->withInput($request->all());
        }
    }

    public function update(Request $request, $id){
        // $request->validate([
        //     "email" => "required|string|email|unique:employees",
        //     "phone" => "required|integer|unique:employees",
        // ]);
        $data = $request->except('_token');
        $UpdateData = $this->EmployeeRepository->EmployeeUpdateData($id, $data);
        if($UpdateData){
            return redirect()->route('admin.employee.edit', $id);
        }else{
            return redirect()->route('admin.employee.edit', $id)->withInput($request->all());
        }
    }
    public function status(Request $request, $id){
        $data = $this->EmployeeRepository->toggleStatus($id);
        if($data){
           return redirect()->route('admin.employee.index');
        }else{
           return redirect()->route('admin.employee.index')->withInput($request->all());
        }
    }
    public function destroy(Request $request, $id){
        $data = $this->EmployeeRepository->DeleteEmployee($id);
        if($data){
           return redirect()->route('admin.employee.index');
        }else{
           return redirect()->route('admin.employee.index')->withInput($request->all());
        }
    }
}
