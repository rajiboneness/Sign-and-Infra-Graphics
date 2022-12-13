@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-8">
                <div class="bg-white rounded h-100 p-4">
                    <h6 class="mb-4">Service List</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if ($data)
                                    @foreach($data as $key =>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->name }}</p>
                                            <div class="row__action">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#registereditModal{{ $key+1 }}">Edit </a><span>|</span>
                                                <a href="javascript:void(0)" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key+1 }}"> delete</a>                                                
                                            </div>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="registereditModal{{ $key+1 }}" tabindex="-1" aria-labelledby="registereditModalLabel{{ $key+1 }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.service.update', $value->id) }}" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="registereditModalLabel{{ $key+1 }}">Service Edit</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    @csrf
                                                                    <label for="" class="form-label">Category
                                                                        <span class="text-danger">*</span></label>
                                                                    <select name="Edit_category" id="Edit_category" class="form-control">
                                                                        <option value="">Select Category..</option>
                                                                        @foreach($category as $catData)
                                                                            <option value="{{ $catData->id }}" {{ $catData->id==$value->category_id ? 'Selected' : ''}}>{{ $catData->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="" class="form-label pt-2">Name
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{$value->name}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal">
                                                    <div class="modal-content">
                                                        <div><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.service.delete', $value->id) }}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $value->category->name }}</td>
                                        <td> <a href="{{ route('admin.service.status', $value->id) }}" class="badge {{ $value->status==1 ? "success-btn" : "danger-btn"}}">{{ $value->status== 1 ?"Active" : "Inactive" }}</a>
                                        </td>
                                        <td>
                                            {{date('d M Y', strtotime($value->created_at))}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{$data->links()}}
                    </div>


                </div>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ asset(route('admin.service.store')) }}">
                    @csrf
                    <div class="bg-white rounded h-100 p-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Category
                            <span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category..</option>
                                @foreach($category as $catData)
                                    <option value="{{ $catData->id }}">{{ $catData->name }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Service Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            @error('name') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="bg-white text-end pt-4 px-4">
                            <button type="submit" class="btn btn-sm btn btn-primary">Add Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
  
@endsection
@section('script')
<script>
    $(document).ready( function () {
    $('#vendorTable').DataTable();
} );
</script>
@endsection