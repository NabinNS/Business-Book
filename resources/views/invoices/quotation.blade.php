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


    <div class="c-grid-item ">

        <div>
            <div class="p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
                <h6 class="text-center font">Quotation</h6>
            </div>
            <form action="{{ route('savequotation') }}" method="GET">
                <div>
                    <label class="me-3">Name:</label>
                    <input type="text" class="align-name p-1" placeholder="Name of the company" name="name">
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
                        <td><input type="text" placeholder="Name of product" name="product[]"></td>
                        <td><input type="number" placeholder="Quantity" name="quantity[]"></td>
                        <td><input type="number" placeholder="Rate" name="rate[]"></td>
                        <td><input type="number" placeholder="Amount" name="amount" readonly></td>
                    </tr>

                </table>
                <button id="newbtn" class="mb-3 m-2" type="button">Add new Row</button>
                <div class="d-flex justify-content-end">
                    <div class="quo-margin-below">
                        <div class="d-flex justify-content-end m-2">
                            <label class="align-label me-3">Total:</label>
                            <input type="number" placeholder="Total" name="total" readonly>
                        </div>
                    </div>
                </div>
        </div>


        <div class="c-below">
            <div class="d-flex justify-content-end p-1">
                <form method="post" action="">
                    @csrf
                    <button type="submit" class="btn btn-secondary mt-2 me-4">Save</button>
                </form>
                <button class="btn btn-danger mt-2 me-2" id="backButton">Back</button>
            </div>
        </div>
        </form>
    </div>



@endsection
@push('scripts')
    <script>
        $(document).ready(function() {


            $("#newbtn").click(function() {

                var cloneRow = $("table tr.billbody:last").clone();

                cloneRow.find("input").each(function() {
                    $(this).val('').attr({
                        'name': function(_, name) {
                            return name
                        },
                        'value': ''
                    });
                }).end().appendTo("table");



            });


            // Add a change event listener to parent element
            var parent = $('.billbody').parent(); // Select the parent element of the rows
            var rateField = $('input[name="rate[]"]');
            var quantityField = $('input[name="quantity[]"]');
            var amountField = $('input[name="amount"]');
            var totalField = $('input[name="total"]');



            // Add a change event listener to parent element
            parent.on('keyup', 'input[name="rate[]"], input[name="quantity[]"]',
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


                });
            $('#backButton').click(function() {
                window.history.back();
            });

        });
    </script>
@endpush
