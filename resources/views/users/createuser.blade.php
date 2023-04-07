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
            <h4 class="mb-2 text-center">Create User</h4>
            <hr>
            <div class="d-flex justify-content-end">

            </div>
            <form id="createuser-form" method="post" action="{{ route('createuser') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="container">
                        <div class="card shadow-lg">
                            <div class="row align-items-center">
                                <div class="col-md-4">

                                    <div class="d-flex justify-content-center align-items-center" style="height: 325px;">
                                        <p class="text-center">No image found</p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Name:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="name">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Password:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="password" name="password">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Address:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="location">
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
                                                <h6 class="fw-bold mb-2">Email:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="email" name="email">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Role:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-select" id="roleselect" name="role">
                                                    <option value="admin">Admin</option>
                                                    <option value="accountant">Accountant</option>
                                                    <option value="Marketing">Marketing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">Gender:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="radio" name="gender" value="male" checked>
                                                <label for="male">Male</label><br>
                                                <input type="radio" name="gender" value="female">
                                                <label for="female">Female</label>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="fw-bold mb-2">DOB:</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="date" name="birthday">
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
                                                <button class="btn btn-primary me-2">Create</button>
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

        </div>

    </div>

@endsection
@push('scripts')
    <script></script>
@endpush
