@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                   
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
                                            {{-- <div class="row__action">
                                                <a href="{{ route('admin.employee.edit', $value->id) }}">Edit </a><span>|</span>
                                                <a href="javascript:void(0)" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key+1 }}"> delete</a>                                                
                                            </div>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="pb-4"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.employee.delete', $value->id) }}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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