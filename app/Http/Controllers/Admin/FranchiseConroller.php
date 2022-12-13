<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\FrnachiseInterface;

class FranchiseConroller extends Controller
{
    public function __construct(FrnachiseInterface $FranchiseRepository){
        $this->FranchiseRepository = $FranchiseRepository;
    }
    public function index(){
        $data = $this->FranchiseRepository->getAllVendors();
        return view('admin.franchise.index', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|string|max:255",
            "mobile" => "required|integer",
            "pincode" => "required|integer",
            "address" => "required|string|max:555"
            // "image" => "required|mimes:jpg,jpeg,png,svg,gif|max:10000000"
        ]);
        $params = $request->except('_token');
        $storeData = $this->FranchiseRepository->CreateVendor($params);
        if($storeData){
            return redirect()->route('admin.franchise.index');
        }else{
            return redirect()->route('admin.franchise.index')->withInput($request->all());
        }
    }

    public function view($id){
        $vendor = $this->FranchiseRepository->getVendorById($id);
        return view('admin.franchise.details', compact('vendor'));
    }
    public function update(Request $request, $id){
        $request->validate([
            "name" => "required|string|max:255",
            "hname" => "required|string|max:255",
            "email" => "required|email|string|max:255",
            "mobile" => "required|integer",
            "pincode" => "required|integer",
            "address" => "required|string|max:555"
            // "image" => "required|mimes:jpg,jpeg,png,svg,gif|max:10000000"
        ]);
        $params = $request->except('_token');
        $storeData = $this->FranchiseRepository->UpdateVendor($id, $params);
        if($storeData){
            return redirect()->route('admin.franchise.view', $id);
        }else{
            return redirect()->route('admin.franchise.view', $id)->withInput($request->all());
        }
    }

    public function status(Request $request, $id){
        $data = $this->FranchiseRepository->toggleStatus($id);
        if($data){
           return redirect()->route('admin.franchise.index');
        }else{
           return redirect()->route('admin.franchise.index')->withInput($request->all());
        }
    }
    public function destroy(Request $request, $id){
        $data = $this->FranchiseRepository->Deletevendor($id);
        if($data){
           return redirect()->route('admin.franchise.index');
        }else{
           return redirect()->route('admin.franchise.index')->withInput($request->all());
        }
    }
}
