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

        <div class="m-2">
            <h4 class="mb-2 text-center">Settings</h4>
            <hr>
            <div class="d-flex justify-content-center">
                <h6 class="me-4 mb-5 setting-heading setting-pointer" data-target="account-form">Account</h6>
                <h6 class="mb-5 setting-pointer me-3" data-target="business-info-form">Business Info</h6>
                <h6 class="mb-5 setting-pointer" data-target="password-info-form">Password</h6>
            </div>
            <form id="account-form" method="post" action="{{ route('updatesetting', $user->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="container">
                        <div class="card shadow-lg">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    @if ($user->profile)
                                        <img class="card-img-top m-3" style="height:425px;"
                                            src="{{ asset('images/' . $user->profile) }}">
                                    @else
                                        <div class="d-flex justify-content-center align-items-center"
                                            style="height: 325px;">
                                            <p class="text-center">No image found</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Name:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Address:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="location"
                                                    value="{{ $user->location }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Phone Number:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="number" name="phone"
                                                    value="{{ $user->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Email:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="email" name="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Role:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="role">
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                    <option value="accountant"
                                                        {{ $user->role == 'accountant' ? 'selected' : '' }}>Accountant
                                                    </option>
                                                    <option value="Marketing"
                                                        {{ $user->role == 'Marketing' ? 'selected' : '' }}>Marketing
                                                    </option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Gender:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="radio" name="gender" value="male"
                                                    {{ $user->gender == 'male' ? 'checked' : '' }}>
                                                <label for="male">Male</label><br>
                                                <input type="radio" name="gender" value="female"
                                                    {{ $user->gender == 'female' ? 'checked' : '' }}>
                                                <label for="female">Female</label>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">DOB:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="date" name="birthday"
                                                    value="{{ $user->birthday }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Profile Image:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="file" id="formFile"
                                                    name="profilephoto" accept="image/*">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-9 ms-2">
                                                <button class="btn btn-primary me-2">Update</button>
                                                <button class="btn btn-danger" id="backButton"
                                                    type="button">Cancel</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form method="post" class="hide" action="{{ route('changepassword', $user->id) }}" id="password-form">
                @csrf
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="New Password"
                        name="password1">
                    <label for="floatingInput">New Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="Confirm New Password"
                        name="password2">
                    <label for="floatingInput">Confirm New Password</label>
                </div>
                <div class="d-flex justify-content-start mt-4">

                    <button class="btn btn-primary me-2">Update Password</button>
                    <button class="btn btn-danger" id="backButton" type="button">Cancel</button>
                </div>
            </form>
            @if ($userCompany)
                <form id="business-info-form" class="hide" method="post" enctype="multipart/form-data"
                    action="{{ route('updatecompany') }}">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="container">
                            <div class="card shadow-lg">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        @if ($userCompany->logo_path)
                                            <img class="card-img-top m-3" style="height:225px; width: 290px;"
                                                src="{{ asset('images/' . $userCompany->logo_path) }}">
                                        @else
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height: 225px;">
                                                <p class="text-center">No image found</p>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Company Name:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="name"
                                                        value="{{ $userCompany->company_name }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Vat No:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" name="vatno"
                                                        value="{{ $userCompany->vat_no }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Address:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="address"
                                                        value="{{ $userCompany->address }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Phone Number:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" name="phone"
                                                        value="{{ $userCompany->phone_number }}">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Company Logo:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="logo" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-9 ms-2">
                                                    <button class="btn btn-primary me-2">Update</button>
                                                    <button class="btn btn-danger" id="backButton"
                                                        type="button">Cancel</button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            @if (!$userCompany)
                <form id="business-info-form" class="hide" method="post" enctype="multipart/form-data"
                    action="{{ route('addcompany') }}">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="container">
                            <div class="card shadow-lg">
                                <div class="row align-items-center">
                                    <div class="col-md-4">

                                        <div class="d-flex justify-content-center align-items-center"
                                            style="height: 325px;">
                                            <p class="text-center">No image found</p>
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Company Name:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="name">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Vat No:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" name="vatno">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Address:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="address">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Phone Number:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" name="phone">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    <h6 class="fw-bold mb-2">Company Logo:</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="logo" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-9 ms-2">
                                                    <button class="btn btn-primary me-2">Update</button>
                                                    <button class="btn btn-danger" id="backButton"
                                                        type="button">Cancel</button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <form id="business-info-form" class="hide" method="post" enctype="multipart/form-data"
                    action="{{ route('addcompany') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Company Name"
                                    name="name">
                                <label for="floatingInput">Company Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="Vat No"
                                    name="vatno">
                                <label for="floatingPassword">VAT No</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Address"
                                    name="address">
                                <label for="floatingInput">Address</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingPassword"
                                    placeholder="Phone Number" name="phone">
                                <label for="floatingPassword">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Logo of company</label>
                        <input class="form-control" type="file" id="formFile" name="logo" accept="image/*">

                    </div>


                    <div class="d-flex justify-content-start mt-4">

                        <button class="btn btn-primary me-2" type="submit">Save</button>
                        <button type="button" class="btn btn-danger" id="backButton">Cancel</button>
                    </div>
                </form>
            @endif
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
                    $("#password-form").hide();
                    $("#business-info-form").hide();
                } else if (targetId === "business-info-form") {
                    $("#business-info-form").show();
                    $("#account-form").hide();
                    $("#password-form").hide();
                } else if (targetId === "password-info-form") {
                    $("#business-info-form").hide();
                    $("#account-form").hide();
                    $("#password-form").show();
                }
                $("[data-target]").removeClass("setting-heading");

                $(this).addClass("setting-heading");
            });
            $('#backButton').click(function() {
                window.history.back();
            });
        });
    </script>
@endpush
