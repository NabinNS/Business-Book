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


    <div class="grid-container">
        <div class="grid-item grid-item-1">
            <div class="shadow p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
                <h6 class="text-center font">Stocks list</h6>
            </div>
            <div class="d-flex">
                <div class="container">
                    <div class="input-group">
                        <span class="input-group-text hide searchbar btn-custom" id="basic-addon1"><i
                                class="fas fa-search"></i></span>
                        <input type="text" id="stocksearchbar" class=" hide searchbar form-control shadow-none"
                            placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn-custom" id="toogleSearchbar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="container addbutton">
                    <button class="btn-custom btn-size ms-5" type="button" data-bs-toggle="modal"
                        data-bs-target="#AddStockModal">Add Stock</button>
                </div>
            </div>

            <div>
                <table class="table mt-2 partysummarytable table-hover" id="summarytable">
                    <thead class="mt-4">
                        <tr>
                            <th>Name</th>
                            <th class="text-end">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockremainingbalances as $stockremainingbalance)
                            <tr>
                                <td>
                                    <a href="{{ route('viewStockLedger', $stockremainingbalance->stock_name) }}"
                                        class="aremainingbalance">{{ $stockremainingbalance->stock_name }}</a>
                                </td>
                                <td>{{ $stockremainingbalance->stockRemainingBalance->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
        <div class="grid-item grid-item-2">
            <div class="mx-2">
                @if ($stockDetail)
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="m-1 d-inline">Stock Name:</h6>
                            <h6 class="d-inline">{{ $stockDetail->stock_name }}</h6>
                        </div>
                        <div>
                            <h6 class="m-1 d-inline">Limit:</h6>
                            <h6 class="d-inline">{{ $stockDetail->limit }}</h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="m-1 d-inline">Purchase price:</h6>
                            <h6 class="d-inline">{{ $stockDetail->purchase_price }}</h6>
                        </div>
                        <div>
                            <h6 class="m-1 d-inline">Category:</h6>
                            <h6 class="d-inline">{{ $stockDetail->category }}</h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="m-1 d-inline">Sale price:</h6>
                            <h6 class="d-inline">{{ $stockDetail->sales_price }}</h6>

                        </div>
                        <div>
                            <h6 class="m-1 d-inline">Stock Value:</h6>

                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-between m-1">
                    <button class="btn-custom-grid2 grid2-edit" type="button" data-bs-toggle="modal"
                        data-bs-target="#EditStockModal">Edit <i class="fa fa-edit"></i></button>
                    <button class="btn-custom-grid2 grid2-download">Download <i class="fa fa-download"></i></button>
                    <button class="btn-custom-grid2 grid2-delete">Delete <i class="fa fa-trash"></i></button>
                </div>
            </div>

        </div>
        <div class="grid-item grid-item-3">
            <h5 class="m-2 text">General Ledger</h5>
            <hr class="text">

            <div class="d-flex justify-content-between m-2">

                <div class="form-group">
                    <input type="text" class="form-control ledgersearch" placeholder="Search" />
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success ms-2" data-bs-toggle="modal"
                        data-bs-target="#AddPurchase">Purchase</button>
                    <button type="button" class="btn btn-outline-danger ms-2" data-bs-toggle="modal"
                        data-bs-target="#AddSales">Sales</button>
                </div>
            </div>

            <table class="table table-hover" id="ledgertable">
                <thead>
                    <tr>
                        <th class="col-md-2">Date</th>
                        <th class="col-md-4">Particulars</th>
                        <th class="col-md-2">Purchase QTY</th>
                        <th class="col-md-1">Rate</th>
                        <th class="col-md-2">Issued QTY</th>
                        <th class="col-md-2">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($stockDetail)
                        @php
                            $balance = $stockDetail->opening_balance;
                        @endphp
                        <tr>
                            <td>{{ $stockDetail->date }}</td>
                            <td>Opening Balance</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $balance }}</td>

                        </tr>

                        @foreach ($stockledgers as $stockledger)
                            <tr id="{{ $stockledger->stockledger_id }}" data-stock-name="{{ $stockDetail->stock_name }}">
                                @php
                                    $balance += $stockledger->quantity - $stockledger->issued_quantity;
                                @endphp
                                <td>{{ $stockledger->date }}</td>
                                <td>{{ $stockledger->particulars }} bill no {{ $stockledger->receipt_no }}</td>
                                <td>{{ $stockledger->quantity }}</td>
                                <td>{{ $stockledger->rate }}</td>
                                <td>{{ $stockledger->issued_quantity }}</td>
                                <td>{{ $balance }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>

    </div>



    {{-- Modal for adding new product --}}
    <div>

        <div class="modal fade" id="AddStockModal" tabindex="-1" aria-labelledby="AddStockModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Add Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('addnewstock') }}" id="AddNewStockForm">
                        <div class="modal-body">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="stockname">
                                <label for="floatingInput">Stock Name</label>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around m-3">
                                <h6 class="topicadditionalinfo under-border">Stock</h6>
                                <h6 class="topicotherinfo">Pricing</h6>
                            </div>

                            <div class="additionalinfo">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Limit" name="limit">
                                            <label for="floatingInput">Limit</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Opening Balance" name="openingbalance">
                                            <label for="floatingInput">Opening Balance</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="datepicker"
                                                placeholder="As of" name="date">
                                            <label for="floatingInput">As of</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Category" name="category">
                                            <label for="floatingInput">Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="otherinfo hide">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Purchase Price" name="purchaseprice">
                                            <label for="floatingInput">Purchase Price</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Sales Price" name="salesprice">
                                            <label for="floatingInput">Sales Price</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for sale of product --}}
    <div>
        <div class="modal fade" id="AddSales" tabindex="-1" aria-labelledby="AddSalesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font text-danger" id="exampleModalLabel">Product Sales Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('stocksales') }}" id="salesrecordform">
                        <div class="modal-body">
                            <div class="d-flex justify-content-start">
                                <div class="form-floating mb-3 col-6">
                                    <input type="date" class="form-control" id="floatingInput" placeholder="date"
                                        name="date">
                                    <label for="floatingInput">Date</label>
                                </div>

                            </div>
                            <div class="input-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Product Name" name="productname" readonly
                                        value="{{ $stockDetail->stock_name ?? '' }}">
                                    <label for="floatingInput">Product Name</label>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="billno">
                                        <label for="floatingInput">Bill Number</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Sales Quantity" name="issuedquantity">
                                        <label for="floatingInput">Issued Quantity</label>
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Save sales</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for purchase of product --}}
    <div>
        <div class="modal fade" id="AddPurchase" tabindex="-1" aria-labelledby="AddPurchaseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font text-success" id="exampleModalLabel">Product Purchase Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('stockpurchase') }}" id="purchaserecordform">
                        <div class="modal-body">

                            <div class="input-group">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Product Name" name="productname" readonly
                                        value="{{ $stockDetail->stock_name ?? '' }}">
                                    <label for="floatingInput">Product Name</label>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="floatingInput" placeholder="date"
                                            name="date">
                                        <label for="floatingInput">Date</label>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="billno">
                                        <label for="floatingInput">Bill Number</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Purchase Quantity" name="purchasequantity">
                                        <label for="floatingInput">Purchase Quantity</label>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="Rate"
                                            name="rate">
                                        <label for="floatingInput">Rate</label>
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Save purchase</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for editing product --}}
    <div>

        <div class="modal fade" id="EditStockModal" tabindex="-1" aria-labelledby="AddStockModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Edit Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('editstock', $stockDetail->stock_name) }}" id="EditStockForm">
                        <div class="modal-body">
                            <input type="hidden" name="stockID" value="{{ $stockDetail->id }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="stockname"
                                    value="{{ $stockDetail->stock_name }}">
                                <label for="floatingInput">Stock Name</label>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around m-3">
                                <h6 class="topicadditionalinfo under-border">Stock</h6>
                                <h6 class="topicotherinfo">Pricing</h6>
                            </div>

                            <div class="additionalinfo">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Limit" name="limit" value="{{ $stockDetail->limit }}">
                                            <label for="floatingInput">Limit</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Opening Balance" name="openingbalance"
                                                value="{{ $stockDetail->opening_balance }}">
                                            <label for="floatingInput">Opening Balance</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="datepicker"
                                                placeholder="As of" name="date"value="{{ $stockDetail->date }}">
                                            <label for="floatingInput">As of</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Category" name="category"
                                                value="{{ $stockDetail->category }}">
                                            <label for="floatingInput">Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="otherinfo hide">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Purchase Price" name="purchaseprice"
                                                value="{{ $stockDetail->purchase_price }}">
                                            <label for="floatingInput">Purchase Price</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Sales Price" name="salesprice"
                                                value="{{ $stockDetail->sales_price }}">
                                            <label for="floatingInput">Sales Price</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




