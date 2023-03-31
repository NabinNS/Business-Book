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
                <table class="table">
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
                                <tr class="text-danger">
                                    <td>{{ $cheque->date }}</td>
                                    <td> {{ $cheque->companyDetails->company_name }} </td>
                                    <td> {{ $cheque->debit }}</td>
                                </tr>
                            @else
                                <tr class="text-success">
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Bill No</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="dash-stock">


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
    </script>
@endpush
