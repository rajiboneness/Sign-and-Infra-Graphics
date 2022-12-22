@extends('admin.layouts.master')
@section('content')
<div class="container-fluid pt-4 px-4" id="enquiry_page">
    <div class="row g-4 justify-content-center">
        <div class="col-md-10 col-12">
            <div class="bg-white rounded">
                <section class="signup-step-container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-11">
                            <div class="wizard">
                                <div class="wizard-inner">
                                    <div class="connecting-line"></div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                                aria-expanded="true"><span class="round-tab">1 </span> <i>Customer
                                                    Details</i>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                                aria-expanded="false"><span class="round-tab">2</span> <i> Measurement
                                                    Details</i></a>
                                        </li>
                                    </ul>
                                </div>

                                <form method="post" action="{{ route('admin.enquiry.store') }}" class="login-box">
                                    @csrf
                                    <div class="tab-content" id="main_form">
                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                            <h4 class="text-center">Step 1</h4>
                                            <div class="row search_row">
                                                <input type="text" class="search form-control"
                                                    placeholder="Search By Customer Name or Mobile Number" name="search"
                                                    id="search_data">
                                                <div id="search_table">
                                                    <div>
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <th id="user_icon"></th>
                                                                <th><span id="search_name"></span></th>
                                                                <th><span id="search_email"></span></th>
                                                                <th><span id="search_phone"></span></th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <input type="hidden" id="customer_id" name="customer_id" value="">
                                                    <input type="hidden" name="customer_code" id="customer_code">
                                                </div>
                                                <div id="not_found">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Customer Name</label>
                                                        <input class="form-control" type="text" name="customer_name"
                                                            id="cname" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone Number *</label>
                                                        <input class="form-control" type="text" name="customer_phone"
                                                            id="cphone" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email Address *</label>
                                                        <input class="form-control" type="email" name="customer_email"
                                                            id="cemail" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="default-btn next-step" id="Continue_btn">Continue to
                                                        next step</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <h4 class="text-center">Step 2</h4>
                                            <div class="customer_records row pt-2">
                                                <div class="col-md input_field_width">
                                                    <div class="form-group">
                                                        <select name="category[]" id="category" class="form-control">
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
                                                        <select name="service[]" id="service" class="form-control">
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
                                                        <input class="form-control" type="number" name="width[]"
                                                            placeholder="Width">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" name="height[]"
                                                            placeholder="Height">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="quantity[]"
                                                            placeholder="Quantity">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" name="rate[]"
                                                            placeholder="Rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="customer_records_dynamic"></div>
                                            <ul class="list-inline pull-right">
                                              <li><a class="extra-fields-customer btn btn-success" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                <li><button type="button" class="default-btn prev-step">Back</button>
                                                </li>
                                                <li><button type="submit"
                                                        class="default-btn next-step">Continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="AlertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog AlertModal modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="pb-4"><i class="fa fa-check" aria-hidden="true"></i></div>
            <h3>Are You Sure ?</h3>
            <div class="">
            <a href="" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
// Add Multiple Dynamic Input fields
    $('.extra-fields-customer').click(function () {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single row');
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
    $(document).ready(function () {
        $("#search_data").keyup(function () {
            var search = $('#search_data').val.length
            if (search == 0) {
                $("#search_table").hide();
            }
            var query = $('#search_data').val();
            if (query != "") {
                $.ajax({
                    url: "{{ route('admin.enquiry.ajaxsearch') }}",
                    method: 'POST',
                    data: {
                        query: query,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            $("#search_table div").removeClass('display');
                            $('#user_icon').html(
                                '<i class="fa fa-user d-flex justify-content-center align-items-center fa-lg"></i>'
                                );
                            $('#search_name').text(data.customer_name);
                            $('#search_email').text(data.email);
                            $('#search_phone').text(data.phone);
                            $('#customer_code').val(data.customer_code);
                            $('#customer_id').val(data.id);
                            $('#not_found').css('display', 'none');
                        } else {
                            $('#search_table').css('display', 'none');
                            $('#not_found').text('data.message');
                        }
                    }
                });
            }
        });
    });

    $(document).ready(function () {
        $('#search_table').on('click', function () {
            let customer_id = $('#customer_id').val();
            let customer_code = $('#customer_code').val();
            let search_name = $('#search_name').html();
            let search_email = $('#search_email').html();
            let search_phone = $('#search_phone').html();
            $('#cname').val(search_name);
            $('#cphone').val(search_phone);
            $('#cemail').val(search_email);
            // $( "#search_table" ).class('d-none', true);
            $("#search_table div").addClass('display');
            $("#search_data").val("");
        });

        // $('#Continue_btn').on('click', function () {
        //     $('#AlertModal').show();
        //     return exit();
        // });
    });
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
