@extends('partials')
@section('content')
    <div class="bill-background">

        {{-- <select class="selectname" name="billingname">
            <option value="AL">Alabama</option>
            <option value="WY">Wyoming</option>
        </select> --}}

        <div class="p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
            <h6 class="text-center font">Invoice</h6>
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
                <td><input type="text" placeholder="Particular"></td>
                <td><input type="number" placeholder="Quantity"></td>
                <td><input type="number" placeholder="Rate"></td>
                <td><input type="number" placeholder="Amount"></td>
            </tr>

        </table>
        <button id="newbtn">Add new Row</button>


    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.selectname').select2({
                width: 'resolve',
            });

            $("#newbtn").click(function() {
                var x = 1;
                $("table tr.billbody:first").clone().find("input").each(function() {
                    $(this).val('').attr({
                        'id': function(_, id) {
                            return id + x
                        },
                        'name': function(_, name) {
                            return name + x
                        },
                        'value': ''
                    });
                }).end().appendTo("table");
                x++;
            });

        });
    </script>
@endpush
