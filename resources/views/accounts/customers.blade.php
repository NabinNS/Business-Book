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
                <h6 class="text-center font">Customers list</h6>
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
                    @if (auth()->user()->role != 'marketing')
                    <button class="btn-custom Cus-btn-size ms-5" type="button" data-bs-toggle="modal"
                        data-bs-target="#AddCustomerModal">Add Customer</button>
                    @endif
                </div>
            </div>

            <!-- Modal to add new customer-->
            <div class="modal fade" id="AddCustomerModal" tabindex="-1" aria-labelledby="AddCutomerModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center font" id="exampleModalLabel">Add Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <form method="get" action="{{ route('addnewcustomer') }}">
                            <div class="modal-body">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" name="customername">
                                    <label for="floatingInput">Customer Name</label>
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
                                <button type="submit" class="btn btn-primary">Save Customer</button>
                            </div>
                        </form>
                    </div>
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
                        @foreach ($customerremainingbalances as $customerremainingbalance)
                            <tr>

                                <td><a href="{{ route('viewCustomerLedger', $customerremainingbalance->customer_name) }}"
                                        class="aremainingbalance"> {{ $customerremainingbalance->customer_name }} </a></td>
                                <td>{{ $customerremainingbalance->customerRemainingBalance->amount }}</td>
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
                        <h6 class="m-1 d-inline">Customer Name:</h6>
                        <h6 class="d-inline">{{ $customerDetail->customer_name }}</h6>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="m-1 d-inline">Email Address:</h6>
                        <p class="d-inline">{{ $customerDetail->email_address }}</p>
                    </div>
                    <div>
                        <h6 class="m-1 d-inline">Address:</h6>
                        <p class="d-inline">{{ $customerDetail->address }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="m-1 d-inline">Vat Number:</h6>
                        <p class="d-inline">{{ $customerDetail->vat_number }}</p>
                    </div>
                    <div>
                        <h6 class="m-1 d-inline">Phone Number:</h6>
                        <p class="d-inline">{{ $customerDetail->phone_number }}</p>
                    </div>
                </div>
                @if (auth()->user()->role != 'marketing')
                <div class="d-flex justify-content-end m-1">
                    <button class="btn btn-outline-success btn-sm me-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#EditCustomerModal">Edit <i class="fa fa-edit"></i></button>
                    <button class="btn btn-outline-danger btn-sm">Delete <i class="fa fa-trash"></i></button>
                </div>
                @endif
            </div>

        </div>
        {{-- Grid 2 ends here --}}

        <div class="grid-item grid-item-3">


            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="mt-2 text ms-2">General Ledger</h5>

                </div>
                <div>
                    <button class="mt-2 me-2 btn btn-secondary btn-sm" id="download-btn">Download PDF</button>
                </div>
            </div>
            <hr class="text mt-2 mb-1">

            <div class="d-flex justify-content-between m-2">

                <div class="form-group">
                    <input type="text" class="form-control ledgersearch" placeholder="Search" />
                </div>
                <div>
                    @if (auth()->user()->role != 'marketing')
                        <button type="button" class="btn btn-outline-success ms-2" data-bs-toggle="modal"
                            data-bs-target="#AddSales">Sales</button>
                        <button type="button" class="btn btn-outline-danger ms-2" data-bs-toggle="modal"
                            data-bs-target="#AddPayment">Cash In</button>
                    @endif
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
                        $balance = $customerDetail->opening_balance;
                    @endphp
                    <tr>
                        <td>{{ $customerDetail->date }}</td>
                        <td>Opening Balance</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $balance }}</td>

                    </tr>
                    @foreach ($customerledgers as $customerledger)
                        <tr id="{{ $customerledger->customerledger_id }}" data-company-name="{{ $customerledger->customer_name }}">
                            @php
                                $balance += $customerledger->debit - $customerledger->credit;
                            @endphp
                            <td>{{ $customerledger->date }}</td>
                            <td>{{ $customerledger->particulars }}</td>
                            <td>{{ $customerledger->receipt_no }}</td>
                            <td>{{ $customerledger->debit }}</td>
                            <td>{{ $customerledger->credit }}</td>
                            <td>{{ $balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {{-- Edit transaction --}}
    <div>
        <div class="modal fade" id="EditTransaction" tabindex="-1" aria-labelledby="AddPurchaseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font text-success" id="exampleModalLabel">Edit Transaction Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="get" action="{{ route('editcustomertransaction') }}" id="purchaserecordform">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="transactionid">
                            <input type="hidden" name="type" id="transactiontype">
                            <div class="input-group mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Company Name" name="customername" readonly
                                        value="{{ $customerDetail->customer_name }}">
                                    <label for="floatingInput">Customer Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="date"
                                            name="date">
                                        <label for="floatingInput">Date</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="voucherNo"
                                            placeholder="Vat Number" name="billno">
                                        <label for="floatingInput">Bill Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="amount"
                                            placeholder="Total Amount" name="amount">
                                        <label for="floatingInput">Total Amount</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    {{-- Modal for sales --}}
    <div>
        <div class="modal fade" id="AddSales" tabindex="-1" aria-labelledby="AddSalesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font text-success" id="exampleModalLabel">Goods Sales Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('ledgersales') }}" id="purchaserecordform">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Company Name" name="customername" readonly
                                        value="{{ $customerDetail->customer_name }}">
                                    <label for="floatingInput">Customer Name</label>
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
                                        <select class="form-select" id="floatingSelect" name="Salestype">
                                            <option value="credit">Credit</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                        <label for="floatingSelect">Sales Mode</label>
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
                                <a href="{{ route('billpage', 'sales') }}" class="btn btn-primary">Add Detail
                                    Transaction</a>
                                <div>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save sales</button>
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
                    <form method="get" action="{{ route('customercash') }}" id="cashrecordform">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control fieldcompanyname" id="floatingInput"
                                        placeholder="Company Name" name="customername" readonly
                                        value="{{ $customerDetail->customer_name }}">
                                    <label for="floatingInput">Customer Name</label>
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
        <div class="modal fade" id="EditCustomerModal" tabindex="-1" aria-labelledby="EditCustomerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Edit Customer Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('editcustomer', $customerDetail->customer_name) }}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="customerID" value="{{ $customerDetail->id }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="customername"
                                    value="{{ $customerDetail->customer_name }}">
                                <label for="floatingInput">Customer Name</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Vat Number" name="vatnumber"
                                            value="{{ $customerDetail->vat_number }}">
                                        <label for="floatingInput">Vat Number</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Phone Number" name="phonenumber"
                                            value="{{ $customerDetail->phone_number }}">
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
                                                value="{{ $customerDetail->address }}">
                                            <label for="floatingInput">Address</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Email" name="emailaddress"
                                                value="{{ $customerDetail->email_address }}">
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
                                                value="{{ $customerDetail->opening_balance }}">
                                            <label for="floatingInput">Opening Balance</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="datepicker"
                                                placeholder="As of" name="date" value="{{ $customerDetail->date }}">
                                            <label for="floatingInput">As of</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Customer </button>
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

            $('#ledgertable tr:gt(1) td').dblclick(function() {
                // Retrieve the data from the corresponding row
                var tr_id = $(this).closest('tr').attr('id');
                var date = $(this).closest('tr').find('td:nth-child(1)').text();
                var voucherNo = $(this).closest('tr').find('td:nth-child(3)').text();
                var debit = $(this).closest('tr').find('td:nth-child(4)').text();
                var credit = $(this).closest('tr').find('td:nth-child(5)').text();
                var balance = $(this).closest('tr').find('td:nth-child(6)').text();

                // Populate the modal with the retrieved data
                $('#EditTransaction #date').val(date);
                $('#EditTransaction #voucherNo').val(voucherNo);
                if (debit) {
                    $('#EditTransaction #amount').val(debit);
                    $('#EditTransaction #transactiontype').val('sales');
                }
                if (credit) {
                    $('#EditTransaction #amount').val(credit);
                    $('#EditTransaction #transactiontype').val('cash');
                }

                $('#EditTransaction #transactionid').val(tr_id);

                // Open the modal
                $('#EditTransaction').modal('show');
            });


            var table = $('#ledgertable').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                dom: 'frtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Export PDF',
                    title: '{{ $customerDetail->customer_name }}',
                    className: 'ms-2 btn btn-primary btn-sm',
                    customize: function(doc) {
                        // Set table width to cover the entire page
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                            .length + 1).join('*').split('');

                        // Add header content to the PDF
                        var header = [{
                            text: 'Business Book pvt ltd',
                            fontSize: 12,
                            alignment: 'center',
                            margin: [0, 0, 0, 10]
                        }];
                        doc.content.splice(0, 0, header);
                    }
                }],
                language: {
                    info: ''
                }
            });
            $('#download-btn').click(function() {
                $('#ledgertable').DataTable().button('.buttons-pdf').trigger();
            });

            $("#toogleSearchbar").click(function() {
                $(".searchbar").removeClass("hide");
                $("#partiessearchbar").focus();
                $('#toogleSearchbar').hide();
                $('.addbutton').hide();
            });


            // $("tr").dblclick(function() {
            //     var id = $(this).attr("id");
            //     var companyName = $(this).data("company-name");
            //     if (id) {

            //         window.location.href = '/parties/editledger/' + id + '/' + companyName;
            //     } else {
            //         // $('#AddCustomerModal').modal('show');
            //     }
            // });

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

            $('#AddCustomerModal, #AddPayment, #AddSales').modal({
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
            $('#AddCustomerModal').on('hidden.bs.modal', function(e) {
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end()
            });
            $('#AddPayment').on('hidden.bs.modal', function(e) {
                $("#cashrecordform")[0].reset();
            });

            $('#AddSales').on('hidden.bs.modal', function(e) {
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

            $('select[name="Salestype"]').change(function() {
                if ($(this).val() == 'cash') {
                    $('.cashpayment').removeClass("hide");
                } else {
                    $('.cashpayment').addClass("hide");
                }
            });
        });
    </script>
@endpush
