@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                   
                    <div class="bg-white pt-4 px-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="mb-4">Enquiry List</h6>
                            </div>
                            <div class="col-md-10 text-end">
                                <a href="{{ route('admin.enquiry.add') }}" class="btn btn-sm btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Enquiry</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive enquiry_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Enquiry Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Quotation</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if ($Enquiry)
                                    @foreach($Enquiry as $key =>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td data-toggle="collapse" data-target="#demo{{ $key+1 }}" class="accordion-toggle">
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->customers->fname }} {{ $value->customers->lname }}</p>
                                            <div class="row__action">
                                                <a href="{{ route('admin.enquiry.view', $value->id) }}">View </a><span>|</span>
                                                <a href="{{ route('admin.enquiry.edit', $value->id) }}">Edit </a><span>|</span>
                                                <a href="javascript:void(0)" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key+1 }}"> delete</a>                                                
                                            </div>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="pb-4"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.enquiry.delete', $value->id) }}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            Mobile : {{ $value->phone }}
                                            <br>
                                            Email : {{ $value->email }}
                                            @php
                                                $enquiryDetails = App\Models\EnquiryDetail::where('enquiry_id', $value->id)->get();
                                                // dd($enquiryDetails);
                                            @endphp
                                        </td>
                                        
                                        <td> 
                                            @php
                                            if($value->status == 1){
                                                $status = "New";
                                                $color = "bg-warning";
                                            }elseif($value->status == 2){
                                                $status = "Ongoing";
                                                $color = "bg-primary";
                                            }elseif($value->status == 3){
                                                $status = "Quotation Provided";
                                                $color = "bg-info";
                                            }elseif($value->status ==4){
                                                $status = "Order Generated";
                                                $color = "bg-success";
                                            }else{
                                                $status = "Cancelled";
                                                $color = "bg-danger";
                                            }
                                            
                                            @endphp
                                            <a href="javascript:void(0)" class="text-light badge {{ $color }}" data-bs-toggle="modal" data-bs-target="#statusModal{{ $key+1 }}"> {{ $status }}</a>
                                                <!-- Delete Modal -->
                                            <div class="modal fade" id="statusModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.enquiry.status') }}" method="post">
                                                            @csrf
                                                                <div class="my-4">
                                                                    <select name="status" id="status" class="form-control me-auto ms-auto">
                                                                        <option value="">Change Status..</option>
                                                                        <option value="1">New</option>
                                                                        <option value="2">Ongoing</option>
                                                                        <option value="3">Quotation Provided</option>
                                                                        <option value="4">Order Generated</option>
                                                                        <option value="0">Cancelled</option>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" name="enquiry_id" value="{{ $value->id }}">
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($value->quotation ==1)
                                            <a href="{{ route('admin.enquiry.invoice', $value->id) }}" class="text-light badge bg-success">Quotation</a>
                                            @else
                                            <a href="javascript:void(0)" class="text-light badge bg-danger" data-bs-toggle="modal" data-bs-target="#InvoiceModal{{ $key+1 }}">Generate Invoice</a>
                                            {{-- generate Invoice --}}
                                            <div class="modal fade" id="InvoiceModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="pb-4"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.enquiry.invoice-store', $value->id) }}" class="btn btn-danger">Generate</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            {{date('d M Y', strtotime($value->created_at))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="hiddenRow">
                                            <div class="accordian-body collapse" id="demo{{ $key+1 }}">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr class="info">
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
                                                        @foreach($enquiryDetails as $details)
                                                            <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                                                <td>{{ $details->categories->name }}</td>
                                                                <td>{{ $details->services->name }}</td>
                                                                <td>{{ $details->width }}</td>
                                                                <td>{{ $details->height }}</td>
                                                                <td>{{ $details->quantity }}</td>
                                                                <td>{{ "₹ ".$details->rate }}</td>
                                                                <td>{{ "₹ ".$details->amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{$Enquiry->links()}}
                    </div>


                </div>
            </div>
        </div>
    </div>
  
  
@endsection
@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    // $(document).ready( function () {
    //     $('#vendorTable').DataTable();
    // } );
    //     $(".status_option").on('change', function() {
    //         var status = $('#status').val();
    //         var id = $(this).find(':selected').data('id');
    //         $.ajax({
    //             url: "{{ route('admin.enquiry.status') }}",
    //             type: "POST",
    //             data: {
    //                 status: status,
    //                 id: id,
    //                 _token: "{{ csrf_token() }}",
    //             },
    //             success: function (data) {
                   
    //             }
    //         });
            
    //     });
</script>
@endsection