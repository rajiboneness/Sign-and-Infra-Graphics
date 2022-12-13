@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="bg-white rounded h-100 p-4">
                    <div class="row">
                        <div>
                            <a href="{{ route('admin.customer.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <h2 class="text-center">Customer Details</h2>
                        <hr>
                    </div>
                    <div class="row">
                        
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