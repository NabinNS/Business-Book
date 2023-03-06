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
        <div class="d-flex justify-content-center">
            <h3 class="c-heading m-3">Confirmation Letters for {{ $name }}</h3>
        </div>
        <div class="d-flex justify-content-end m-2 mb-3">
            <div class="form-group">
                <input type="text" class="form-control search" placeholder="Search" />
            </div>
        </div>
        <table class="table table-striped" id="listingtable">
            <colgroup>
                <col style="width: 5%;">
                <col style="width: 50%;">
                <col style="width: 25%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
            </colgroup>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Vat No</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @if ($name == 'parties')
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('viewpartiesconfirmation',$list->company_name ) }}"
                                class="aremainingbalance"> {{  $list->company_name  }} </a></td>
            
                            <td>{{ $list->address }}</td>
                            <td>{{ $list->vat_number }}</td>
                            <td>{{ $list->phone_number }}</td>
                        </tr>
                    @endforeach
                @elseif ($name == 'customers')
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('viewcustomersconfirmation',$list->customer_name ) }}"
                                class="aremainingbalance"> {{ $list->customer_name  }} </a></td>
                            <td>{{ $list->address }}</td>
                            <td>{{ $list->vat_number }}</td>
                            <td>{{ $list->phone_number }}</td>
                        </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#listingtable tbody tr").filter(function() {
                    $(this).toggle($(this).find("td").text().toLowerCase().indexOf(
                        value) > -1)
                });
            });
        });
    </script>
@endpush
