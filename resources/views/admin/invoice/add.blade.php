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
                        <h2 class="text-center"> New Employee</h2>
                        <hr>
                    </div>
                    <form action="{{ route('admin.employee.store') }}" method="POST" id="addEmployeeForm">
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
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Mobile <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="mobile" name="phone" value="{{old('phone')}}">
                                @error('phone') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{old('designation')}}">
                                @error('designation') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label for="" class="form-label">Joining Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{old('joining_date')}}">
                                @error('joining_date') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-md-12">
                                <label for="" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="address" name="address">{{old('address')}}</textarea>
                                @error('address') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="bg-white text-end pt-4 px-4">
                            <button type="button" class="btn btn-sm btn btn-primary" onClick='EmployeeDetailsForm()'>Add Employee</button>
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
    function EmployeeDetailsForm() {
    // var whatsapp = $('#whatsapp').val().length;
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
    }else{
        $("#addEmployeeForm").submit();
    }
}
</script>
@endsection