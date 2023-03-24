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
            <form action="/viewdaybook" method="get">
                @csrf
                <div class="d-flex justify-content-between">

                    <div>
                        <div class="input-group">
                            <select class="custom-select select-sizing" name="option">
                                <option value="All">All Transaction</option>
                                <option value="Purchase">Purchase</option>
                                <option value="Sales">Sales</option>
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

            <table class="table mt-3 table-bordered">
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
                <tbody>

                    @foreach ($sortedDetails as $detail)
                        <tr>
                            <td>{{ $detail->date }}</td>
                            @if ($detail instanceof App\Models\AccountLedger)
                                <td>{{ $detail->companyDetails->company_name }}</td>
                                <td>{{ $detail->particulars }}</td>
                            @else
                                <td>{{ $detail->customerDetail->customer_name }}</td>
                                <td>{{ $detail->particulars }}</td>
                            @endif
                            <td>{{ $detail->receipt_no }}</td>
                            <td>{{ $detail->debit ?? $detail->credit }}</td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
            <div class="d-flex justify-content-end">
                {{ $sortedDetails->links() }}
            </div>

        </div>



    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
