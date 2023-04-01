<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <style>
        .align-label {
            text-align: right;
        }

        .confirmationtable td,
        .confirmationtable th {
            border: 1px solid;
        }

        .confirmationtable {
            margin: auto;
            width: 50%;
            border-collapse: collapse;
        }

        .ms-4 {
            margin-left: 1.5rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }
    </style>





    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>



    <div class="c-grid-item">
        <div class="mx-5 mt-5">

            <div style="display: flex; justify-content: space-between;">
                <div>
                    @if (!empty($companyName->logo_path))
                        <img style="width:60px; height:50px; line-height: 0.2;"
                            src="{{ asset('images/' . $companyName->logo_path) }}">
                    @endif
                </div>
                <div style="text-align: center; line-height: 1;">
                    <h5 style="line-height: 0.2;">{{ $companyName->company_name ?? '' }}</h5>
                    <h6 style="line-height: 0.2;">{{ $companyName->address ?? '' }}</h6>
                    <h6 style="line-height: 0.2;">{{ $companyName->vat_no ?? '' }}</h6>
                </div>
                <div>
                </div>
            </div>





            <div class="d-flex justify-content-end m-2">
                <p class="align-label me-3">Date: {{ date('Y/m/d') }}</p>

            </div>

            <p>To,</p>
            <p>To the Account Department</p>
            <p>{{ $customerDetail->customer_name }}</p>
            <p>PAN/VATNO:-{{ $customerDetail->vat_number }}</p>
            <p class="ms-4">Subject: Confirmation of Account Closing Detail for Fiscal Year {{ $fiscalYear }}</p>
            <p>Dear Sir,</p>
            <p class="ms-4">In connection with captioned matter, we would like to inform you that as per as our
                account
                record
                the credit balance and sales values for the year as follows. We would very much appreciate your
                cooperation
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
                <div class="mt-5 left">
                    <p>Authorized Signatory</p>
                    <p>{{ $companyName->company_name ?? '' }}</p>
                </div>
                <div class="mt-5 right">
                    <p>Authorized Signatory</p>
                    <p>{{ $customerDetail->customer_name }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
