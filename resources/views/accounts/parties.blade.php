@extends('partials')
@section('content')
    <!-- codes here -->


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
                <h6 class="text-center font">Parties list</h6>
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
                        data-bs-target="#AddPartyModal">Add Party</button>
                </div>
            </div>

            {{-- table to show summary of accounts --}}
            <div>
                <table class="table mt-2 partysummarytable table-hover" id="summarytable">
                    <thead class="mt-4">
                        <tr>
                            <th>Name</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accountremainingbalances as $accountremainingbalance)
                            <tr>

                                <td><a href="{{ route('viewLedger', $accountremainingbalance->company_name) }}"
                                        class="aremainingbalance"> {{ $accountremainingbalance->company_name }} </a></td>
                                <td>{{ $accountremainingbalance->accountRemainingBalance->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- End table summary code --}}
        </div>
        <div class="grid-item grid-item-2">
            <div class="mx-2">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="m-1 d-inline">Company Name:</h6>
                        <h6 class="d-inline">{{ $companyDetail->company_name }}</h6>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="m-1 d-inline">Email Address:</h6>
                        <p class="d-inline">{{ $companyDetail->email_address }}</p>
                    </div>
                    <div>
                        <h6 class="m-1 d-inline">Address:</h6>
                        <p class="d-inline">{{ $companyDetail->address }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="m-1 d-inline">Vat Number:</h6>
                        <p class="d-inline">{{ $companyDetail->vat_number }}</p>
                    </div>
                    <div>
                        <h6 class="m-1 d-inline">Phone Number:</h6>
                        <p class="d-inline">{{ $companyDetail->phone_number }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between m-1">
                    <button class="btn-custom-grid2 grid2-edit" type="button" data-bs-toggle="modal"
                        data-bs-target="#EditPartyModal">Edit <i class="fa fa-edit"></i></button>
                    <button class="btn-custom-grid2 grid2-download">Download <i class="fa fa-download"></i></button>
                    <button class="btn-custom-grid2 grid2-delete">Delete <i class="fa fa-trash"></i></button>
                </div>
            </div>

        </div>
        {{-- Grid 2 ends here --}}

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

            <table class="table table-striped table-hover" id="ledgertable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th class="col-md-4">Particulars</th>
                        <th>Voucher No</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $balance = $companyDetail->opening_balance;
                    @endphp
                    <tr>
                        <td>{{ $companyDetail->date }}</td>
                        <td>Opening Balance</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $balance }}</td>

                    </tr>
                    @foreach ($accountledgers as $accountledger)
                        <tr id="{{ $accountledger->acc_id }}" data-company-name="{{ $companyDetail->company_name }}">
                            @php
                                $balance += $accountledger->credit - $accountledger->debit;
                            @endphp
                            <td>{{ $accountledger->date }}</td>
                            <td>{{ $accountledger->particulars }}</td>
                            <td>{{ $accountledger->receipt_no }}</td>
                            <td>{{ $accountledger->debit }}</td>
                            <td>{{ $accountledger->credit }}</td>
                            <td>{{ $balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal to add new party-->
    <div>

        <div class="modal fade" id="AddPartyModal" tabindex="-1" aria-labelledby="AddPartyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Add Party</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('addnewparty') }}">
                        <div class="modal-body">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="companyname">
                                <label for="floatingInput">Company Name</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="vatnumber">
                                        <label for="floatingInput">Vat Number</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Phone Number" name="phonenumber">
                                        <label for="floatingInput">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around m-3">
                                <h6 class="topicadditionalinfo under-border">Additional Information</h6>
                                <h6 class="topicotherinfo">Other Information</h6>
                            </div>

                            <div class="additionalinfo">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Address" name="address">
                                            <label for="floatingInput">Address</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Email" name="emailaddress">
                                            <label for="floatingInput">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="otherinfo hide">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Opening Balance" name="openingbalance">
                                            <label for="floatingInput">Opening Balance</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="datepicker"
                                                placeholder="As of" name="date">
                                            <label for="floatingInput">As of</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Party</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for purchase --}}
    <div>
        <div class="modal fade" id="AddPurchase" tabindex="-1" aria-labelledby="AddPurchaseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font text-success" id="exampleModalLabel">Goods Purchase Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('ledgerpurchase') }}" id="purchaserecordform">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Company Name" name="companyname" readonly
                                        value="{{ $companyDetail->company_name }}">
                                    <label for="floatingInput">Company Name</label>
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
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="Purchasetype">
                                            <option value="credit">Credit</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                        <label for="floatingSelect">Purchase Mode</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="amount">
                                        <label for="floatingInput">Total Amount</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row hide cashpayment">
                                <hr>
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="Paymenttype">
                                            <option value="cheque">Cheque</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                        <label for="floatingSelect">Payment Mode</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Voucher Number" name="voucherno">
                                        <label for="floatingInput">Voucher Number</label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <a href="{{ route('billpage', 'purchase') }}" class="btn btn-primary">Add Detail Transaction</a>
                                <div>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save purchase</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for payment --}}
    <div>
        <div class="modal fade" id="AddPayment" tabindex="-1" aria-labelledby="AddPartyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font text-danger" id="exampleModalLabel">Payment In Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('cash') }}" id="cashrecordform">
                        <div class="modal-body">


                            {{-- <div class="input-group mb-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                    placeholder="Company Name" name="companyname" readonly
                                    value="{{ $companyDetail->company_name }}">
                                <label for="floatingInput">Company Name</label>

                                <select id="normalize" name="companyname" class="hide selectcompany" disabled>
                                    @foreach ($accountremainingbalances as $companyname)
                                        <option value="{{ $companyname->company_name }}">{{ $companyname->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group-append">
                                <button type="button"
                                    class="btn btn-success rounded-0  p-3 changecompany">Change</button>
                            </div>
                        </div> --}}


                            <div class="input-group mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Company Name" name="companyname" readonly
                                        value="{{ $companyDetail->company_name }}">
                                    <label for="floatingInput">Company Name</label>
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
                                            placeholder="Vat Number" name="voucherno">
                                        <label for="floatingInput">Voucher Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="type">
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="others">others</option>
                                        </select>
                                        <label for="floatingSelect">Payment Mode</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="amount">
                                        <label for="floatingInput">Amount</label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Save payment</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for editing parties --}}
    <div>
        <div class="modal fade" id="EditPartyModal" tabindex="-1" aria-labelledby="AddPartyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Edit Party</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('editcompany', $companyDetail->company_name) }}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="companyID" value="{{ $companyDetail->id }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="companyname"
                                    value="{{ $companyDetail->company_name }}">
                                <label for="floatingInput">Company Name</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="vatnumber"
                                            value="{{ $companyDetail->vat_number }}">
                                        <label for="floatingInput">Vat Number</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Phone Number" name="phonenumber"
                                            value="{{ $companyDetail->phone_number }}">
                                        <label for="floatingInput">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around m-3">
                                <h6 class="topicadditionalinfo under-border">Additional Information</h6>
                                <h6 class="topicotherinfo">Other Information</h6>
                            </div>
                            <div class="additionalinfo">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Address" name="address"
                                                value="{{ $companyDetail->address }}">
                                            <label for="floatingInput">Address</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Email" name="emailaddress"
                                                value="{{ $companyDetail->email_address }}">
                                            <label for="floatingInput">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="otherinfo hide">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Opening Balance" name="openingbalance"
                                                value="{{ $companyDetail->opening_balance }}">
                                            <label for="floatingInput">Opening Balance</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="datepicker"
                                                placeholder="As of" name="date" value="{{ $companyDetail->date }}">
                                            <label for="floatingInput">As of</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Party </button>
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

            $("#toogleSearchbar").click(function() {
                $(".searchbar").removeClass("hide");
                $("#partiessearchbar").focus();
                $('#toogleSearchbar').hide();
                $('.addbutton').hide();
            });


            $("tr").dblclick(function() {
                var id = $(this).attr("id");
                var companyName = $(this).data("company-name");
                if (id) {

                    window.location.href = '/parties/editledger/' + id + '/' + companyName;
                } else {
                    $('#EditPartyModal').modal('show');
                }
            });

            // $(".changecompany").click(function() {
            //     $(".selectcompany").toggleClass("hide");

            //     $(".fieldcompanyname").toggleClass("hide");

            //     if ($(".selectcompany").hasClass("hide")) {
            //         $(".selectcompany").prop("disabled", true);
            //     } else {
            //         $(".selectcompany").prop("disabled", false);
            //     }

            //     if ($(".fieldcompanyname").hasClass("hide")) {
            //         $(".fieldcompanyname").prop("disabled", true);
            //     } else {
            //         $(".fieldcompanyname").prop("disabled", false);
            //     }

            // });

            $("#partiessearchbar").focusout(function() {
                if ($(this).val()) {
                    return;
                }
                $(".searchbar").addClass("hide");
                $('#toogleSearchbar').show();
                $('.addbutton').show();
            });

            $('#AddPartyModal, #AddPayment, #AddPurchase').modal({
                backdrop: 'static',
            });
            // $('#otherinfo').click(function() {
            //     $(".otherinfo").removeClass("hide");
            //     $(".additionalinfo").addClass("hide");
            //     $("#otherinfo").addClass("under-border");
            //     $("#additionalinfo").removeClass("under-border");
            // });
            // $('#additionalinfo').click(function() {
            //     $(".otherinfo").addClass("hide");
            //     $("#additionalinfo").addClass("under-border");
            //     $("#otherinfo").removeClass("under-border");
            //     $(".additionalinfo").removeClass("hide");
            // });
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
            $('#AddPartyModal').on('hidden.bs.modal', function(e) {
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end()
            });
            $('#AddPayment').on('hidden.bs.modal', function(e) {
                $("#cashrecordform")[0].reset();
            });

            $('#AddPurchase').on('hidden.bs.modal', function(e) {
                $("#purchaserecordform")[0].reset();
            });

            $("#partiessearchbar").on("keyup", function() {
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

            $('select[name="Purchasetype"]').change(function() {
                if ($(this).val() == 'cash') {
                    $('.cashpayment').removeClass("hide");
                } else {
                    $('.cashpayment').addClass("hide");
                }
            });
        });
    </script>
@endpush
