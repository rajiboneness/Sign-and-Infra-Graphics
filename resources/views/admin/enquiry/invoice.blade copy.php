@extends('admin.layouts.master')
@section('content')
<style>
    .invoice{
        font-family: monospace;
        font-size: 12px;
        color: #222;
        background: #fff !important;
    }
    #invoice_table{
        width: 100%; border-collapse: collapse;border: 1px solid #222;
    }
    .saif{
        text-align: center;font-size: 19px;font-weight: 800; padding: 5px;
    }
    .caddress{
        text-align: center;border-top: 1px solid #808080;
    }
    .mobile_email{
        text-align: center;border-top: 1px solid #808080;border-bottom: 1px solid #808080;
    }
    .quotation{
        text-align: center;font-weight: 800;padding: 5px;border-bottom: 0px;text-decoration-line: underline;text-decoration-style: solid;
    }
    .table2{
        width: 100%; border-collapse: collapse;
    }
    .table2 .tr1{
        border-top: 1px solid #fff;
    }
    .table2 .tr1 .td1{
        border-left: 1px solid #fff;border-bottom: 0px;border-right: 0px;width: 50%;vertical-align: top;
    }
    .table2 .tr1 .td2{
        border:0px; vertical-align: top; width: 30%;
    }
    .table2 .tr1 .td3{
        border:0px; vertical-align: top;text-align: end;border-right: 1px solid #fff;
    }
    .table2 .tr2 .td2{
        border:0px;border-right: 1px solid #fff;
    }
    .table2 .tr3{
        border-bottom: 1px solid #fff;
    }
    .table2 .tr3 .td1{
        border: 0px;border-left: 1px solid #fff;
    }
    .table2 .tr3 .td3{
        border: 0px;border-right: 1px solid #fff;
    }
    .table3{
        width: 100%; border-collapse: collapse;
    }
    .table3 .tr1{
        border-top: 0px;
    }
    .table3 .tr1 .td1{
        text-align:center;border-left: 1px solid #fff;border-right: 1px solid #808080;border-bottom: 1px solid #808080;
    }
    .table3 .tr1 .td2{
        text-align:center;border-right: 1px solid #808080;border-bottom: 1px solid #808080;
    }
    .table3 .tr1 .td3{
        text-align:center;border-right: 1px solid #808080;border-bottom: 1px solid #808080;
    }
    .table3 .tr1 .td4{
        text-align:center;border-right: 1px solid #808080;border-bottom: 1px solid #808080;
    }
    .table3 .tr1 .td5{
        text-align:center;border-right: 1px solid #fff;border-bottom: 1px solid #808080;
    }
    .table3 .tr2 .td1{
        border-bottom: 0px;border-top:0px;border-left: 1px solid #fff;border-right: 1px solid #808080;
    }
    .table3 .tr2 .td2{
        border-right:0px;text-align:center;text-decoration-line: underline;border-bottom: 0px;border-top:0px; width: 40%;
    }
    .table3 .tr2 .td3{
        text-align:center;text-decoration-line: underline;border-bottom: 0px;border-top:0px;border-right:0px;border-left: 0px; width: 1%;
    }
    .table3 .tr2 .td4{
        border-left: 0px; border-right: 1px solid #808080;text-align:center;text-decoration-line: underline;border-bottom: 0px;border-top:0px; width: 15%;
    }
    .table3 .tr2 .td5{
        border-top: 0px;border-bottom:0px;border-right: 1px solid #808080;
    }
    .table3 .tr2 .td6{
        border-top: 0px;border-bottom:0px;border-right: 1px solid #fff;
    }
    .table3 .tr3 .td1{
        border-bottom: 0px;border-top:0px;padding: 2px; border-left: 1px solid #fff;border-right: 1px solid #808080;
    }
    .table3 .tr3 .td2{
        border-right:0px; border-bottom: 0px;border-top:0px;padding: 2px;
    }
    .table3 .tr3 .td3{
        border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;
    }
    .table3 .tr3 .td4{
        border-left: 0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;border-right: 1px solid #808080;
    }
    .table3 .tr3 .td5{
        border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;
    }
    .table3 .tr3 .td6{
        border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #fff;
    }
    
</style>

