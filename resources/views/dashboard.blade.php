@extends('partials')
@section('content')
    {{-- <a href="/bill">go to bill</a> --}}
    {{-- <div class="services">
        <h3 class="text-center category-number">+</h3>
        <h5 class="text-center category-bottom">Add New Category</h5>
    </div> --}}

    <div class="dash-background">

        <div class="d-flex justify-content-between mt-3">
            <div class="dash-topcard ">

                <h5 class="text-center">Total Receivables</h5>
                <h5 class="text-center">{{ $customers }}</h5>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center">Total Payables</h5>
                <h5 class="text-center">{{ $parties }}</h5>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center">Total Purchase</h5>
                <h5 class="text-center">{{ $purchases }}</h5>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center">Total Sales</h5>
                <h5 class="text-center">{{ $sales }}</h5>
            </div>
        </div>


    </div>
    </div>
@endsection
@push('scripts')
    {{-- <script script script src="{{ asset('js/script.js') }}"></script> --}}
@endpush
