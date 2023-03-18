@extends('partials')
@section('content')
    <div class="accordion" id="accordionExample">
        @php
            $previousBalance = 0; // Initialize previous month's balance to 0
        @endphp
        @foreach ($partyMonthlyCredit as $credit)
            @php
                $monthName = date('F', mktime(0, 0, 0, $credit->month, 1, 2000));
                $partyCredit = $credit->total_credit;
                
                // Find the corresponding customer credit for the same month and year
                $customerCredit = 0;
                
                foreach ($customerMonthlyCredit as $customer) {
                    if ($customer->month == $credit->month && $customer->year == $credit->year) {
                        $customerCredit = $customer->total_credit;
                        break;
                    }
                }
                
                // $difference = $partyCredit - $customerCredit + $previousBalance;
                $monthDifference = round(($customerCredit / 1.13) * 0.13 - ($partyCredit / 1.13) * 0.13, 2);
                
                // $purchaseWV = (float)number_format($partyCredit / 1.13, 2);
                // $salesWV = (float)number_format($customerCredit / 1.13, 2);
                
            @endphp

            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $monthName }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#{{ $monthName }}" aria-expanded="true" aria-controls="{{ $monthName }}">
                        Vat Report for the month of &nbsp; <strong>{{ $monthName }} {{ $credit->year }}</strong>
                    </button>
                </h2>
                <div id="{{ $monthName }}" class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $monthName }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Particulars</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center">Purchase records of {{ $monthName }}</th>
                                    </tr>
                                    <tr>
                                        <td>Total Purchase without VAT</td>
                                        <td>{{ number_format($partyCredit / 1.13, 2) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Total Tax (13%)</td>
                                        <td>{{ number_format(($partyCredit / 1.13) * 0.13, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Purchase including VAT</td>
                                        <td>{{ $partyCredit }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">Sales record of {{ $monthName }}</th>
                                    </tr>
                                    <tr>
                                        <td>Total sales without VAT</td>
                                        <td>{{ number_format($customerCredit / 1.13, 2) }}</td>

                                    </tr>
                                    <tr>
                                        <td>Total Tax (13%)</td>
                                        <td>{{ number_format(($customerCredit / 1.13) * 0.13, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total sales including VAT</td>
                                        <td>{{ $customerCredit }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <strong>Debit or Credit of previous month: {{ $previousBalance }}</strong><br>


                        <strong>Current month's difference:{{ $monthDifference }}</strong> <br>

                        <strong>Total Payable VAT: {{ $monthDifference + $previousBalance }}</strong> <br>
                    </div>
                </div>
            </div>
            @php
                // Update previous month's balance
                
                $previousBalance = $monthDifference + $previousBalance;
                
            @endphp
        @endforeach
    </div>
@endsection