@push('scripts')
    <script>
        $(document).ready(function() {


            $("tr").dblclick(function() {
                var id = $(this).attr("id");
                var stockName = $(this).data("stock-name");

                if (id) {
                    window.location.href = '/stocks/editstockledger/' + id + '/' + stockName;
                } else {
                    $('#EditStockForm').modal('show');
                }
            });
            $('#AddStockModal').on('hidden.bs.modal', function(e) {
                $("#AddNewStockForm")[0].reset();
            });
            $('#AddPurchase').on('hidden.bs.modal', function(e) {
                $("#purchaserecordform")[0].reset();
            });
            $('#AddSales').on('hidden.bs.modal', function(e) {
                $("#salesrecordform")[0].reset();
            });
            $('#EditStockModal').on('hidden.bs.modal', function(e) {
                $("#EditStockForm")[0].reset();
            });


            $('.topicotherinfo').click(function() {
                $(".otherinfo").removeClass("hide");
                $(".additionalinfo").addClass("hide");
                $(".topicotherinfo").addClass("under-border");
                $(".topicadditionalinfo").removeClass("under-border");
            });
            $('.topicadditionalinfo').click(function() {
                $(".otherinfo").addClass("hide");
                $(".topicadditionalinfo").addClass("under-border");
                $(".topicotherinfo").removeClass("under-border");
                $(".additionalinfo").removeClass("hide");
            });

            $("#toogleSearchbar").click(function() {
                $(".searchbar").removeClass("hide");
                $("#stocksearchbar").focus();
                $('#toogleSearchbar').hide();
                $('.addbutton').hide();
            });
            $("#stocksearchbar").focusout(function() {
                if ($(this).val()) {
                    return;
                }
                $(".searchbar").addClass("hide");
                $('#toogleSearchbar').show();
                $('.addbutton').show();
            });

            $('#AddStockModal,#AddSales,#AddPurchase').modal({
                backdrop: 'static',
            });
            $("#stocksearchbar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#summarytable tbody tr").filter(function() {
                    $(this).toggle($(this).find("td:first-child").text().toLowerCase().indexOf(
                        value) > -1)
                });
            });
            $(".ledgersearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#ledgertable tbody tr").filter(function() {
                    $(this).toggle($(this).find("td").text().toLowerCase().indexOf(
                        value) > -1)
                });
            });

        });
    </script>
@endpush
