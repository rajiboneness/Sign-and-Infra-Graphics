@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-4">
                <div class="card rounded border-0 customer_card">
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="details_cardhead">
                                <span class="customer_span">Customer</span>
                                <h2>{{ $Enquiry->name }}</h2>
                            </div>
                            <span class="text-muted fs"> Customer Code : {{ $Enquiry->customers->customer_code }}</span><br>
                            <span class="text-muted fs"> Mobile : {{ $Enquiry->phone }}</span><br>
                            <span class="text-muted fs"> Email : {{ $Enquiry->email }}</span><br>
                            <span class="text-muted fs"> Address : {{ $Enquiry->customers->address.', '.$Enquiry->customers->city.', '.$Enquiry->customers->state.', '.$Enquiry->customers->country.', '.$Enquiry->customers->pincode}} </span>
                        </div>
                    </div>
                </div>
                <div class="card rounded border-0 mt-2 customer_card">
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="details_cardhead">
                                <span class="customer_span">Employee</span>
                                <h2>{{ $Enquiry->employees->fname.' '.$Enquiry->employees->lname }}</h2>
                            </div>
                            <span class="text-muted fs"> Email : {{  $Enquiry->employees->email  }}</span><br>
                            <span class="text-muted fs"> Mobile : {{  $Enquiry->employees->phone }}</span>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <a href="{{ route('admin.enquiry.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="col-md-8 col-8">
                <div class="bg-white rounded px-4 py-2">
                    <div class="row details_cardhead">
                        <span class="customer_span text-end my-2">Enquiry Date : {{date('d M Y', strtotime($Enquiry->created_at))}}</span>
                        {{-- <h2 class="text-center">Enquiry Details</h2> --}}
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
                                        @if($value->service_id)
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
                                        @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (count($extra))
                    <div class="card rounded border-0 mt-2 customer_card">
                        <div class="row enquiry_details">
                            <span class="customer_span">Extra </span>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service</th>
                                            <th>Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach($extra as $key =>$value)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $value->extra_service }}</td>
                                                <td>{{ '₹ '.$value->rate }}</td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
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