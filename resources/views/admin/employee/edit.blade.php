@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div>
                            <a href="{{ route('admin.employee.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <h2 class="text-center"> Update Employee</h2>
                        <hr>
                    </div>
                    <form action="{{ route('admin.employee.update', $data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fname" name="fname" value="{{$data->fname}}">
                                @error('fname') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lname" name="lname" value="{{$data->lname}}">
                                @error('lname') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}">
                                @error('email') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Mobile <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="phone" name="phone" value="{{$data->phone}}">
                                @error('phone') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{$data->designation}}">
                                @error('designation') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Joining Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{$data->joining_date}}">
                                @error('joining_date') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-12">
                                <label for="" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="address" name="address">{{ $data->address }}</textarea>
                                @error('address') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="bg-white text-end pt-4 px-4">
                            <button type="submit" class="btn btn-sm btn btn-primary">Add Employee</button>
                        </div>
                    </form>
                </div>
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