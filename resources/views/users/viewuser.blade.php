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
        
        <div class="d-flex justify-content-center align-items-center h-80">
         
            <div class="container mt-5">
                <h4 class="text-center mb-5 text-success"><u>Detail Information of User</u></h4>
                <div class="card shadow-lg">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($user->profile)
                                <img class="card-img-top m-3" style="height:325px;"
                                    src="{{ asset('images/' . $user->profile) }}">
                            @else
                                <p class="text-center">No image found</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">{{ $user->name }}</h4>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="fw-bold mb-2">Address:</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="card-text">{{ $user->location }}</p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="fw-bold mb-2">Phone Number:</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="card-text">{{ $user->phone_number }}</p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="fw-bold mb-2">Email:</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="card-text">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="fw-bold mb-2">Gender:</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="card-text">{{ $user->gender }}</p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="fw-bold mb-2">Date of birth:</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="card-text">{{ $user->birthday }}</p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="fw-bold mb-2">Role:</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="card-text">{{ $user->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
