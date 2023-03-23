<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    input {
        border: none;
    }
    .table-bordered td,
    .table-bordered th {
        border: 1px solid;
        margin: 0px 20px;
    }

    .table-bordered {
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table-bordered input {
        border: none;
    }

    .m {
        margin: 5px 0px;
    }

    .mr {
        margin-top: 30px;
        margin-left: 560px;
    }

    .total-width {
        width: 90px;
    }

    .center {
        text-align: center;
    }

    .m-sign {
        margin-top: 60px;
        border-top: 1px solid black;
        margin-left: 590px;
    }

    label {
        display: inline-block;
    }
</style>

<body>
    <div class="c-grid-item ">
        <div>
            <div class="center">
                <h5>Company name</h5>
            </div>
            <div class="d-flex justify-content-end m">
                <label>Date:</label>
                <input type="text" value="{{ $date }}">
            </div>
            <div class="m">
                <label>Name:</label>
                <input type="text" class="align-name p-1" placeholder="Name of the company" name="name"
                    value={{ "$customername" }}>
            </div>

            <div class="d-flex justify-content-end m">
                <label class="align-label me-3">Bill No:</label>
                <input type="text" class="align-input" placeholder="Bill No" name="billno" value={{ "$billno" }}
                    readonly>
            </div>


            <table class="table-bordered">
                <thead>
                    <tr class="billhead">
                        <th>Particular</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                @php
                    $value = 0;
                @endphp
                <tbody>
                    @foreach ($quotationdetails as $quotationdetail)
                        <tr class="billbody">
                            <td><input type="text" placeholder="Name of product" name="product[]"
                                    value={{ "$quotationdetail->product_name" }}></td>
                            <td><input type="text" placeholder="Quantity" name="quantity[]"
                                    value={{ "$quotationdetail->quantity" }}></td>
                            <td><input type="text" placeholder="Rate" name="rate[]"
                                    value={{ "$quotationdetail->rate" }}></td>
                            <td><input type="text" placeholder="Amount" name="amount" readonly
                                    value={{ "$quotationdetail->rate" * "$quotationdetail->quantity" }}></td>
                        </tr>
                        @php
                            $value += "$quotationdetail->rate" * "$quotationdetail->quantity";
                        @endphp
                    @endforeach
                </tbody>


            </table>
            <div class="d-flex justify-content-end">
                <div class="quo-margin-below">
                    <div class="d-flex justify-content-end m mr">
                        <label class="align-label me-3">Total:</label>
                        <input type="text" class="total-width" placeholder="Total" name="total"
                            value={{ "$value" }}>
                    </div>
                </div>
                <p class="m-sign">Sign</p>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var totalValue = 0;
            $('input[name="amount"]').each(function() {
                totalValue += parseInt($(this).val()) || 0;
            });
            $('input[name="total"]').val(totalValue);
        });
    </script>
</body>

</html>
