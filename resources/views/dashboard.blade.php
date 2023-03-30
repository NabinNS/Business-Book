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
        <div class="d-flex justify-content-between">
            <div>
                <h6>chart</h6>
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



    </div>
@endsection
@push('scripts')
    {{-- <script script script src="{{ asset('js/script.js') }}"></script> --}}
@endpush
