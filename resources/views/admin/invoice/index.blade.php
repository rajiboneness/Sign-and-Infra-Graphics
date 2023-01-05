@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <form action="{{ route('admin.invoice.index') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{ isset($startDate) ? $startDate : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" value="{{ isset($endDate) ? $endDate : '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Invoice Code</label>
                                        <input type="text" class="form-control" name="invoice_code" value="{{ isset($invoice_code) ? $invoice_code : '' }}" placeholder="Invoice Code">
                                    </div>
                                    <div class="col-md-2 submit_btn">
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if(!empty($startDate) || !empty($invoice_code))
                            <div class="col-md-4 col-12">
                                <div class="row">
                                    <div class="col-md-4 submit_btn mr-3">
                                        <a href="{{ route('admin.invoice.index') }}" class="btn btn-warning btn-sm">Clear</a>
                                    </div>
                                    <div class="col-md-6 submit_btn">
                                        <form action="{{ route('admin.invoice.export') }}" method="POST">
                                            @csrf
                                        <input type="hidden" name="startDate" value="{{ $startDate }}">
                                        <input type="hidden" name="EndDate" value="{{ $endDate }}">
                                        <input type="hidden" name="invoiceCode" value="{{ $invoice_code }}">
                                        <button type="submit" class="btn btn-success btn-sm">Export</button>
                                    </form>
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="bg-white pt-4 px-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="mb-4">Invoice List</h6>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Invoice Code</th>
                                    <th scope="col">Customer Details</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">GST</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col"> Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if ($data)
                                    @foreach($data as $key =>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->invoice_code }}</p>
                                        </td>
                                        <td>{{ $value->customers->fname.' '.$value->customers->lname}}<br>{{ $value->customers->phone }}
                                        <br>{{ $value->customers->email }}
                                        </td>
                                        <td>{{ $value->items }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->gst.'%' }}</td>
                                        <td>{{ '₹ '.$value->total_amount }}</td>
                                        <td>
                                            {{date('d M Y', strtotime($value->created_at))}}
                                        </td>
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
  
  
@endsection
@section('script')
<script>
    $(document).ready( function () {
    $('#vendorTable').DataTable();
} );
</script>
@endsection