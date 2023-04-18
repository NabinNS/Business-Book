@extends('partials')
@section('content')
    <div class="c-grid-item">
        <div class="d-flex justify-content-center">
            <h3 class="c-heading m-4">Sales Bills Months</h3>
        </div>

        <table class="table table-striped mx-auto" id="listingtable">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Month</th>
                    <th>Total Sales</th>
                    <th>Vat (13%)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesmonths as $salesmonth)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('salesDetail', $salesmonth->month_number) }}" class="aremainingbalance">
                                {{ $salesmonth->month_name }} </a></td>
                        <td>{{ number_format($salesmonth->total / 1.13, 2) }}</td>
                        <td>{{ number_format(($salesmonth->total / 1.13) * 0.13, 2) }}</td>
                        <td>{{ $salesmonth->total }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
