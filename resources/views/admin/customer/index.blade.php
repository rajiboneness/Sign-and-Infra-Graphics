@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                   
                    <div class="bg-white pt-4 px-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="mb-4">Customer List</h6>
                            </div>
                            <div class="col-md-10 text-end">
                                <a href="{{ route('admin.customer.add') }}" class="btn btn-sm btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Customer</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">WhatsApp</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if ($data)
                                    @foreach($data as $key =>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->customer_code }}</td>
                                        <td>
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->fname }} {{ $value->lname }}</p>
                                            <div class="row__action">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#registereditModal{{ $key+1 }}">View </a><span>|</span>
                                                <a href="{{ route('admin.customer.edit', $value->id) }}">Edit </a><span>|</span>
                                                <a href="javascript:void(0)" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key+1 }}"> delete</a>                                                
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="registereditModal{{ $key+1 }}" tabindex="-1" aria-labelledby="registereditModalLabel{{ $key+1 }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="registereditModalLabel{{ $key+1 }}">Customer Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><b>Customer Code : </b>{{ $value->customer_code }}</p>
                                                                <p><b>Name : </b>{{ $value->fname }} {{ $value->lname }}</p>
                                                                <p><b>Email : </b>{{ $value->email }}</p>
                                                                <p><b>Contact No : </b>{{ $value->phone }}{{ $value->whatsapp ? ' / '.$value->whatsapp: '' }}</p>
                                                                <span>Company Details</span>
                                                                <p><b>Name : </b>{{ $value->company_name }}</p>
                                                                <p><b>Website : </b>{{ $value->website }}</p>
                                                                <p><b>Contact Person : </b>{{ $value->contact_person }}</p>
                                                                <p><b>Contact Phone : </b>{{ $value->company_phone }}</p>
                                                                <span>Address Details</span>
                                                                <p><b>Address : </b>{{ $value->address }}</p>
                                                                <p><b>City : </b>{{ $value->city }} | <b>State : </b> {{ $value->state }}</p>
                                                                <p><b>Country : </b>{{ $value->country }} | <b>Pin : </b> {{ $value->pincode }}</p>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal">
                                                    <div class="modal-content">
                                                        <div><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.customer.delete', $value->id) }}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->whatsapp }}</td>
                                        <td>{{ $value->company_name }}</td>
                                        <td> <a href="{{ route('admin.customer.status', $value->id) }}" class="badge {{ $value->status==1 ? "success-btn" : "danger-btn"}}">{{ $value->status== 1 ?"Active" : "Inactive" }}</a>
                                        </td>
                                        <td>
                                            {{date('d M Y', strtotime($value->created_at))}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{$data->links()}}
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