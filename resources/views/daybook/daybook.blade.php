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
                <h6 class="text-center font">Day Book</h6>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="dash-topcard ">
                    <h5 class="text-center text-success">Rs {{ $totalCashReceived }}</h5>
                    <h6 class="text-center">Total Cash Received</h6>
                </div>
                <div class="dash-topcard ">

                    <h5 class="text-center text-danger">Rs {{ $totalCashPaid }}</h5>
                    <h6 class="text-center">Total Cash Paid</h6>
                </div>
                <div class="dash-topcard ">

                    <h5 class="text-center text-warning">Rs {{ $totalPurchase }}</h5>
                    <h6 class="text-center">Total Purchase</h6>
                </div>
                <div class="dash-topcard ">

                    <h5 class="text-center text-info">Rs {{ $totalSales }}</h5>
                    <h6 class="text-center">Total Sales</h6>
                </div>
            </div>
            <hr class="mb-3">
            <form action="/viewdaybook" method="get">
                @csrf
                <div class="d-flex justify-content-between mb-3">

                    <div>
                        <div class="input-group">
                            <select class="custom-select daybook-select-sizing" name="option">
                                <option value="All">All Transaction</option>
                                <option value="Parties">Parties Transaction</option>
                                <option value="Customer">Customer Transaction</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn-custom bg-secondary" id="toogleSearchbar">
                                    From
                                </button>
                            </div>
                            <input type="date" name="from" value="{{ $startDate }}" />
                            <div class="input-group-append">
                                <button class="btn-custom bg-secondary" id="toogleSearchbar">
                                    To
                                </button>
                            </div>
                            <input type="date" name="to" value="{{ $endDate }}" />
                            <div class="input-group-append">
                                <button class="btn-custom ms-1" type="submit" id="toogleSearchbar">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table mt-3 table-bordered" id="listingtable">
                <colgroup>
                    <col style="width: 10%;">
                    <col style="width: 35%;">
                    <col style="width: 25%;">
                    <col style="width: 15%;">
                    <col style="width: 20%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Voucher No</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sortedDetails as $detail)
                        <tr>
                            <td>{{ $detail->date }}</td>
                            @if ($detail->company_details_id)
                                <td>{{ $detail->companyDetails->company_name }}</td>
                                <td>{{ $detail->particulars }}</td>
                            @else
                                <td>{{ $detail->CustomerDetail->customer_name }}</td>
                                <td>{{ $detail->particulars }}</td>
                            @endif
                            <td>{{ $detail->receipt_no }}</td>
                            <td>{{ $detail->debit ?? $detail->credit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>



    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#listingtable').DataTable();
        });
    </script>
@endpush
