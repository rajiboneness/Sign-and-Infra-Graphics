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
                                    <ul class="nav nav-tabs enquiry-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                                aria-expanded="false"><span class="round-tab">1</span> <i> Employee</i></a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                                aria-expanded="true"><span class="round-tab">2 </span> <i>Customer</i>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"
                                                aria-expanded="true"><span class="round-tab">3</span> <i> Measurement</i></a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"
                                                aria-expanded="true"><span class="round-tab">4</span> <i> Extra</i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="customer_records row pt-2 d-none">
                                    <div class="col-md input_field_width">
                                        <div class="form-group">
                                            <select name="category[]" id="category0" class="form-control category" onchange="makeSubmenu(this.value, this.id)">
                                                <option value="" disabled selected>Choose Category</option>
                                                @foreach($Category as $catdata)
                                                <option value="{{ $catdata->id}}">{{ $catdata->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md input_field_width">
                                        <div class="form-group">
                                            <select name="service[]" id="service0" class="form-control citySelect">
                                                <option value="" class="selectService">Select Category.</option>
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
                                <form method="post" action="{{ route('admin.enquiry.store') }}" class="login-box">
                                    @csrf
                                    <div class="tab-content" id="main_form">
                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                            <h4 class="text-center">Employee</h4>
                                            <div class="row search_row">
                                                <input type="text" class="search form-control"
                                                    placeholder="Search By Employee Name or Mobile Number" name="search"
                                                    id="search_Emp_data">
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
                                                    <input type="hidden" id="employee_id" name="employee_id" value="">
                                                </div>
                                                <div id="not_found1">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Employee Name</label>
                                                        <input class="form-control" type="text" name="EmpName"
                                                            id="EmpName" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone Number *</label>
                                                        <input class="form-control" type="number" name="EmpPhone"
                                                            id="EmpPhone" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email Address *</label>
                                                        <input class="form-control" type="email" name="EmpEmail"
                                                            id="EmpEmail" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="default-btn next-step" id="Continue_Emp_btn">Continue to
                                                        next step</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <h4 class="text-center">Customer</h4>
                                            <div class="row search_row">
                                                <input type="text" class="search form-control"
                                                    placeholder="Search By Customer Name or Mobile Number" name="search"
                                                    id="search_data">
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
                                                        <input class="form-control" type="number" name="customer_phone"
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
                                                <li><button type="button" class="default-btn prev-step">Back</button>
                                                </li>
                                                <li><button type="button" class="default-btn next-step" id="Continue_cust_btn">Continue to
                                                        next step</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step3">
                                            <h4 class="text-center">Measurement</h4>
                                            <div class="row pt-2">
                                                <div class="col-md input_field_width">
                                                    <div class="form-group">
                                                        <select name="category[]" id="category20" class="form-control category" onchange="makeSubmenu(this.value, this.id)">
                                                            <option value="" disabled selected>Choose Category</option>
                                                            @foreach($Category as $catdata)
                                                            <option value="{{ $catdata->id}}">{{ $catdata->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md input_field_width">
                                                    <div class="form-group">
                                                        <select name="service[]" id="service20" class="form-control citySelect">
                                                            <option value="" class="selectService">Select Category.</option>
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
                                              <li><a class="extra-fields-customer btn btn-success" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                <li><button type="button" class="default-btn prev-step btn-sm">Back</button>
                                                </li>
                                                <li><button type="button" class="default-btn next-step">Continue to
                                                    next step</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step4">
                                            <h4 class="text-center">Extra</h4>
                                            <div class="row pt-2 Extra_service_records">
                                                <div class="col-md input_field_width">
                                                    <div class="form-group">
                                                        <select name="category[]" id="category20" class="form-control category" onchange="makeSubmenu(this.value, this.id)">
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
                                                        <input class="form-control" type="number" name="rate[]"
                                                            placeholder="Amount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="extra_records_dynamic"></div>
                                            <ul class="list-inline pull-right">
                                              <li><a class="extra-service-add btn btn-success" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                <li><button type="button" class="default-btn prev-step btn-sm">Back</button>
                                                </li>
                                                <li><button type="submit"
                                                        class="default-btn next-step">Continue to
                                                        Preview</button></li>
                                                        <li><button type="button" class="btn-secondary btn-sm">Skip</button>
                                                        </li>
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
<div class="modal fade" id="AlertModal" tabindex="-1" aria-hidden="true">
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

    $('#Continue_Emp_btn').on('click', function () {
        if($('#EmpName').val() == ''){
            $('#alert_content').text('Please enter employee name !');
            $('#AlertModal').modal('show')
            return exit();
        }else if($('#EmpPhone').val() == ''){
            $('#alert_content').text('Please enter employee mobile !');
            $('#AlertModal').modal('show')
            return exit();
        }else if($('#EmpEmail').val() == ''){
            $('#alert_content').text('Please enter employee email !');
            $('#AlertModal').modal('show')
            return exit();
        }
        else{
        }
    });
    $('#Continue_cust_btn').on('click', function () {
        if($('#cname').val() == ''){
            $('#alert_content').text('Please enter customer name !');
            $('#AlertModal').modal('show')
            return exit();
        }else if($('#cphone').val() == ''){
            $('#alert_content').text('Please enter customer mobile !');
            $('#AlertModal').modal('show')
            return exit();
        }else if($('#cemail').val() == ''){
            $('#alert_content').text('Please enter customer email !');
            $('#AlertModal').modal('show')
            return exit();
        }
        else{
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
        }
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

    var sl = 1;
    $('.extra-fields-customer').click(function () {
        // for(var i=1;i>number;i++){
            $('.customer_records').clone().appendTo('.customer_records_dynamic');
            $('.customer_records_dynamic .customer_records').addClass('single row');
            $('.single .extra-fields-customer').remove();
            $('.single').append(`<div class="col-auto remove-field"><a href="#" class="btn-remove-customer btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a></div>`);
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
        // }
    });
    $(document).on('click', '.remove-field', function (e) {
        $(this).parent('.row').remove();
        // $(this).parent('.row').remove();
        e.preventDefault();
    });

    $(document).ready(function () {
        $("#search_Emp_data").keyup(function () {
            var search = $('#search_Emp_data').val.length
            if (search == 0) {
                $(".search_Emp_table").addClass('display');
                $('#not_found1').addClass('display');
            }
            var query = $('#search_Emp_data').val();
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
                            $('.user_icon1').html(
                                '<i class="fa fa-user d-flex justify-content-center align-items-center fa-lg"></i>'
                                );
                            $('#search_Emp_name').text(data.employee_name);
                            $('#search_Emp_email').text(data.email);
                            $('#search_Emp_phone').text(data.phone);
                            // $('#customer_code').val(data.customer_code);
                            $('#employee_id').val(data.id);
                            $('#not_found1').css('display', 'none');
                        } else {
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
        $("#search_data").keyup(function () {
            var search = $('#search_data').val.length
            if (search == 0) {
                $(".search_table").addClass('display');
                $('#not_found').addClass('display');
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
                            $('#not_found').css('display', 'none');
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
        $('#search_Emp_table').on('click', function () {
            let employee_id = $('#employee_id').val();
            let search_Emp_name = $('#search_Emp_name').html();
            let search_Emp_email = $('#search_Emp_email').html();
            let search_Emp_phone = $('#search_Emp_phone').html();
            $('#EmpName').val(search_Emp_name);
            $('#EmpPhone').val(search_Emp_phone);
            $('#EmpEmail').val(search_Emp_email);
            $("#search_Emp_table div").addClass('display');
            $("#search_Emp_data").val("");
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
        // $(".next-step").click(function (e) {
        //     var active = $('.wizard .nav-tabs li.active');
        //     active.next().removeClass('disabled');
        //     nextTab(active);
        //     console.log(active.next().html());
        // });

        $(".next-step").click(function (e) {
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
            console.log(active.next().html());
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
