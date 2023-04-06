@extends('partials')
@section('content')
    <div class="c-grid-item">
        <div class="d-flex justify-content-center">
            <h3 class="c-heading m-4">Purchase Bills for {{ $monthName }}</h3>
        </div>

        <table class="table table-striped mx-auto" id="listingtable">
            <colgroup>

                <col style="width: 10%;">
                <col style="width: 25%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
            </colgroup>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name of Buyer</th>
                    <th>Vat Number</th>
                    <th>Taxable Amount</th>
                    <th>VAT</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchasebills as $purchasebill)
                    <tr>
                        <td>{{ $purchasebill->date }}</td>
                        <td>{{ $purchasebill->companyDetails->company_name }}</td>
                        <td>{{ $purchasebill->companyDetails->vat_number }}</td>
                        <td>{{ number_format($purchasebill->credit / 1.13, 2) }}</td>
                        <td>{{ number_format(($purchasebill->credit / 1.13) * 0.13, 2) }}</td>
                        <td>{{ $purchasebill->credit }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#listingtable').DataTable();
        });
    </script>
@endpush
