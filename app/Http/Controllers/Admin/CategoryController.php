<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CategoryInterface;

class CategoryController extends Controller
{
    public function __construct(CategoryInterface $CategoryRepository){
        $this->CategoryRepository = $CategoryRepository;
    }

    public function index(){
        $data = $this->CategoryRepository->getAllCategory();
        return view('admin.category.index', compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            "name" => "required|string|max:255",
        ]);
        $data = $request->except('_token');
        $StoreData = $this->CategoryRepository->CategoryStoreData($data);
        if($StoreData){
            return redirect()->route('admin.category.index');
        }else{
            return redirect()->route('admin.category.index')->withInput($request->all());
        }
    }

    public function update(Request $request, $id){
        $data = $request->except('_token');
        $UpdateData = $this->CategoryRepository->CategoryUpdateData($id, $data);
        if($UpdateData){
            return redirect()->route('admin.category.index');
        }else{
            return redirect()->route('admin.category.index')->withInput($request->all());
        }
    }
    public function status(Request $request, $id){
        $data = $this->CategoryRepository->toggleStatus($id);
        if($data){
           return redirect()->route('admin.category.index');
        }else{
           return redirect()->route('admin.category.index')->withInput($request->all());
        }
    }
    public function destroy(Request $request, $id){
        $data = $this->CategoryRepository->DeleteCategory($id);
        if($data){
           return redirect()->route('admin.category.index');
        }else{
           return redirect()->route('admin.category.index')->withInput($request->all());
        }
    }
    
}
