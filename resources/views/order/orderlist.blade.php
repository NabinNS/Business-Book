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

        <div class="d-flex justify-content-start">

            @foreach ($companyNames as $companyname)
                <div class="c-category me-5" data-type="{{ $companyname }}">
                    <h5 class="text-center">{{ $companyname }}</h5>
                </div>
            @endforeach

        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".c-category").click(function() {
                var type = $(this).data("type");
                window.location.href = '/orderdetails/' + type;
            });
        });
    </script>
@endpush
