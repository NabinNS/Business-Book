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


            <form class="m-3" action="{{ route('saveorder',$companyname) }}" method="post">
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
                        <button class="btn btn-danger">Cancel</button>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($orderNames as $orderName)
                    <tr>
                        <td>{{ $orderName->name }}</td>
                        <td>{{ $orderName->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>


@endsection
@push('scripts')
    <script></script>
@endpush
