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
                            <td><i class="fa fa-download" aria-hidden="true"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection
@push('scripts')
    <script>

    </script>
@endpush
