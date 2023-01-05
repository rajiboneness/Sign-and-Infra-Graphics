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
                                                <select name="category_new[]" id="category0" class="form-control" onchange="makeSubmenu(this.value, this.id)">
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
                                                <select name="service_new[]" class="form-control" id="service0">
                                                    <option value="" class="selectService">Select Category.</option>
                                                    {{-- <option value="">Select Service...</option>
                                                    @foreach($Service as $serdata)
                                                    <option value="{{ $serdata->id}}">{{ $serdata->name }}
                                                    </option>
                                                    @endforeach --}}
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
                                        {{-- <h4 class="text-center">Employee Details</h4> --}}
                                        <div class="text-center">
                                            <span class="enquiry_edit_span">Employee Details</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Employee Name</label>
                                                    <input class="form-control" type="text" name="emp_name"
                                                        id="emp_name" placeholder="Search by employee name & phone" value="{{ $Enquiry->emp_name }}" >
                                                        <div id="search_Emp_table" class="search_Emp_table">
                                                            <div>
                                                                <table class="table borderless">
                                                                    <tr>
                                                                        <th class="user_icon1"></th>
                                                                        <th><span id="search_Emp_name"></span></th>
                                                                        <th><span id="search_Emp_email"></span></th>
                                                                        <th><span id="search_Emp_phone"></span></th>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="not_found1">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Phone Number *</label>
                                                    <input class="form-control" type="text" name="emp_phone"
                                                        id="emp_phone" placeholder="" value="{{ $Enquiry->emp_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email Address *</label>
                                                    <input class="form-control" type="email" name="emp_email"
                                                        id="emp_email" placeholder="" value="{{ $Enquiry->emp_email }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <h4 class="text-center mt-4">Customer Details</h4> --}}
                                       <div class="text-center pt-4">
                                            <span class="enquiry_edit_span">Customer Details</span>
                                       </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Customer Name</label>
                                                    <input class="form-control" type="text" name="customer_name"
                                                        id="cname" placeholder="Search by customer name & phone" value="{{ $Enquiry->name }}">
                                                    <div id="search_table" class="search_table">
                                                        <div>
                                                            <table class="table borderless">
                                                                <tr>
                                                                    <th class="user_icon"></th>
                                                                    <th><span id="search_name"></span></th>
                                                                    <th><span id="search_email"></span></th>
                                                                    <th><span id="search_phone"></span></th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <input type="hidden" name="customer_code" id="customer_code">
                                                    </div>
                                                    <div id="not_found">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $Enquiry->customer_id }}">
                                        <input type="hidden" name="employee_id"  id="employee_id" value="{{ $Enquiry->employee_id }}">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Phone Number *</label>
                                                    <input class="form-control" type="text" name="customer_phone"
                                                        id="cphone" placeholder="" value="{{ $Enquiry->phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email Address *</label>
                                                    <input class="form-control" type="email" name="customer_email"
                                                        id="cemail" placeholder="" value="{{ $Enquiry->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- <h4 class="text-center">Measurement Details</h4> --}}
                                       <div class="text-center">
                                        <span class="enquiry_edit_span">Measurement Details</span>
                                       </div>
                                        {{-- <input type="hidden" id="details" value="{{ count($details) }}"> --}}
                                        @foreach($details as $key =>$data)
                                           @if($data->service_id)
                                            <div class="customer_records row pt-2">
                                                <div class="col-md input_field_width">
                                                    <input type="hidden" name="enquiry_details_id[]" value="{{ $data->id }}">
                                                    <div class="form-group">
                                                        <select name="category[]" id="category{{ $key+100 }}" class="form-control" onchange="makeSubmenu(this.value, this.id)">
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
                                                        <select name="service[]" id="service{{ $key+100 }}" class="form-control">
                                                            <option value="{{ $data->service_id }}">{{ $data->services->name }}</option>
                                                            {{-- @foreach($Service as $serdata)
                                                            <option value="{{ $serdata->id}}" {{ $data->service_id == $serdata->id ? 'selected' : ''}}>{{ $serdata->name }}
                                                            </option>
                                                            @endforeach --}}
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
                                            @endif
                                            @endforeach
                                            <div class="customer_records_dynamic"></div>
                                            <div class="pt-2 text-end"><a class="extra-fields-customer btn btn-success" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a></div>

                                            <br>
                                            @if(count($extra))
                                            {{-- <h4 class="text-center">Extra Details</h4> --}}
                                            <div class="text-center">
                                                <span class="enquiry_edit_span">Extra Details</span>
                                            </div>
                                            @foreach($extra as $extraKey => $extradata)
                                            <input type="hidden" name="extra_details_id[]" value="{{ $extradata->id }}">
                                            <div class="row pt-2">
                                                <div class="col-md input_field_width">
                                                    <div class="form-group">
                                                        <select name="extra[]" id="extra" class="form-control">
                                                            <option value="" disabled selected>Choose Service</option>
                                                            <option value="Transportation" {{ $extradata->extra_service == 'Transportation' ? "Selected": '' }}>Transportation</option>
                                                            <option value="Iron Angle" {{ $extradata->extra_service == "Iron Angle"? "Selected": '' }}>Iron Angle</option>
                                                            <option value="Scaffolding" {{ $extradata->extra_service == "Scaffolding"? "Selected": '' }}>Scaffolding</option>
                                                            <option value="Timer" {{ $extradata->extra_service =="Timer" ? "Selected": '' }}>Timer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" name="amount[]"
                                                            placeholder="Amount" value="{{ $extradata->rate }}">
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="{{ route('admin.enquiry.detailsDelete', $extradata->id) }}" class="btn-remove-customer btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="extra_records_dynamic"></div>
                                            <div class="pt-2 text-end"><a class="extra-service-add btn btn-success" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                            @else
                                            <div class="extra_records_dynamic"></div>
                                                <div class="form-check text-end option_checkbox">
                                                    <label class="form-check-label" for="">
                                                        Are you want to add extra service ?
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                                </div>
                                                <div class="pt-2 text-end add_service_btn" style="display: none"><a class="extra-service-add btn btn-success" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                            @endif
                                            <ul class="list-inline pull-right">
                                                <li><a  href="{{ route('admin.enquiry.index') }}" class="btn btn-warning btn-sm">Back</a>
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
<div class="row pt-2 Extra_service_records d-none">
    <div class="col-md input_field_width">
        <div class="form-group">
            <select name="extra_new[]" id="extra" class="form-control">
                <option value="" disabled selected>Choose Service</option>
                <option value="Transportation">Transportation</option>
                <option value="Iron Angle">Iron Angle</option>
                <option value="Scaffolding">Scaffolding</option>
                <option value="Timer">Timer</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input class="form-control" type="number" name="amount_new[]"
                placeholder="Amount">
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    // $(document).ready(function(){ 
    //     $("#flexCheckChecked").click(function() {
    //         var test = $(this).val();
    //         $(".add_service_btn").show();
    //     }); 
    // });
    $(document).ready(function () { 
        $("#flexCheckChecked").click(function() {
        $(".add_service_btn:hidden").show('slow');
        });
        $("#flexCheckChecked").click(function(){
        if($('#flexCheckChecked').prop('checked')===false) {
            $('.add_service_btn').hide();}
        });
    });
    $('.extra-service-add').click(function () {
    $('.Extra_service_records').clone().appendTo('.extra_records_dynamic');
    $('.extra_records_dynamic .Extra_service_records').addClass('single row');
    $('.single .extra-service-add').remove();
    $('.single').append(`<div class="col-auto remove-field"><a href="#" class="btn-remove-customer btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a></div>`);
    $('.extra_records_dynamic > .single').attr("class", "row pt-3");
    $('.extra_records_dynamic input').each(function () {
        var count = 0;
        var fieldname = $(this).attr("name");
        $(this).attr('name', fieldname + count);
        count++;
    });
});
    $(document).ready(function () {
        $("#emp_name").keyup(function () {
            var search = $('#emp_name').val.length
            if (search == 0) {
                $(".search_Emp_table").addClass('display');
                $('#not_found1').addClass('display');
            }
            var query = $('#emp_name').val();
            if (query != "") {
                $.ajax({
                    url: "{{ route('admin.enquiry.employeesearch') }}",
                    method: 'POST',
                    data: {
                        query: query,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            $('#not_found1').addClass('display');
                            $('#not_found1').text('');
                            $(".search_Emp_table").removeClass('display');
                            // $("#search_Emp_table div").removeClass('display');
                            $('.user_icon1').html(
                                '<i class="fa fa-user d-flex justify-content-center align-items-center fa-lg"></i>'
                                );
                            $('#search_Emp_name').text(data.employee_name);
                            $('#search_Emp_email').text(data.email);
                            $('#search_Emp_phone').text(data.phone);
                            // $('#customer_code').val(data.customer_code);
                            $('#employee_id').val(data.id);
                            
                        } else {
                            // $('#search_Emp_table').css('display', 'none');
                            $('.search_Emp_table').addClass('display');
                            $('#not_found1').removeClass('display');
                            $('#not_found1').text(data.message);
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function () {
        $('#search_Emp_table').on('click', function () {
            let employee_id = $('#employee_id').val();
            let search_Emp_name = $('#search_Emp_name').html();
            let search_Emp_email = $('#search_Emp_email').html();
            let search_Emp_phone = $('#search_Emp_phone').html();
            $('#employee_id').val(employee_id);
            $('#emp_name').val(search_Emp_name);
            $('#emp_phone').val(search_Emp_phone);
            $('#emp_email').val(search_Emp_email);
            $("#search_Emp_table div").addClass('display');
        });
    });
    $(document).ready(function () {
        $("#cname").keyup(function () {
            var search = $('#cname').val.length
            if (search == 0) {
                $(".search_table").addClass('display');
                $('#not_found').addClass('display');
            }
            var query = $('#cname').val();
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
                            $('#not_found').addClass('display');
                            $('#not_found').text('');
                            $(".search_table").removeClass('display');
                            $('.user_icon').html(
                                '<i class="fa fa-user d-flex justify-content-center align-items-center fa-lg"></i>'
                                );
                            $('#search_name').text(data.customer_name);
                            $('#search_email').text(data.email);
                            $('#search_phone').text(data.phone);
                            $('#customer_code').val(data.customer_code);
                            $('#customer_id').val(data.id);
                        } else {
                            $('.search_table').addClass('display');
                            $('#not_found').removeClass('display');
                            $('#not_found').text(data.message);
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
            $('#customer_id').val(customer_id);
            $('#cname').val(search_name);
            $('#cphone').val(search_phone);
            $('#cemail').val(search_email);
            $("#search_table div").addClass('display');
        });
    });
    function makeSubmenu(value, id) {
        var lastChar = id.substring(8);
        if (value.length == 0){
            if(lastChar == 0){
                document.querySelector(`service${lastChar}`).innerHTML = "<option></option>";
            }else{
                document.querySelector(`service${lastChar}`).innerHTML = "<option></option>";
            }
        }else{
            var category_id = value;
            $.ajax({
                url: "{{ route('admin.category.getcatWiseService') }}",
                method: 'post',
                data: {
                    category_id: category_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.status == 200) {
                        var array = response.data;
                        if(lastChar == 0){
                            $(`#service${lastChar} option`).remove();
                            $(`#service${lastChar}`).append('<option value="">Select Service...</option>');
                            $.each(array, function(index, value) {
                                $(`#service${lastChar}`).append('<option value="' + value[0] + '">' + value[1] + "</option>");
                            });
                        }else{
                            $(`#service${lastChar} option`).remove();
                            $(`#service${lastChar}`).append('<option value="">Select Service...</option>');
                            $.each(array, function(index, value) {
                                $(`#service${lastChar}`).append('<option value="' + value[0] + '">' + value[1] + "</option>");
                            });
                        }
                    }else{

                    }
                }
            });
        }
    }
// Add Multiple Dynamic Input fields
    var sl = 1;
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
        $(`#category${sl-1}`).attr("id",  `category${sl++}`);
            var service = parseInt(sl-1);
            $(`#service${service-1}`).attr("id",  `service${service}`);
    });
    $(document).on('click', '.remove-field', function (e) {
        $(this).parent('.row').remove();
        // $(this).parent('.row').remove();
        e.preventDefault();
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
