@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-12">
                <div class="bg-white rounded h-100 p-4">
                   
                    <div class="bg-white pt-4 px-4">
                        <div class="row">
                            <div class="col-md-2">
                                {{-- <h6 class="mb-4">Enquiry List</h6> --}}
                            </div>
                            <div class="col-md-10 text-end">
                                <a  href="{{ route('admin.enquiry.index') }}" class="btn btn-warning btn-sm">Back</a>
                                <a  href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#AddNotesModal" class="btn btn-sm btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Notes</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <span class="customer_span enquiry_notes">Enquiry Notes</span>
                        <table class="table">
                            {{-- <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead> --}}
                            <tbody>
                               
                                @if ($data)
                                    @foreach($data as $key =>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->notes }}
                                            <div class="row__action">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#EditNotesModal{{ $key }}">Edit </a><span>|</span>
                                                <a href="javascript:void(0)" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key+1 }}"> delete</a>                                                
                                            </div>
                                            {{-- Delete Note --}}
                                            <div class="modal fade" id="deleteModal{{ $key+1 }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog deleteModal modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="pb-4"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <h3>Are You Sure ?</h3>
                                                        <div class="">
                                                        <a href="{{ route('admin.enquiry.note-delete', $value->id) }}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Edit Note --}}
                                            <div class="modal fade" id="EditNotesModal{{ $key }}" tabindex="-1" aria-labelledby="EditNotesModalModalLabel{{ $key }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.enquiry.note-edit', $value->id) }}" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="EditNotesModalModalLabel{{ $key }}">Edit Note</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    @csrf
                                                                    <input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="{{ $id }}">
                                                                    <textarea id="notes" name="notes" cols="10" rows="3" class="form-control">{{ $value->notes }}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary btn-sm">Update changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- Edit Note --}}
                                        </td>
                                        <td>
                                            {{date('d M Y h:i A', strtotime($value->created_at))}}
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
  
    <div class="modal fade" id="AddNotesModal" tabindex="-1" aria-labelledby="AddNotesModalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.enquiry.add-notes') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="AddNotesModalModalLabel">New Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            @csrf
                            <input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="{{ $id }}">
                            <textarea id="notes" name="notes" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    
</script>
@endsection