@extends('admin.layouts.master')
@section('content')
<style>
    .invoice{
        font-family: monospace;
        font-size: 12px;
        color: #222;
        background: #fff !important;
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
        <table border="2" style="width: 100%; border-collapse: collapse;border: 1px solid #222;" cellpadding="0" cellspacing="0" id="invoice_table">
            <tr>
                <td style="text-align: center;font-size: 19px;font-weight: 800; padding: 5px;">SIGN AND INFRA GRAPHICS</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid #808080;">Hatiara Satsangpally Uttarmath Naskarpara Near Pragatisang Club, 700157</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid #808080;border-bottom: 1px solid #808080;">Mobile: +919163062233   Email:ravi.sharma@singandinfragraphics.in</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: 800;padding: 5px;border-bottom: 0px;text-decoration-line: underline;text-decoration-style: solid;">Invoice</td>
            </tr>
            <tr>
                <td>
                    <table border="1" style="width: 100%; border-collapse: collapse;" cellpadding="10" cellspacing="0">
                        
                        <tr style="border-top: 1px solid #fff;">
                            <td rowspan="2" style="border-left: 1px solid #fff;border-bottom: 0px;border-right: 0px;width: 50%;vertical-align: top;">
                                <p style="margin: 0">Consignee</p>
                                <p style="margin: 0;"><strong>ICICI Bank</strong><br/>G.C Avenue <br>West Bengal</p>
                                {{-- <p style="margin: 0;">Ph No: 9007015173</p> --}}
                            </td>
                            <td style="border:0px; vertical-align: top; width: 30%;">
                                <p style="margin: 0;">Order By: <strong>{{ $Enquiry->enquiries->name }}</strong></p>
                                <p style="margin: 0;">Invoice. No: <strong id="invoiceCode"> {{ $Enquiry->invoice_code }}</strong></p>
                            </td>
                            <td style="border:0px; vertical-align: top;text-align: end;border-right: 1px solid #fff;">
                                <p style="margin: 0;">Date<br/><strong>{{ date('d M Y', strtotime($Enquiry->updated_at))}}</strong></p>
                                <p style="margin: 0;">Time<br/><strong>{{ date('H:i:s', strtotime($Enquiry->updated_at))}}</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:0px;">
                                
                            </td>
                            <td style="border:0px;border-right: 1px solid #fff;">
                                
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #fff;">
                            <td style="border: 0px;border-left: 1px solid #fff;">
                                <p style="margin: 0;">Buyer: <br/><strong>{{ $Enquiry->enquiries->name }}</strong><br/>{{ $Enquiry->customers->address.','.$Enquiry->customers->city.','.$Enquiry->customers->state }} </p>
                                <span>{{ $Enquiry->customers->country.','.$Enquiry->customers->pincode }}</span>
                                <p style="margin: 0;">T : {{ $Enquiry->enquiries->phone }}</p>
                                {{-- <p style="margin: 0;">E : {{ $Enquiry->email }}</p> --}}
                            </td>
                            <td style="border: 0px;">
                                
                                
                            </td>
                            <td style="border: 0px;border-right: 1px solid #fff;">
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="1" style="width: 100%; border-collapse: collapse;" cellpadding="10" cellspacing="0">
                        <tr style="border-top: 0px;">
                            <th style="text-align:center;border-left: 1px solid #fff;border-right: 1px solid #808080;border-bottom: 1px solid #808080;">SI No.</th>
                            <th colspan="3" style="text-align:center;border-right: 1px solid #808080;border-bottom: 1px solid #808080;">Descriptions of Goods</th>
                            <th  style="text-align:center;border-right: 1px solid #808080;border-bottom: 1px solid #808080;">Quantity <br>(Sq. Ft.)</th>
                            <th style="text-align:center;border-right: 1px solid #808080;width: 10%;border-bottom: 1px solid #808080;">Rate <br>(Rs./Sq.Ft.)</th>
                            <th style="text-align:center;border-right: 1px solid #fff;border-bottom: 1px solid #808080;">Amount (INR)</th>
                        </tr>
                        <tr>
                            <td  style="border-bottom: 0px;border-top:0px;border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td style="border-right:0px;text-align:center;text-decoration-line: underline;border-bottom: 0px;border-top:0px; width: 40%;"><strong>ICICI Bank</strong></td>
                            <td style="text-align:center;text-decoration-line: underline;border-bottom: 0px;border-top:0px;border-right:0px;border-left: 0px; width: 1%;"><strong>W</strong></td>
                            <td style="border-left: 0px; border-right: 1px solid #808080;text-align:center;text-decoration-line: underline;border-bottom: 0px;border-top:0px; width: 15%;"><strong>H</strong></td>
                            <td align="right"style="border-top: 0px;border-bottom:0px;border-right: 1px solid #808080;"></td>
                            <td align="right"style="border-top: 0px;border-bottom:0px;border-right: 1px solid #808080;"></td>
                            <td align="right"style="border-top: 0px;border-bottom:0px;border-right: 1px solid #fff;"></td>
                        </tr>
                       @php
                        $totalAmount = array();
                        $totalquantity = array();
                       @endphp
                        @foreach($details as $key => $invoice)
                            <tr>
                                <td align="center" style="border-bottom: 0px;border-top:0px;padding: 2px; border-left: 1px solid #fff;border-right: 1px solid #808080;">{{ $key+1 }}</td>
                                <td style="border-right:0px; border-bottom: 0px;border-top:0px;padding: 2px">{{ $invoice->services->name }}</td>
                                <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px"><strong>{{ $invoice->width }}</strong></td>
                                <td style="border-left: 0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;border-right: 1px solid #808080;"><strong>{{ $invoice->height }}</strong></td>
                                <td align="right"style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;">{{ $invoice->quantity }}</td>
                                <td align="right"style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;">{{ number_format($invoice->rate, 2) }}</td>
                                @php
                                $amount = $invoice->quantity*$invoice->rate;
                                $totalAmount[] = $amount;
                                $totalquantity[] = $invoice->quantity;
                                @endphp
                                <td align="right"style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #fff;"><strong>{{number_format($amount, 2)  }}</strong> </td>
                            </tr>
                            
                        @endforeach
                        @php
                        $floatAmount = array_sum($totalAmount);
                        @endphp
                        @if(count($extra)>0)
                        <tr>
                            <td align="center" style="border-bottom: 0px;border-top:0px;padding: 2px; border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td style="border-right:0px;border-bottom: 0px;border-top:0px;padding: 2px"><span><strong>Extra : </strong></span>
                                @php
                                $totalExtra = array();
                                @endphp
                                @foreach($extra as $extraValue)
                                <span>{{ $extraValue->extra_service.',' }}</span>
                               @php
                               
                               $totalExtra[] = $extraValue->rate;
                               @endphp
                                @endforeach
                            </td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px">
                            </td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="padding: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;">Extra</td>
                            @php
                            
                            $totalExtra = array_sum($totalExtra);
                            $floatAmount = $floatAmount+$totalExtra;
                            @endphp
                            <td align="right"style="padding: 2px;border-right: 1px solid #fff;border-top: 1px solid #808080;">{{ number_format($totalExtra,2) }}
                                <input type="hidden" value="{{ number_format((float)$totalExtra, 2, '.', '') }}">
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td align="center" style="border-bottom: 0px;border-top:0px;padding: 2px; border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td style="border-right:0px;border-bottom: 0px;border-top:0px;padding: 2px">
                            </td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px"></td>
                            <td style="border-left: 0px;border-right:0px;text-align:center;border-bottom: 0px;border-top:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #808080;"></td>
                            <td align="right" style="padding: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;">Total</td>
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
                                SGST <span id="hiddengst" class="d-none"> 0</span><input type="text" id="gst_amount" onkeypress="return onlyNumberKey(event)" style="width: 27px; padding:0px;text-align:center;" value="">%</td>
                            <td align="right"style="border-top: 0px;border-bottom:0px;padding: 2px;border-right: 1px solid #fff;border-top: 1px solid #808080;" id="amountGST"></td>
                        </tr>
                        <tr>
                            <td align="center"style="border-bottom: 0px;border-top:0px;border-left: 1px solid #fff;border-right: 1px solid #808080;"></td>
                            <td align="center" style="padding: 2px;border-top: 1px solid #808080;border-right: 1px solid #808080;"><strong>Total</strong></td>
                            {{-- <td align="right"style="border-right:0px;border-top: 1px solid #808080;"></td> --}}
                            <td align="right" colspan="2" style="border-left: 0px;padding: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;"><strong>Total Qty.(Sq. Ft.):</strong></td>
                            @php
                            $floatquantity = array_sum($totalquantity);
                            @endphp
                            <td align="right" id="totalQuantity" style="border-left: 0px;border-top: 1px solid #808080;padding: 2px;border-right: 1px solid #808080;">{{ $floatquantity }}</td>
                            <td align="right" style="border-top: 1px solid #808080;padding: 2px;border-right: 1px solid #808080;">Round Off</td>
                            <td align="right"style="padding: 2px;border-right: 1px solid #fff;border-top: 1px solid #808080;"></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="border-left: 1px solid #fff;border-top: 1px solid #808080;border-right: 1px solid #808080; border-bottom: 1px solid #808080;">Payment Terms: Against Delivery</td>
                            <td align="right" style="padding-right: 2px;border-right: 1px solid #808080;border-top: 1px solid #808080;border-bottom: 1px solid #808080;"><strong>Grand Total</strong></td>
                            <td align="right" id="grandTotal" style="padding-right: 2px;border-top: 1px solid #808080;border-right: 1px solid #fff;border-bottom: 1px solid #808080;"><strong id="grand_total">{{ number_format($floatAmount, 2) }}</strong></td>
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
        <input type="hidden" name="totalitems" id="totalitems" value="{{ count($details) }}">
        <input type="hidden" name="enquiry_id" id="enquiry_id" value="{{ $Enquiry->id }}">
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
            var gst = $('#hiddengst').text();
            var quantity = $('#totalQuantity').text();
            var invoiceCode = $('#invoiceCode').text();
            var grandTotal = $('#grandTotal').text();
            var totalitems = $('#totalitems').val();
            var enquiry_id = $('#enquiry_id').val();
            $.ajax({
                url: "{{ route('admin.enquiry.invoice-update') }}",
                type: "POST",
                data: { 
                    _token: '{{ csrf_token() }}',
                    gst : gst,
                    quantity : quantity,
                    invoiceCode : invoiceCode,
                    grandTotal : grandTotal,
                    totalitems : totalitems,
                    enquiry_id : enquiry_id
                },
                success: function(response){
                    if(response.status ==200){
                    $('#invoice_table').printThis();
                    }
                }
            });
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