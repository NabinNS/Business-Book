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
                        <td>
                            {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#EditOrderModal"><i
                                    class="fa fa-edit"></i></button> --}}
                            <a href="/deleteorder/{{ $orderName->id }}" class="text-danger ms-4"><i
                                    class="fa fa-trash cursor-pointer"></i></a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">

            <a href="{{ route('sendorder', $companyname) }}"><button class="btn btn-secondary">Send Order</button></a>
        </div>

        {{-- editing modal --}}

        <div>
            <div class="modal fade" id="EditOrderModal" tabindex="-1" aria-labelledby="AddPartyModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center font" id="exampleModalLabel">Edit Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <form action="">
                            <div class="form-floating mb-3 mx-3 mt-3">
                                <input type="text" class="form-control" placeholder="Product name" name="productname">
                                <label for="floatingInput">Product Name</label>
                            </div>
                            <div class="form-floating mb-3 mx-3">
                                <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                                <label for="floatingInput">Quantity</label>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Party </button>
                        </div>
                        </form>
                    </div>
                </div>
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
