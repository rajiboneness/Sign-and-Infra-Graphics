@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div>
                            <a href="{{ route('admin.enquiry.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <h4 class="text-center">Enquiry Details</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 customer_details">
                                <span>Customer Id</span><br>
                                <span>Name:</span><br>
                                <span>Email:</span><br>
                                <span>Mobile:</span><br>
                                <span>Address:</span>
                            </div>
                            <div class="col-md-3">
                                <span>{{ $Enquiry->customers->customer_code }}</span><br>
                                <span>{{ $Enquiry->name }}</span><br>
                                <span>{{ $Enquiry->email }}</span><br>
                                <span>{{ $Enquiry->phone }}</span><br>
                                <span>{{ $Enquiry->customers->address.', '.$Enquiry->customers->city.', '.$Enquiry->customers->state.', '.$Enquiry->customers->country.', '.$Enquiry->customers->pincode}}</span>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 customer_details">
                                <span>Employee Name</span><br>
                                <span>Email:</span><br>
                                <span>Mobile:</span><br>
                            </div>
                            <div class="col-md-3">
                                <span>{{ $Enquiry->employees->fname.' '.$Enquiry->employees->lname }}</span><br>
                                <span>{{ $Enquiry->employees->email }}</span><br>
                                <span>{{ $Enquiry->employees->phone }}</span><br>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <hr>
                    </div>
                    <div class="row enquiry_details">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Service</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @if ($details)
                                        @foreach($details as $key =>$value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->categories->name }}</td>
                                            <td>{{ $value->services->name }}</td>
                                            <td>{{ $value->width }}</td>
                                            <td>{{ $value->height }}</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td>{{ '₹ '.$value->rate }}</td>
                                            <td>{{ '₹ '.$value->amount }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
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