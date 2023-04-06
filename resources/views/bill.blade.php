@extends('partials')
@section('content')
    @if ($errors->any())
        <div class="custom-float-alert fixed-top alert alert-danger" role="alert">
            <ul class="errorstyle">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="custom-float-alert fixed-top alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="bill-background">
        <div class="p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
            <h6 class="text-center font">Invoice Record</h6>
        </div>
        <form action="{{ route('billingrecord', $billtype) }}" method="GET">


            <div class="ms-2">
                <label for="">Billing Name:</label>
                <select class="selectbillingname" name="billingname">
                    @if ($billtype == 'purchase')
                        @foreach ($names as $name)
                            <option value="{{ $name->company_name }}">{{ $name->company_name }}</option>
                        @endforeach
                    @else
                        @foreach ($names as $name)
                            <option value="{{ $name->customer_name }}">{{ $name->customer_name }}</option>
                        @endforeach
                    @endif




                </select>
            </div>
            <div class="d-flex justify-content-end m-2">
                <label class="align-label me-3">Bill No:</label>
                <input type="number" class="align-input" placeholder="Bill No" name="billno">
            </div>
            <div class="d-flex justify-content-end m-2">
                <label class="align-label me-3">Date:</label>
                <input type="date" class="align-input" placeholder="Date" name="date">
            </div>

            <table class="table table-bordered mt-4">
                <colgroup>

                    <col style="width: 60%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>
                <tr class="billhead">

                    <th>Particular</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
                <tr class="billbody">

                    <td>
                        <select class="selectname select-productname" name="productname[]">
                            @foreach ($productnames as $productname)
                                <option value="{{ $productname->stock_name }}"
                                    data-price="{{ $billtype == 'purchase' ? $productname->purchase_price : $productname->sales_price }}">
                                    {{ $productname->stock_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" placeholder="Quantity" name="quantity[]"></td>
                    <td><input type="number" placeholder="Rate" name="rate[]"></td>
                    <td><input type="number" placeholder="Amount" name="amount" readonly></td>
                </tr>

            </table>
            <button id="newbtn" class="mb-3 m-2" type="button">Add new Row</button>
            <div class="d-flex justify-content-between">

                <div class="m-2">
                    <select class="form-select" id="floatingSelect" name="transactiontype">
                        <option value="credit">Credit</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <div class="billbody">
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Total:</label>
                        <input type="number" placeholder="Total" name="total" readonly>
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <input type="number" class="align-input-fordiscount" placeholder="Dis%" name="discountpercent">
                        <label class="align-label me-3">Discount:</label>
                        <input type="number" placeholder="Discount" name="discountamt" readonly>
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Taxable Amt:</label>
                        <input type="number" placeholder="Taxable Amt" name="taxableamt" readonly>
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Tax (13%):</label>
                        <input type="number" placeholder="Tax" name="tax" readonly>
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Total Amt:</label>
                        <input type="number" placeholder="Total Amt" name="totalamt" readonly>
                    </div>
                </div>




            </div>
            <div class="d-flex justify-content-end m-2 mt-4">

                <button type="submit" class="btn btn-success mt-5 m-2">Save</button>
                <button type="button" class="btn btn-danger mt-5 m-2" id="backButton"> Cancel</button>
            </div>


    </div>
    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            function updateRateValue() {
                $('.select-productname').each(function() {
                    var price = $(this).find('option:selected').data('price');
                    $(this).closest('tr').find('[name="rate[]"]').val(price);
                });
            }
            // Call the function on page load
            updateRateValue();
            // Call the function on change of product dropdown
            $(document).on('change', '.select-productname', function() {
                updateRateValue();
            });



            $('.selectname').select2({});
            $('.selectbillingname').select2({
                width: '300px'
            });


            $("#newbtn").click(function() {
                var cloneRow = $("table tr.billbody:last").clone();

                // cloneRow.find("input").val('');
                cloneRow.find('[name="amount"]').val('');
                cloneRow.find('[name="quantity[]"]').val('');

                cloneRow.find("select.selectname").each(function() {
                    $(this).val($(this).find('option:first').val());
                    $(this).removeAttr('data-select2-id'); // remove the select2 ID attribute
                    $(this).next('.select2-container').remove(); // remove the select2 container
                });

                cloneRow.appendTo("table");

                $(".selectname").select2({
                    width: '100%'
                });

                cloneRow.find('.select-productname').trigger('change');
            });




            // Add a change event listener to parent element
            var parent = $('.billbody').parent(); // Select the parent element of the rows
            var rateField = $('input[name="rate[]"]');
            var quantityField = $('input[name="quantity[]"]');
            var amountField = $('input[name="amount"]');
            var totalField = $('input[name="total"]');
            var discountPercentField = $('input[name="discountpercent"]');
            var discountAmtField = $('input[name="discountamt"]');
            var taxableamt = $('input[name="taxableamt"]');
            var tax = $('input[name="tax"]');
            var totalAmt = $('input[name="totalamt"]');


            // Add a change event listener to parent element
            parent.on('keyup', ' input[name="discountpercent"], input[name="rate[]"], input[name="quantity[]"]',
                function() {

                    // Get the values of rate and quantity fields in the current row
                    var currentRow = $(this).closest('.billbody');
                    var rateValue = currentRow.find('input[name="rate[]"]').val();
                    var quantityValue = currentRow.find('input[name="quantity[]"]').val();

                    // Calculate the amount and update the amount field in the current row
                    var amountValue = rateValue * quantityValue;
                    currentRow.find('input[name="amount"]').val(amountValue);

                    // Calculate and update the total value
                    var totalValue = 0;
                    $('input[name="amount"]').each(function() {
                        totalValue += parseInt($(this).val()) || 0;
                    });
                    totalField.val(totalValue);

                    var discountPercentage = discountPercentField.val() || 0;
                    var discountValue = discountPercentage / 100 * totalValue;
                    discountAmtField.val(discountValue);

                    var taxableValue = totalValue - discountValue;
                    taxableamt.val(taxableValue);
                    var taxValue = taxableValue * 13 / 100;
                    tax.val(taxValue);

                    var totalAmtValue = taxableValue + taxValue;
                    totalAmt.val(totalAmtValue);

                });
            $('#backButton').click(function() {
                window.history.back();
            });

        });
    </script>
@endpush
