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
                                <h2>{{ $data['customer_name'] }}</h2>
                            </div>
                            <span class="text-muted fs"> Mobile : {{ $data['EmpPhone'] }}</span><br>
                            <span class="text-muted fs"> Email : {{ $data['EmpEmail'] }}</span><br>
                        </div>
                    </div>
                </div>
                <div class="card rounded border-0 mt-2 customer_card">
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="details_cardhead">
                                <span class="customer_span">Employee</span>
                                <h2>{{ $data['customer_name'] }}</h2>
                            </div>
                            <span class="text-muted fs"> Email : {{  $data['customer_phone']  }}</span><br>
                            <span class="text-muted fs"> Mobile : {{  $data['customer_email'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 col-8">
                <form method="post" action="{{ route('admin.enquiry.store') }}" class="login-box">
                    @csrf
                <div class="bg-white rounded px-4 py-2">
                    <div class="row enquiry_details">
                        <span class="customer_span">Measurement Details</span>
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
                                   
                                    @if ($category)
                                        @foreach($category as $key =>$value)
                                        @php
                                        $categoryName = App\Models\Category::where('id', $value)->first();
                                        $serviceName = App\Models\Service::where('id', $service[$key])->first();
                                        $total = $rate[$key]*$quantity[$key];
                                        @endphp
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $categoryName->name }}</td>
                                            <td>{{ $serviceName->name }}</td>
                                            <td>{{ $width[$key] }}</td>
                                            <td>{{ $height[$key] }}</td>
                                            <td>{{ $quantity[$key] }}</td>
                                            <td>{{ '₹ '.$rate[$key] }}</td>
                                            <td>{{ '₹ '.$total }}</td>
                                        </tr>
                                        <input type="hidden" name="category[]"  value="{{ $value }}">
                                        <input type="hidden" name="service[]"  value="{{ $service[$key] }}">
                                        <input type="hidden" name="width[]"  value="{{ $width[$key] }}">
                                        <input type="hidden" name="height[]"  value="{{ $height[$key] }}">
                                        <input type="hidden" name="quantity[]"  value="{{ $quantity[$key] }}">
                                        <input type="hidden" name="rate[]"  value="{{ $rate[$key] }}">
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="card rounded border-0 mt-2 customer_card px-4 py-4">
                    <div class="row enquiry_details">
                        @if (isset($extra))
                        <span class="customer_span">Extra details</span>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    
                                        @foreach($extra as $extrakey =>$extraValue)
                                        <tr>
                                            <td>{{ $extrakey+1 }}</td>
                                            <td>{{ $extraValue }}</td>
                                            <td>{{ $amount[$extrakey] }}</td>
                                        </tr>
                                        <input type="hidden" name="extra[]"  value="{{ $extraValue }}">
                                        <input type="hidden" name="amount[]"  value="{{ $amount[$extrakey] }}">
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                       <div class="text-end">
                        <input type="hidden" name="employee_id" id="employee_id" value="{{ $data['employee_id'] }}">
                        <input type="hidden" name="EmpName" id="EmpName" value="{{ $data['EmpName'] }}">
                        <input type="hidden" name="EmpPhone" id="EmpPhone" value="{{ $data['EmpPhone'] }}">
                        <input type="hidden" name="EmpEmail" id="EmpEmail" value="{{ $data['EmpEmail'] }}">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $data['customer_id'] }}">
                        <input type="hidden" name="customer_name" id="customer_name" value="{{ $data['customer_name'] }}">
                        <input type="hidden" name="customer_phone" id="customer_phone" value="{{ $data['customer_phone'] }}">
                        <input type="hidden" name="customer_email" id="customer_email" value="{{ $data['customer_email'] }}">
                        <a href="{{ route('admin.enquiry.add') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        <button type="submit" class="btn btn-success btn-sm"> Submit</button>
                       </div>
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