@php
date_default_timezone_set('Asia/Calcutta'); 
@endphp
    <div class="container-fluid pt-4 px-4 pb-4 bg-light invoice">
        <div class="text-end py-4">
            <a href="{{ route('admin.enquiry.index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            <button class="btn btn-primary btn-sm" id="print_btn">Print</button>
        </div>
        <table border="2" cellpadding="0" cellspacing="0" id="invoice_table">
            <tr>
                <td class="saif">SIGN AND INFRA GRAPHICS</td>
            </tr>
            <tr>
                <td class="caddress">Hatiara Satsangpally Uttarmath Naskarpara Near Pragatisang Club, 700157</td>
            </tr>
            <tr>
                <td class="mobile_email">Mobile: +919163062233   Email:ravi.sharma@singandinfragraphics.in</td>
            </tr>
            <tr>
                <td class="quotation">Quotation</td>
            </tr>
            <tr>
                <td>
                    <table border="1" class="table2" cellpadding="10" cellspacing="0">
                        
                        <tr class="tr1">
                            <td rowspan="2" class="td1">
                                <p style="margin: 0">Consignee</p>
                                <p style="margin: 0;"><strong>ICICI Bank</strong><br/>G.C Avenue <br>West Bengal</p>
                                {{-- <p style="margin: 0;">Ph No: 9007015173</p> --}}
                            </td>
                            <td class="td2">
                                <p style="margin: 0;">Invoice Code: <strong> I1923CO000000429</strong></p>
                                <p style="margin: 0;">Order By: <strong>{{ $Enquiry->name }}</strong></p>
                                <p style="margin: 0;">PI. No: <strong> SIG/008/22-23</strong></p>
                            </td>
                            <td class="td3">
                                <p style="margin: 0;">Invoice Date<br/><strong>{{ date('d M Y', strtotime(date('m/d/Y'))) }}</strong></p>
                                <p style="margin: 0;">Time<br/><strong>{{ date('H:i:s') }}</strong></p>
                            </td>
                        </tr>
                        <tr class="tr2">
                            <td style="border:0px;">
                            </td>
                            <td class="td2">
                            </td>
                        </tr>
                        <tr class="tr3">
                            <td class="td1">
                                <p style="margin: 0;">Buyer: <br/><strong>{{ $Enquiry->name }}</strong><br/>{{ $Enquiry->customers->address.','.$Enquiry->customers->city.','.$Enquiry->customers->state }} </p>
                                <span>{{ $Enquiry->customers->country.','.$Enquiry->customers->pincode }}</span>
                                <p style="margin: 0;">T : {{ $Enquiry->phone }}</p>
                                {{-- <p style="margin: 0;">E : {{ $Enquiry->email }}</p> --}}
                            </td>
                            <td style="border: 0px;">
                            </td>
                            <td class="td3">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="1" class="table3" cellpadding="10" cellspacing="0">
                        <tr class="tr1">
                            <th class="td1">SI No.</th>
                            <th colspan="3" class="td2">Descriptions of Goods</th>
                            <th  class="td3">Quantity <br>(Sq. Ft.)</th>
                            <th class="td4">Rate <br>(Rs./Sq.Ft.)</th>
                            <th class="td5">Amount (INR)</th>
                        </tr>
                        <tr class="tr2">
                            <td class="td1"></td>
                            <td class="td2"><strong>ICICI Bank</strong></td>
                            <td class="td3"><strong>W</strong></td>
                            <td class="td4"><strong>H</strong></td>
                            <td align="right"class="td5"></td>
                            <td align="right"class="td5"></td>
                            <td align="right"class="td6"></td>
                        </tr>
                       @php
                        $totalAmount = array();
                        $totalquantity = array();
                       @endphp
                        @foreach($details as $key => $invoice)
                            <tr class="tr3">
                                <td align="center" class="td1">{{ $key+1 }}</td>
                                <td class="td2">{{ $invoice->services->name }}</td>
                                <td class="td3"><strong>{{ $invoice->width }}</strong></td>
                                <td class="td4"><strong>{{ $invoice->height }}</strong></td>
                                <td align="right"class="td5">{{ $invoice->quantity }}</td>
                                <td align="right"class="td5">{{ number_format($invoice->rate, 2) }}</td>
                                @php
                                $amount = $invoice->quantity*$invoice->rate;
                                $totalAmount[] = $amount;
                                $totalquantity[] = $invoice->quantity;
                                @endphp
                                <td align="right"class="td6"><strong>{{number_format($amount, 2)  }}</strong> </td>
                            </tr>
                            
                        @endforeach
                        <tr>
                            <td align="center" style="border-bottom: 0px;border-top:0px;padding: 2px; border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td style="border-right:0px;border-bottom: 0px;border-top:0px;padding: 2px">
                            </td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px"></td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="padding: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;">Total</td>
                            @php
                             $floatAmount = array_sum($totalAmount);
                            @endphp
                            <td align="right"style="padding: 2px;border-right: 1px solid #fff;border-top: 1px solid #808080;">{{ number_format($floatAmount,2) }}
                                <input type="hidden" id="floatAmount" value="{{ number_format((float)$floatAmount, 2, '.', '') }}">
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="border-bottom: 0px;border-top:0px;padding: 2px; border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td style="border-right:0px;border-bottom: 0px;border-top:0px;padding: 2px">
                            </td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px"></td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;">
                                IGST <span id="hiddengst" class="d-none"> </span><input type="text" id="gst_amount" onkeypress="return onlyNumberKey(event)" style="width: 27px; padding:0px;text-align:center;" value="">%</td>
                            <td align="right"style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #fff;border-top: 1px solid #808080;" id="amountGST"></td>
                        </tr>
                        <tr>
                            <td align="center"style="border-bottom: 0px;border-top:0px;border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td align="center" style="padding: 2px;border-top: 1px solid #808080;border-right: 1px solid #808080;"><strong>Total</strong></td>
                            <td align="right"style="border-right:0px;border-top: 1px solid #808080;"></td>
                            <td align="right" style="border-left: 0px;padding: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;"><strong>Total Qty.(Sq. Ft.):</strong></td>
                            @php
                            $floatquantity = array_sum($totalquantity);
                            @endphp
                            <td align="right" style="border-left: 0px;border-top: 1px solid #808080;padding: 2px;border-right: 1px solid #808080;">{{ $floatquantity }}</td>
                            <td align="right" style="border-top: 1px solid #808080;padding: 2px;border-right: 1px solid #808080;">Round Off</td>
                            <td align="right"style="padding: 2px;border-right: 1px solid #fff;border-top: 1px solid #808080;"></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="border-left: 1px solid #fff;border-top: 1px solid #808080;border-right: 1px solid #808080; border-bottom: 1px solid #808080;">Payment Terms: Against Delivery</td>
                            <td align="right" style="padding-right: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;border-bottom: 1px solid #808080;"><strong>Grand Total</strong></td>
                            <td align="right"style="padding-right: 2px;border-top: 1px solid #808080;border-right: 1px solid #fff;border-bottom: 1px solid #808080;"><strong id="grand_total">{{ number_format($floatAmount, 2) }}</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="0" style="width: 100%; border-collapse: collapse;border: 1px solid #fff;" cellpadding="10" cellspacing="0">
                        <tr>
                            <td valign="top" colspan="2">
                                <p style="margin: 0;">Rupees (in words) : <strong  id="ToWords">Rupees thirty six thousand five hundred eighty only.</strong></p>
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <strong>GSTIN: 19AEQFS2863F1ZI</strong>
                            </td>
                            <td align="left">
                                <ol style="font-size: 11px;">
                                    <li>Goods Once sold will not be taken back.</li>
                                    <li>Subject to kolkata Jurisdiction.</li>
                                    <li>Interest @ 24% will be charged for payment after due date.</li>
                                    <li>Goods damage in transit will be borne by consignee.</li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                we declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.
                            </td>
                            <td align="left">
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="0" style="width: 100%; border-collapse: collapse;" cellpadding="10" cellspacing="0">
                        <tr>
                            <td style="width: 20%;border-right: 1px solid #808080;border-top: 1px solid #808080;"><p style="margin: 0;"><strong>Regd. Address</strong></td>
                            <td style="width: 80%;border-top: 1px solid #808080;">Hatiara Satsangpally Uttarmath Naskarpara Near Pragatisang Club, 700157</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;border-right: 1px solid #808080;border-top: 1px solid #808080;"><p style="margin: 0;"><strong></strong></td>
                            <td style="width: 80%;border-top: 1px solid #808080;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
