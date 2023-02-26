@extends('partials')
@section('content')
    <div class="bill-background">
        <div class="p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
            <h6 class="text-center font">Invoice Record</h6>
        </div>
        <form action="/billingrecord" method="GET">


            <div class="ms-2">
                <select class="selectbillingname" name="billingname">
                 
                    @foreach ($names as $name)
                        <option value="{{ $name->company_name }}">{{ $name->company_name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="d-flex justify-content-end m-2">
                <label class="align-label me-3">Bill No:</label>
                <input type="number" class="align-input" placeholder="Bill No">
            </div>
            <div class="d-flex justify-content-end m-2">
                <label class="align-label me-3">Date:</label>
                <input type="date" class="align-input" placeholder="Date">
            </div>

            <table class="table table-bordered mt-4">
                <colgroup>
                    <col style="width: 5%;">
                    <col style="width: 60%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>
                <tr class="billhead">
                    <th>SN</th>
                    <th>Particular</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
                <tr class="billbody">
                    <td><input type="number" placeholder="SN"></td>
                    <td>
                        <select class="selectname select-productname" name="productname[]">
                            <option value="AL">leafy green</option>
                            <option value="WY">cruciferous </option>
                            <option value="AL">pumpkin</option>
                            <option value="WY">cucumber </option>
                            <option value="AL">broccoli</option>
                            <option value="WY">zucchini</option>
                            <option value="AL">yam</option>
                            <option value="WY">asparagus</option>
                            <option value="AL">shallot</option>
                            <option value="WY">onion</option>
                            <option value="AL">garlic </option>
                            <option value="WY">silverbeet</option>
                        </select>
                    </td>
                    <td><input type="number" placeholder="Quantity" name="quantity[]"></td>
                    <td><input type="number" placeholder="Rate" name="rate[]"></td>
                    <td><input type="number" placeholder="Amount" name="amount"></td>
                </tr>

            </table>
            <button id="newbtn" class="mb-3" type="button">Add new Row</button>
            <div class="d-flex justify-content-between">

                <div>
                    <select class="form-select" id="floatingSelect" name="transactiontype">
                        <option value="credit">Credit</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Total:</label>
                        <input type="number" placeholder="Total">
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <input type="number" class="align-input-fordiscount" placeholder="Discount">
                        <label class="align-label me-3">Discount:</label>
                        <input type="number" placeholder="Discount">
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Taxable Amt:</label>
                        <input type="number" placeholder="Taxable Amt">
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Tax:</label>
                        <input type="number" placeholder="Tax">
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <label class="align-label me-3">Total Amt:</label>
                        <input type="number" placeholder="Total Amt">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
    </div>
    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.selectname').select2({
             
            });
            $('.selectbillingname').select2({
                width: '300px',
            });

            $("#newbtn").click(function() {
                var cloneRow = $("table tr.billbody:last").clone();

                cloneRow.find("input").each(function() {
                    $(this).val('').attr({
                        // 'id': function(_, id) {
                        //     return id + x
                        // },
                        'name': function(_, name) {
                            return name
                        },
                        'value': ''
                    });
                }).end().appendTo("table");


                $('.selectname').select2({
                    width: '850px',
                });
                $('.selectname').last().next().next().remove();



            });
        });
    </script>
@endpush
