<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

class CategoryRepository implements CategoryInterface 
{
    // use UploadAble;

    public function getAllCategory() 
    {
        return Category::latest('id')->paginate(10);
    }
    
    public function CategoryStoreData(array $arrayData){

        $collection = collect($arrayData);
        $Store = new Category;
        $Store->name = ucwords($collection['name']);
        $Store->save();
        return $Store;
    }
    public function CategoryUpdateData($id, array $arrayData){
        $collection = collect($arrayData);
        $Update = Category::findOrFail($id);
        $Update->name = ucwords($collection['edit_name']);
        $Update->save();
        return $Update;
    }
     public function toggleStatus($id){
         $toggle = Category::findOrFail($id);
         $status = ($toggle->status == 1)? 0 : 1;
         $toggle->status = $status;
         $toggle->save();
         return $toggle;
     }

    public function DeleteCategory($id){
        $delete = Category::findOrFail($id);
        if($delete){
            $delete->delete();
            return $delete;
        }
    }
}