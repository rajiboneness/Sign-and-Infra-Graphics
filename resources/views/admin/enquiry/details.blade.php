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
                        <div class="col-md-6">
                            <ul>
                                <li>Customer Name: {{ $Enquiry->name }}</li>
                                <li> Email: {{ $Enquiry->email }}</li>
                                <li> Mobile : {{ $Enquiry->phone }}</li>
                                <li> Address : {{ $Enquiry->customers->address.', '.$Enquiry->customers->city.', '.$Enquiry->customers->state.', '.$Enquiry->customers->country.', '.$Enquiry->customers->pincode}}</li>
                            </ul>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Width</th>
                                        <th scope="col">Height</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Amount</th>
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