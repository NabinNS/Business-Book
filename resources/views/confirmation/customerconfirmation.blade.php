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

    <div class="c-grid-item">
        <div class="mx-5 mt-5">

            <div class="d-flex justify-content-end m-2">
                <p class="align-label me-3">Date:</p>
                <p> {{ date('Y/m/d') }}</p>
            </div>

            <p>To,</p>
            <p>To the Account Department</p>
            <p>{{ $customerDetail->customer_name }}</p>
            <p>PAN/VATNO:-{{ $customerDetail->vat_number }}</p>
            <p class="ms-4">Subject: Confirmation of Account Closing Detail for Fiscal Year {{ $fiscalYear }}</p>
            <p>Dear Sir,</p>
            <p class="ms-4">In connection with captioned matter, we would like to inform you that as per as our account
                record
                the credit balance and sales values for the year as follows. We would very much appreciate your cooperation
                in confirming the following information. Our records indicate the following:</p>

            <table class="confirmationtable">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Taxable AMT</th>
                        <td>RS {{ number_format($totalAmtWithVat / 1.13, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total AMT without Tax</th>
                        <td>RS {{ number_format($totalAmtWithVat / 1.13, 2) }}</td>
                    </tr>
                    <tr>
                        <th>VAT</th>
                        <td>RS {{ number_format(($totalAmtWithVat / 1.13) * 0.13, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total AMT with Tax</th>
                        <td>RS {{ number_format($totalAmtWithVat, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Closing Balance </th>
                        <td>RS {{ $remainingBalance }}</td>
                    </tr>
                </tbody>
            </table>
            <p class="mt-5">Kindly requested you to send one of this letters dully signed and stamped within 7 days
                otherwise we shall
                remain this balance as your acceptance.</p>
            <p>Thanking you</p>
            <p>Yours Faithfully,</p>
            <div class="d-flex justify-content-between">
                <div class="mt-5">
                    <p>Authorized Signatory</p>
                    <p>company name</p>
                </div>
                <div class="mt-5">
                    <p>Authorized Signatory</p>
                    <p>{{ $customerDetail->customer_name }}</p>
                </div>
            </div>
        </div>


        <div class="c-below">
            <div class="d-flex justify-content-end">
                <button class="btn btn-info mt-2 me-4">Print</button>
                <button class="btn btn-danger mt-2 me-2" id="backButton">Back</button>
            </div>
        </div>


    </div>




@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#backButton').click(function() {
                window.history.back();
            });
        });
    </script>
@endpush
