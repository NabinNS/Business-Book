@extends('partials')
@section('content')
    <div class="dash-background">

        <div class="d-flex justify-content-between mt-3">
            <div class="dash-topcard ">
                <h5 class="text-center text-success">Rs {{ $customers }}</h5>
                <h6 class="text-center">Total Receivables</h6>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center text-danger">Rs {{ $parties }}</h5>
                <h6 class="text-center">Total Payables</h6>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center text-warning">Rs {{ $purchases }}</h5>
                <h6 class="text-center">Total Purchase</h6>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center text-info">Rs {{ $sales }}</h5>
                <h6 class="text-center">Total Sales</h6>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between row m-3">
            <div class="dash-chart">
                <canvas id="myChart"></canvas>
            </div>
            <div class="dash-cheque">
                <h6 class="text-center mt-1"><u>Cheque Details</u></h6>
                <table class="table table-hover" id="chequetable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unsettledCheques as $cheque)
                            @if ($cheque->debit)
                                <tr class="text-danger" data-from="company" data-record-id="{{ $cheque->acc_id }}">
                                    <td>{{ $cheque->date }}</td>
                                    <td> {{ $cheque->companyDetails->company_name }} </td>
                                    <td> {{ $cheque->debit }}</td>
                                </tr>
                            @else
                                <tr class="text-success" data-from="customer"
                                    data-record-id="{{ $cheque->customerledger_id }}">
                                    <td>{{ $cheque->date }}</td>
                                    <td> {{ $cheque->CustomerDetail->customer_name }}</td>
                                    <td> {{ $cheque->credit }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>



            </div>

        </div>

        <div class="d-flex justify-content-between mt-3">
            <div class="dash-bill">
                <h6 class="text-center mt-1"><u>Unpaid Bill Details</u></h6>
                <table class="table table-hover" id="billtable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Bill No</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customerBills as $customerBill)
                            <tr class="text-success" data-record-id="{{ $customerBill->customerledger_id }}">
                                <td>{{ $customerBill->date }}</td>
                                <td> {{ $customerBill->CustomerDetail->customer_name }} </td>
                                <td> {{ $customerBill->receipt_no }}</td>
                                <td> {{ $customerBill->debit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="dash-stock">
                <h6 class="text-center mt-1"><u>Low Stock Details</u></h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Limit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr class="text-danger">
                                <td>{{ $stock->stock_name }}</td>
                                <td> {{ $stock->quantity }} </td>
                                <td> {{ $stock->limit }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>



    </div>
@endsection
@push('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var purchaseData = {!! $purchaseData !!};
        var salesData = {!! $salesData !!};
        var cashOutData = {!! $cashOutData !!};
        var cashInData = {!! $cashInData !!};

        var labels = purchaseData.map(function(item) {
            return item.month_name;
        });

        var purchaseTotals = purchaseData.map(function(item) {
            return item.total;
        });

        var salesTotals = salesData.map(function(item) {
            return item.total;
        });

        var cashOutTotals = cashOutData.map(function(item) {
            return item.total;
        });

        var cashInTotals = cashInData.map(function(item) {
            return item.total;
        });

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Purchases',
                        data: purchaseTotals,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,

                    },
                    {
                        label: 'Sales',
                        data: salesTotals,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,

                    },
                    {
                        label: 'Cash Out',
                        data: cashOutTotals,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1,

                    },
                    {
                        label: 'Cash In',
                        data: cashInTotals,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //unsettled cheque convert to settle jquery code
        $(document).on('click', '.dash-cheque tbody tr', function() {

            var recordId = $(this).data('record-id');
            var from = $(this).data('from');
            var $row = $(this);
            Swal.fire({
                title: 'Has this cheque been settled?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it has'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to the server to update the record
                    $.ajax({
                        url: 'dashboard/update-chequerecord/' + from + '/' + recordId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $row.remove();
                            Swal.fire(
                                'Settled!',
                                'The record has been settled.',
                                'success'
                            )
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    });
                }
            });
        });
        //unpaid bill jquery code to change it to paid
        $(document).on('click', '.dash-bill tbody tr', function() {

            var recordId = $(this).data('record-id');
            var $row = $(this);
            console.log(recordId);
            Swal.fire({
                title: 'Has this bill been cashed?',
                text: "You won't be able to revert this!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it has'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to the server to update the record
                    $.ajax({
                        url: 'dashboard/update-billrecord/'+recordId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $row.remove();
                            Swal.fire(
                                'Settled!',
                                'The record has been settled.',
                                'success'
                            )
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    });
                }
            });
        });
    </script>
@endpush
