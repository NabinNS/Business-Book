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
                        <input type="text" id="partiessearchbar" class=" hide searchbar form-control shadow-none"
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
                                    <a href="" class="aremainingbalance">{{ $stockremainingbalance->stock_name }}</a>
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

                <div class="d-flex justify-content-between m-1">
                    <button class="btn-custom-grid2 grid2-edit" type="button" data-bs-toggle="modal"
                        data-bs-target="#EditPartyModal">Edit <i class="fa fa-edit"></i></button>
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
                        data-bs-target="#AddPayment">Payment</button>
                </div>
            </div>

            <table class="table table-hover" id="ledgertable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th class="col-md-4">Particulars</th>
                        <th class="col-md-2">Purchase QTY</th>
                        <th class="col-md-1">Rate</th>
                        <th class="col-md-2">Amount</th>
                        <th class="col-md-2">Issued QTY</th>
                        <th class="col-md-2">Balance</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>2079/12/1</td>
                        <td>Opening Balance</td>
                        <td>5</td>
                        <td>5000</td>
                        <td>25000</td>
                        <td>10</td>
                        <td>-5</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>




    <div>

        <div class="modal fade" id="AddStockModal" tabindex="-1" aria-labelledby="AddStockModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Add Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('addnewstock') }}">
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
                                            <input type="number" class="form-control" id="floatingInput"
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
@endsection




@push('scripts')
    <script>
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
    </script>
@endpush
