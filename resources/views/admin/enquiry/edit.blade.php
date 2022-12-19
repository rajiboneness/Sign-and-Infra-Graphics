@extends('admin.layouts.master')
@section('content')
<style>
    
</style>
<div class="container-fluid pt-4 px-4" id="enquiry_page">
    <div class="row g-4 justify-content-center">
        <div class="col-md-10 col-12">
            <div class="bg-white rounded">
                <section class="signup-step-container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-11">
                            
                            <div class="wizard">
                                <form method="post" action="{{ route('admin.enquiry.update',$Enquiry->id ) }}" class="login-box">
                                    @csrf
                                    <div class="customer_records_edit row pt-2 d-none">
                                        <div class="col-md input_field_width">
                                            <div class="form-group">
                                                <select name="category_new[]" id="" class="form-control">
                                                    <option value="">Select Category...</option>
                                                    @foreach($Category as $catdata)
                                                    <option value="{{ $catdata->id}}">{{ $catdata->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md input_field_width">
                                            <div class="form-group">
                                                <select name="service_new[]" class="form-control">
                                                    <option value="">Select Service...</option>
                                                    @foreach($Service as $serdata)
                                                    <option value="{{ $serdata->id}}">{{ $serdata->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control" type="number" name="width_new[]"
                                                    placeholder="Width" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control" type="number" name="height_new[]"
                                                    placeholder="Height">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="quantity_new[]"
                                                    placeholder="Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control" type="number" name="rate_new[]"
                                                    placeholder="Rate">
                                            </div>
                                        </div>
                                    </div>
                                        <h4 class="text-center">Step 1</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    <input class="form-control" type="text" name="customer_name"
                                                        id="cname" placeholder="" value="{{ $Enquiry->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number *</label>
                                                    <input class="form-control" type="text" name="customer_phone"
                                                        id="cphone" placeholder="" value="{{ $Enquiry->phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Address *</label>
                                                    <input class="form-control" type="email" name="customer_email"
                                                        id="cemail" placeholder="" value="{{ $Enquiry->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="text-center">Step 2</h4>
                                        @foreach($details as $key =>$data)
                                            <div class="customer_records row pt-2">
                                                <div class="col-md input_field_width">
                                                    <input type="hidden" name="enquiry_details_id[]" value="{{ $data->id }}">
                                                    <div class="form-group">
                                                        <select name="category[]" id="category" class="form-control">
                                                            <option value="">Select Category...</option>
                                                            @foreach($Category as $catdata)
                                                            <option value="{{ $catdata->id}}" {{ $data->category_id == $catdata->id ? 'selected' : ''}}>{{ $catdata->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md input_field_width">
                                                    <div class="form-group">
                                                        <select name="service[]" id="service" class="form-control">
                                                            <option value="">Select Service...</option>
                                                            @foreach($Service as $serdata)
                                                            <option value="{{ $serdata->id}}" {{ $data->service_id == $serdata->id ? 'selected' : ''}}>{{ $serdata->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" name="width[]"
                                                            placeholder="Width" value="{{ $data->width }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" name="height[]"
                                                            placeholder="Height" value="{{ $data->height }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="quantity[]"
                                                            placeholder="Quantity" value="{{ $data->quantity }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" name="rate[]"
                                                            placeholder="Rate" value="{{ $data->rate }}">
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="{{ route('admin.enquiry.detailsDelete', $data->id) }}" class="btn-remove-customer btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="customer_records_dynamic"></div>
                                            <ul class="list-inline pull-right">
                                              <li><a class="extra-fields-customer btn btn-success" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                <li><a  href="{{ route('admin.enquiry.index') }}" class="btn btn-warning">Back</a>
                                                </li>
                                                <li><button type="submit"
                                                        class="default-btn next-step">Continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
// Add Multiple Dynamic Input fields
    $('.extra-fields-customer').click(function () {
        $('.customer_records_edit').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records_edit').addClass('single row');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<div class="col-auto remove-field"><a href="#" class="btn-remove-customer btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a></div>');
        $('.customer_records_dynamic > .single').attr("class", "row pt-3");

        $('.customer_records_dynamic input').each(function () {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });
    });
    $(document).on('click', '.remove-field', function (e) {
        $(this).parent('.row').remove();
        // $(this).parent('.row').remove();
        e.preventDefault();
    });


    // $(document).ready(function() {
    // $('#category').on('change', function() {
    //     var category_id = $('#category').val();
    //     $.ajax({
    //         url: "{{ route('admin.enquiry.category_wise_service') }}",
    //         method: 'POST',
    //         data: {
    //             category_id: category_id,
    //             _token: "{{ csrf_token() }}",
    //         },
    //         success: function (data) {
    //             if (data.status == 200) {

    //             }else{

    //             }
    //         }
    //     });
    // });
    // $(document).ready(function () {
    //     $("#search_data").keyup(function () {
    //         var search = $('#search_data').val.length
    //         if (search == 0) {
    //             $("#search_table").hide();
    //         }
    //         var query = $('#search_data').val();
    //         if (query != "") {
    //             $.ajax({
    //                 url: "{{ route('admin.enquiry.ajaxsearch') }}",
    //                 method: 'POST',
    //                 data: {
    //                     query: query,
    //                     _token: "{{ csrf_token() }}",
    //                 },
    //                 success: function (data) {
    //                     if (data.status == 200) {
    //                         $("#search_table div").removeClass('display');
    //                         $('#user_icon').html(
    //                             '<i class="fa fa-user d-flex justify-content-center align-items-center fa-lg"></i>'
    //                             );
    //                         $('#search_name').text(data.customer_name);
    //                         $('#search_email').text(data.email);
    //                         $('#search_phone').text(data.phone);
    //                         $('#customer_code').val(data.customer_code);
    //                         $('#customer_id').val(data.id);
    //                         $('#not_found').css('display', 'none');
    //                     } else {
    //                         $('#search_table').css('display', 'none');
    //                         $('#not_found').text('data.message');
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });

    // $(document).ready(function () {
    //     $('#search_table').on('click', function () {
    //         let customer_id = $('#customer_id').val();
    //         let customer_code = $('#customer_code').val();
    //         let search_name = $('#search_name').html();
    //         let search_email = $('#search_email').html();
    //         let search_phone = $('#search_phone').html();
    //         $('#cname').val(search_name);
    //         $('#cphone').val(search_phone);
    //         $('#cemail').val(search_email);
    //         // $( "#search_table" ).class('d-none', true);
    //         $("#search_table div").addClass('display');
    //         $("#search_data").val("");
    //     });
    // });
    // ------------step-wizard-------------
    $(document).ready(function () {
        $('.nav-tabs > li a[title]').tooltip();
        //Wizard
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target);
            if (target.parent().hasClass('disabled')) {
                return false;
            }
        });
        $(".next-step").click(function (e) {
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
        });
        $(".prev-step").click(function (e) {
            var active = $('.wizard .nav-tabs li.active');
            prevTab(active);
        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
    $('.nav-tabs').on('click', 'li', function () {
        $('.nav-tabs li.active').removeClass('active');
        $(this).addClass('active');
    });
    // Search

</script>
@endsection
