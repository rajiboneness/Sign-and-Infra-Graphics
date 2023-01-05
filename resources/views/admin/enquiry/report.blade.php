@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <form action="{{ route('admin.enquiry.report') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{ isset($startDate) ? $startDate : '' }}">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" value="{{ isset($endDate) ? $endDate : '' }}">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ !$cname ==0 ? $cname : "" }}" placeholder="Search Customer Name">
                                        <span id="customrrData" class="customrrData"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Search Employee Name">
                                        <span id="employeeData" class="customrrData"></span>
                                    </div>
                                    @if($startDate==0 || $cname ==0 || $ename ==0)
                                        <div class="col-md-2 submit_btn">
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                        @if(!$startDate==0 || !$cname==0 || !$ename ==0)
                            <div class="col-md-6 col-12 report_export_btn">
                                <div class="row">
                                    <div class="col-md-2 submit_btn mr-3">
                                        <a href="{{ route('admin.enquiry.report') }}" class="btn btn-warning btn-sm">Clear</a>
                                    </div>
                                    <div class="col-md-3 submit_btn">
                                        <form action="{{ route('admin.enquiry.report-export') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="employeeName" value="{{ $ename }}">
                                            <input type="hidden" name="customerName" value="{{ $cname }}">
                                            <input type="hidden" name="startDate" value="{{ $startDate }}">
                                            <input type="hidden" name="EndDate" value="{{ $endDate }}">
                                            <button type="submit" class="btn btn-success btn-sm">Export</button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                    <h6 class="mb-4 mt-4">Report List</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer </th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Quotation Date</th>
                                    <th scope="col">Quotation Amount(GST)</th>
                                    <th scope="col">Invoice Generate</th>
                                    <th scope="col">Invoice Amount(GST)</th>
                                    <th scope="col">Invoice Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if (isset($getEnquiry))
                                    @foreach($getEnquiry as $key =>$value)
                                    @php
                                    $quotation = App\Models\Quotation::where('enquiry_id', $value->id)->first();
                                    $invoice = App\Models\Invoice::where('enquiry_id', $value->id)->first();
                                    @endphp
                                    @if(isset($quotation))
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->name }}</p>
                                        </td>
                                        <td><p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->emp_name }}</p>
                                        </td>
                                        <td>
                                            {{date('d M Y', strtotime($value->created_at))}}
                                        </td>
                                        <td>
                                           
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ date('d M Y', strtotime($quotation->created_at)) }}</p>
                                        </td>
                                        <td>
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ '₹'.$quotation->total_amount }}({{ $quotation->gst.'%' }})</p>
                                        </td>
                                        <td class="text-{{$value->invoice == 1 ? "success" : "danger" }}"> 
                                            {{ $value->invoice == 1 ? "Yes" : "No" }}
                                        </td>
                                        <td>
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ isset($invoice) ? '₹'.$invoice->total_amount.'('.$invoice->gst.'%)' : "00.00"}}</p>
                                        </td>
                                        <td>
                                            @if(isset($invoice))
                                            {{ date('d M Y', strtotime($invoice->created_at))}}
                                            @else
                                            {{ "...................." }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
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
    $(document).ready(function () {
        $('#customrrData').css('display', 'none')
        $("#customer_name").keyup(function () {
            var search = $('#customer_name').val.length
            var query = $('#customer_name').val();
            
            if (query != "") {
                $.ajax({
                    url: "{{ route('admin.enquiry.customer') }}",
                    method: 'POST',
                    data: {
                        query: query,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            $('#customrrData').text(data.customer_name);
                            $('#customrrData').css('display', 'block')
                        } else {
                            $('#customrrData').css('display', 'block')
                            $('#customrrData').text(data.message);
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function () {
        $('#customrrData').on('click', function () {
            let cname = $('#customrrData').html();
            $('#customer_name').val(cname);
            $('#customrrData').css('display', 'none');
        });
    });
    $(document).ready(function () {
        $('#employeeData').css('display', 'none')
        $("#employee_name").keyup(function () {
            var search = $('#employee_name').val.length
            var query = $('#employee_name').val();
            
            if (query != "") {
                $.ajax({
                    url: "{{ route('admin.enquiry.employee') }}",
                    method: 'POST',
                    data: {
                        query: query,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            $('#employeeData').text(data.employee_name);
                            $('#employeeData').css('display', 'block')
                        } else {
                            $('#employeeData').css('display', 'block')
                            $('#employeeData').text(data.message);
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function () {
        $('#employeeData').on('click', function () {
            let cname = $('#employeeData').html();
            $('#employee_name').val(cname);
            $('#employeeData').css('display', 'none');
        });
    });
</script>
@endsection