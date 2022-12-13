<?php

namespace App\Repositories;

use App\Interfaces\ServiceInterface;
use App\Models\Service;
use Illuminate\Http\UploadedFile;

class ServiceRepository implements ServiceInterface 
{
    // use UploadAble;

    public function getAllService()
    {
        return Service::latest('id')->with('category')->paginate(10);
    }
    
    public function ServiceStoreData(array $arrayData){

        $collection = collect($arrayData);
        $Store = new Service;
        $Store->name = ucwords($collection['name']);
        $Store->category_id = $collection['category'];
        $Store->save();
        return $Store;
    }
    public function ServiceUpdateData($id, array $arrayData){
        $collection = collect($arrayData);
        $Update = Service::findOrFail($id);
        $Update->category_id = $collection['Edit_category'];
        $Update->name = ucwords($collection['edit_name']);
        $Update->save();
        return $Update;
    }
     public function toggleStatus($id){
         $toggle = Service::findOrFail($id);
         $status = ($toggle->status == 1)? 0 : 1;
         $toggle->status = $status;
         $toggle->save();
         return $toggle;
     }

    public function DeleteService($id){
        $delete = Service::findOrFail($id);
        if($delete){
            $delete->delete();
            return $delete;
        }
    }
}