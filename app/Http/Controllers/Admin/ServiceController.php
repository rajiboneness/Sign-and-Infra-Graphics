<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ServiceInterface;
use App\Models\Category;
class ServiceController extends Controller
{
    public function __construct(ServiceInterface $ServiceRepository){
        $this->ServiceRepository = $ServiceRepository;
    }

    public function index(){
        $data = $this->ServiceRepository->getAllService();
        $category = Category::latest('id')->where('status', 1)->get();
        return view('admin.service.index', compact('data', 'category'));
    }
    public function store(Request $request){
        $request->validate([
            "name" => "required|string|max:255",
        ]);
        $data = $request->except('_token');
        $StoreData = $this->ServiceRepository->ServiceStoreData($data);
        if($StoreData){
            return redirect()->route('admin.service.index');
        }else{
            return redirect()->route('admin.service.index')->withInput($request->all());
        }
    }

    public function update(Request $request, $id){
        $data = $request->except('_token');
        $UpdateData = $this->ServiceRepository->ServiceUpdateData($id, $data);
        if($UpdateData){
            return redirect()->route('admin.service.index');
        }else{
            return redirect()->route('admin.service.index')->withInput($request->all());
        }
    }
    public function status(Request $request, $id){
        $data = $this->ServiceRepository->toggleStatus($id);
        if($data){
           return redirect()->route('admin.service.index');
        }else{
           return redirect()->route('admin.service.index')->withInput($request->all());
        }
    }
    public function destroy(Request $request, $id){
        $data = $this->ServiceRepository->DeleteService($id);
        if($data){
           return redirect()->route('admin.service.index');
        }else{
           return redirect()->route('admin.service.index')->withInput($request->all());
        }
    }
}
