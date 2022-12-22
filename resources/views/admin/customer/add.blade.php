@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div>
                            <a href="{{ route('admin.customer.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <h2 class="text-center"> New Customer</h2>
                        <hr>
                    </div>
                    <form action="{{ route('admin.customer.store') }}" method="POST" id="addCustomerForm">
                        @csrf
                        <div class="row">
                            {{-- <p class="form_header"><strong>Personal Details</strong></p> --}}
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
                                <p class="small text-danger" id="error_whatsapp"></p>
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
                            <button type="button" class="btn btn-sm btn btn-primary" id="addCustomer" onClick='submitDetailsForm()'>Add Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="whatsappModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered WrongAnswerModal modal-sm">
            <div class="modal-content">
                <div class="pb-2">
                    {{-- <i class="fa fa-times" aria-hidden="true"></i> --}}
                    <img src="{{ asset('admin/img/cross.png') }}" alt="">
                </div>
                <p class="ava-alert__text" id="alert_message"></p>
                <div class="">
                <a href="javascript:void(0)" class="btn btn-success" data-bs-dismiss="modal">Ok</a>
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
function submitDetailsForm() {
    var whatsapp = $('#whatsapp').val().length;
    var fname = $('#fname').val().length;
    var lname = $('#lname').val().length;
    var email = $('#email').val().length;
    var mobile = $('#mobile').val().length;
    if(fname==0){
        $('#alert_message').text('Please Enter First Name');
        $('#whatsappModal').modal('show');
    }else if(lname==0){
         $('#alert_message').text('Please Enter Last Name');
        $('#whatsappModal').modal('show');
    }else if(email==0){
         $('#alert_message').text('Please Enter Email Address');
        $('#whatsappModal').modal('show');
    }else if(mobile!=10){
         $('#alert_message').text('Please Enter a 10 Digit Phone Number');
        $('#whatsappModal').modal('show');
    }else if(whatsapp!=10){
         $('#alert_message').text('Please Enter a 10 Digit Whatsapp Number');
        $('#whatsappModal').modal('show');
    }else{
        $("#addCustomerForm").submit();
    }
}
</script>
@endsection