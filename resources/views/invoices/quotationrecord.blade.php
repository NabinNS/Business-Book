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
                <h6 class="text-center font">Quotation Records</h6>
            </div>
            <div class="d-flex justify-content-end m-2 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control search" placeholder="Search" />
                </div>
            </div>
            <table class="table table-bordered mt-4" id="listingtable">
                <colgroup>
                    <col style="width: 60%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>
                <thead>
                    <tr class="billhead">
                        <th>Customer Name</th>
                        <th>Bill No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotations as $quotation)
                        <tr>
                            <td><a href="{{ route('quotationrecorddetail', ['billno' => $quotation->bill_no, 'customername' => $quotation->customer_name]) }}"
                                    class="aremainingbalance">{{ $quotation->customer_name }}</a></td>
                            <td>{{ $quotation->bill_no }}</td>
                            <td><a href="{{ route('downloadquotation', ['billno' => $quotation->bill_no, 'customername' => $quotation->customer_name]) }}"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#listingtable tbody tr").filter(function() {
                $(this).toggle($(this).find("td").text().toLowerCase().indexOf(
                    value) > -1)
            });
        });
    </script>
@endpush
