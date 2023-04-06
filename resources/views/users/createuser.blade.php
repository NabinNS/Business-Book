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
            <form id="createuser-form" method="post" action="{{ route('createuser') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name">
                    <label for="floatingInput">Name</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput" placeholder="Password"
                                name="password">
                            <label for="floatingInput">Password</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Location"
                                name="location">
                            <label for="floatingPassword">Location</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Email Address"
                                name="email">
                            <label for="floatingInput">Email Address</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingPassword" placeholder="Phone Number"
                                name="phone">
                            <label for="floatingPassword">Phone Number</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <select class="form-select" id="roleselect" name="role">
                            <option value="admin">Admin</option>
                            <option value="accountant">Accountant</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                           
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-start mt-4">

                    <button class="btn btn-primary me-2">Create</button>
                    <button class="btn btn-danger" id="backButton">Cancel</button>
                </div>
            </form>

        </div>

    </div>

@endsection
@push('scripts')
    <script></script>
@endpush