@section('script')
<script>
    function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    $(function() {
        $('#print_btn').click(function(){
            $('#gst_amount').css('display', 'none');
            $('#hiddengst').removeClass('d-none');
            $('#invoice_table').printThis();
        });
    });
    $(document).ready(function () {
        var price = $('#floatAmount').val().replace(/,/g,'');
        var totalPrice = Number(price);
        $("#amountGST").text("00.00");
        $("#gst_amount").val("");
        $("#ToWords").text(numberToWords(totalPrice));

        function numberWithCommas(x) {
        return x.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        function numberToWords(number) {  
            var digit = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];  
            var elevenSeries = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];  
            var countingByTens = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];  
            var shortScale = ['', 'thousand', 'million', 'billion', 'trillion'];  
    
            number = number.toString(); number = number.replace(/[\, ]/g, ''); if (number != parseFloat(number)) return 'not a number'; var x = number.indexOf('.'); if (x == -1) x = number.length; if (x > 15) return 'too big'; var n = number.split(''); var str = ''; var sk = 0; for (var i = 0; i < x; i++) { if ((x - i) % 3 == 2) { if (n[i] == '1') { str += elevenSeries[Number(n[i + 1])] + ' '; i++; sk = 1; } else if (n[i] != 0) { str += countingByTens[n[i] - 2] + ' '; sk = 1; } } else if (n[i] != 0) { str += digit[n[i]] + ' '; if ((x - i) % 3 == 0) str += 'hundred '; sk = 1; } if ((x - i) % 3 == 1) { if (sk) str += shortScale[(x - i - 1) / 3] + ' '; sk = 0; } } if (x != number.length) { var y = number.length; str += 'point '; for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' '; } str = str.replace(/\number+/g, ' '); return str.trim() + ".";  
        }
        function calc() {
            var gst = ($.trim($("#gst_amount").val()) != "" && !isNaN($("#gst_amount").val())) ? parseInt($("#gst_amount").val()) : 0;
            var sum = (totalPrice / 100)*gst;
            $("#amountGST").text(numberWithCommas(sum));
            var output=Number(totalPrice+sum)
            $('#hiddengst').text(gst);
            $("#grand_total").text(numberWithCommas(output));
            $("#ToWords").text(numberToWords(output));
        }
       
        $("#gst_amount").keyup(function() {
            calc();
        });
    });
</script>
@endsection