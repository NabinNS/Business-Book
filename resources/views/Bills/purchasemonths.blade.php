@extends('partials')
@section('content')
    <div class="c-grid-item">
        <div class="d-flex justify-content-center">
            <h3 class="c-heading m-4">Purchase Bills Months</h3>
        </div>

        <table class="table table-striped mx-auto" id="listingtable">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Month</th>
                    <th>Total Purchase</th>
                    <th>Vat (13%)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchasemonths as $purchasemonth)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('purchaseDetail', $purchasemonth->month_number) }}" class="aremainingbalance">
                                {{ $purchasemonth->month_name }} </a></td>
                        <td>{{ number_format($purchasemonth->total / 1.13, 2) }}</td>
                        <td>{{ number_format(($purchasemonth->total / 1.13) * 0.13, 2) }}</td>
                        <td>{{ $purchasemonth->total }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
