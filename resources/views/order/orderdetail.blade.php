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


            <form class="m-3" action="{{ route('saveorder', $companyname) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Product Name" name="productname">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="Quantity" name="quantity">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">Save</button>
                        <button class="btn btn-danger" id="backButton" type="button">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
        <h6 class="text-center">Order list for {{ $companyname }}</h6>
        <table class="table table-bordered mx-auto mt-4" style="width: 40%;">
            <thead>
                <tr>
                    <th>Name of product</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderNames as $orderName)
                    <tr>
                        <td>{{ $orderName->name }}</td>
                        <td>{{ $orderName->quantity }}</td>
                        <td><i class="fa fa-edit"></i><i class="fa fa-trash"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">

            <a href="{{ route('sendorder', $companyname) }}"><button class="btn btn-secondary">Send Order</button></a>
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
