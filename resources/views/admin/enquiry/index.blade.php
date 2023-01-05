@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <form action="{{ route('admin.enquiry.index') }}" method="get" id="indexSubmit">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" id="startDate" value="{{ isset($startDate) ? $startDate : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" id="EndDate" value="{{ isset($endDate) ? $endDate : '' }}">
                                    </div>
                                    <div class="col-md-4" id="enquiry_page">
                                        <label class="form-label">Status</label>
                                        <select name="exportstatus" id="selectexportstatus" class="form-control">
                                            <option value="10" selected>Select Status</option>
                                            <option value="1" {{ $exportstatus == 1 ? 'Selected' : '' }}>New</option>
                                            <option value="2" {{ $exportstatus == 2 ? 'Selected' : '' }}>Outgoing</option>
                                            <option value="3" {{ $exportstatus == 3 ? 'Selected' : '' }}>Quotation Provided</option>
                                            <option value="4" {{ $exportstatus == 4 ? 'Selected' : '' }}>Order Generated</option>
                                            <option value="0" {{ $exportstatus == 0 ? 'Selected' : '' }}>Cancelled</option>
                                            <option value="all" {{ $exportstatus == 'all' ? 'Selected' : '' }}>Select All</option>
                                        </select>
                                    </div>
                                    {{-- {{ dd($exportstatus) }} --}}
                                        <div class="col-md-1 submit_btn">
                                            <button class="btn btn-sm btn btn-primary" id="exportSubmit">Submit</button>
                                        </div>
                                </div>
                            </form>
                        </div>
                        @if(!empty($startDate) || $exportstatus<10)
                            <div class="col-md-5 col-12">
                                <div class="row">
                                    <div class="col-md-2 submit_btn mx-3">
                                        <a href="{{ route('admin.enquiry.index') }}" class="btn btn-warning btn-sm">Clear</a>
                                    </div>
                                    <div class="col-md-2 submit_btn">
                                        <form action="{{ route('admin.enquiry.export') }}" method="POST">
                                            @csrf
                                        <input type="hidden" name="startDate" value="{{ $startDate }}">
                                        <input type="hidden" name="EndDate" value="{{ $endDate }}">
                                        <input type="hidden" name="exportstatus" id="exportstatus" value="{{ $exportstatus }}">
                                        <button type="submit" class="btn btn-sm btn btn-primary">Export</button>
                                    </form>
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
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
                                    <th scope="col">Action</th>
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
                                            <select name="status" data="{{ $value->id }}" onchange="makeSubmenu($(this).attr('data'), this.value)" class="form-control">
                                                <option value="1" {{ $value->status == 1 ? 'Selected' : '' }}>New</option>
                                                <option value="2" {{ $value->status == 2 ? 'Selected' : '' }}>Outgoing</option>
                                                <option value="3" {{ $value->status == 3 ? 'Selected' : '' }}>Quotation Provided</option>
                                                <option value="4" {{ $value->status == 4 ? 'Selected' : '' }}>Order Generated</option>
                                                <option value="0" {{ $value->status == 0 ? 'Selected' : '' }}>Cancelled</option>
                                            </select>
                                            <a href="{{ route('admin.enquiry.notes', $value->id) }}" class="text-light badge bg-secondary">Notes</a>
                                        </td>
                                        <td>
                                            @if($value->invoice ==0)
                                            <a href="javascript:void(0)" class="text-light badge bg-danger"  data-bs-toggle="modal" data-bs-target="#InvoiceModal{{ $key+1 }}">Generate Invoice</a>
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
                                            @else
                                            <a href="{{ route('admin.enquiry.invoice', $value->id)  }}" class="text-light badge bg-success">Invoice</a>
                                            @endif
                                            @if($value->quotation ==0)
                                            <a href="javascript:void(0)" class="text-light badge bg-danger" data-bs-toggle="modal" data-bs-target="#QuotationModal{{ $key+1 }}">Generate Quotation</a>
                                            {{-- generate Quotation --}}
                                            <div class="modal fade" id="QuotationModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="pb-4"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.enquiry.quotation-status', $value->id) }}" class="btn btn-danger">Generate</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <a href="{{ route('admin.enquiry.quotation', $value->id)  }}" class="text-light badge bg-success">Quotation</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{date('d M Y', strtotime($value->created_at))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="hiddenRow">
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
                                                        @if($details->service_id)
                                                            <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                                                <td>{{ $details->categories->name }}</td>
                                                                <td>{{ $details->services->name }}</td>
                                                                <td>{{ $details->width }}</td>
                                                                <td>{{ $details->height }}</td>
                                                                <td>{{ $details->quantity }}</td>
                                                                <td>{{ "₹ ".$details->rate }}</td>
                                                                <td>{{ "₹ ".$details->amount }}</td>
                                                            </tr>
                                                            @endif
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
  
    <div class="modal fade" id="StatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog alertModal modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="pb-4"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
                <p id="alert_content">Are You Sure ?</p>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $('#exportSubmit').on('click', function (event) {
        event.preventDefault();
        var selectexportstatus = $('#selectexportstatus').val();
        if(selectexportstatus =="all"){
            var startDate = $('#startDate').val();
            var EndDate = $('#EndDate').val();
            if(startDate == "" && EndDate == ""){
                $('#alert_content').text('Please Select Start Date & End Date !');
                $('#StatusModal').modal('show')
                return exit();
            }else{
               $("#indexSubmit").submit();
            }
        }else{
            $("#indexSubmit").submit();
        }
        //Some code
    });
    function makeSubmenu(data, value) {
        $.ajax({
            url: "{{ route('admin.enquiry.status') }}",
            type: "POST",
            data: {
                status: value,
                id: data,
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                if(response.status == 200){
                    window.location.reload(true);
                }
            }
        });
    };
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