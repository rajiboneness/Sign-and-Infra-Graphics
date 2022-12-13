@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div>
                            <a href="{{ route('admin.customer.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <h2 class="text-center"> New Customer</h2>
                        <hr>
                    </div>
                    <form action="{{ route('admin.customer.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fname" name="fname" value="{{old('fname')}}">
                                @error('fname') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lname" name="lname" value="{{old('lname')}}">
                                @error('lname') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                                @error('email') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-3">
                                <label for="" class="form-label">Mobile <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="mobile" name="phone" value="{{old('phone')}}">
                                @error('phone') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-3">
                                <label for="" class="form-label">WhatsApp No </label>
                                <input type="number" class="form-control" id="whatsapp" name="whatsapp" value="{{old('whatsapp')}}">
                                @error('whatsapp') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}">
                                @error('company_name') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Company Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_phone" name="company_phone" value="{{old('company_phone')}}">
                                @error('company_phone') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Website <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="website" name="website" value="{{old('website')}}">
                                @error('website') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Contact Person <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{old('contact_person')}}">
                                @error('contact_person') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-12">
                                <label for="" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="address" name="address">{{old('address')}}</textarea>
                                @error('address') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
                                @error('city') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="state" name="state" value="{{old('state')}}">
                                @error('state') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}">
                                @error('country') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Pincode <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="pincode" name="pincode" value="{{old('pincode')}}">
                                @error('pincode') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="bg-white text-end pt-4 px-4">
                            <button type="submit" class="btn btn-sm btn btn-primary">Add Customer</button>
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