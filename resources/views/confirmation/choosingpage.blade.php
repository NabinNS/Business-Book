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

            <h3 class="confirmation-heading ">Confirmation Letters</h3>
        </div>

    <div class="d-flex justify-content-center">

        <div class="c-category me-5" data-type="parties">
            <h3 class="text-center">Parties</h3>
        </div>
        <div class="c-category ms-5" data-type="customers">
            <h3 class="text-center">Customers</h3>
        </div>
    </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".c-category").click(function() {
                var type = $(this).data("type");
                    window.location.href = '/confirmationletters/' + type;
            });
        });
    </script>
@endpush
