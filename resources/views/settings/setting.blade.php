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

        <div class="m-5">
            <h4 class="mb-4 text-center">Settings</h4>
            <hr>
            <div class="d-flex justify-content-center">
                <h6 class="me-4 mb-5 setting-heading setting-pointer" data-target="account-form">Account</h6>
                <h6 class="mb-5 setting-pointer" data-target="business-info-form">Business Info</h6>
            </div>
            <form id="account-form" method="post" action="{{ route('updatesetting',$user->id) }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Name"
                        value="{{ $user->name }}" name="name">
                    <label for="floatingInput">Name</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" placeholder="Password"
                                value="{{ $user->password }}" name="password">
                            <label for="floatingInput">Password</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Location" value="{{ $user->location }}" name="location">
                            <label for="floatingPassword">Location</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Email Address"
                                value="{{ $user->email }}" name="email">
                            <label for="floatingInput">Email Address</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingPassword" placeholder="Phone Number" value="{{ $user->phone_number }}" name="phone">
                            <label for="floatingPassword">Phone Number</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-start mt-4">

                    <button class="btn btn-primary me-2">Update</button>
                    <button class="btn btn-danger" id="backButton">Cancel</button>
                </div>




            </form>

            <form id="business-info-form" class="hide">
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Company Name">
                            <label for="floatingInput">Company Name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Vat No">
                            <label for="floatingPassword">VAT No</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Address">
                            <label for="floatingInput">Address</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingPassword" placeholder="Phone Number">
                            <label for="floatingPassword">Phone Number</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Logo of company</label>
                    <input class="form-control" type="file" id="formFile" name="logo" accept="image/*">

                </div>


                <div class="d-flex justify-content-start mt-4">

                    <button class="btn btn-primary me-2">Update</button>
                    <button class="btn btn-danger" id="backButton">Cancel</button>
                </div>




            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {


            $("[data-target]").click(function() {

                var targetId = $(this).data("target");

                if (targetId === "account-form") {
                    $("#account-form").show();
                    $("#business-info-form").hide();
                } else if (targetId === "business-info-form") {
                    $("#business-info-form").show();
                    $("#account-form").hide();
                }
                $("[data-target]").removeClass("setting-heading");

                // Add the "setting-heading" class to the clicked heading
                $(this).addClass("setting-heading");
            });
            $('#backButton').click(function() {
                window.history.back();
            });
        });
    </script>
@endpush
