@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                   
                    <div class="bg-white pt-4 px-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="mb-4">Employee List</h6>
                            </div>
                            <div class="col-md-10 text-end">
                                <a href="{{ route('admin.employee.add') }}" class="btn btn-sm btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Employee</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Joining Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if ($data)
                                    @foreach($data as $key =>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <p style="overflow: hidden;text-overflow: ellipsis;margin-bottom: 0;">{{ $value->fname }} {{ $value->lname }}</p>
                                            <div class="row__action">
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
                                                        <a href="{{ route('admin.employee.delete', $value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $value->designation }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td> <a href="{{ route('admin.employee.status', $value->id) }}" class="badge {{ $value->status==1 ? "success-btn" : "danger-btn"}}">{{ $value->status== 1 ?"Active" : "Inactive" }}</a>
                                        </td>
                                        <td>
                                            {{date('d M Y', strtotime($value->joining_date))}}
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