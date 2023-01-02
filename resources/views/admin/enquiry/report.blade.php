@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                    <h6 class="mb-4">Category List</h6>
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
</script>
@endsection