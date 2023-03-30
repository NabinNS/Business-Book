@extends('partials')
@section('content')


    <div class="dash-background">

        <div class="d-flex justify-content-between mt-3">
            <div class="dash-topcard ">
                <h5 class="text-center text-success">Rs {{ $customers }}</h5>
                <h6 class="text-center">Total Receivables</h6>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center text-danger">Rs {{ $parties }}</h5>
                <h6 class="text-center">Total Payables</h6>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center text-warning">Rs {{ $purchases }}</h5>
                <h6 class="text-center">Total Purchase</h6>
            </div>
            <div class="dash-topcard ">

                <h5 class="text-center text-info">Rs {{ $sales }}</h5>
                <h6 class="text-center">Total Sales</h6>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <div>
                <h6>chart</h6>
            </div>
            <div>
                
            </div>

        </div>
        


    </div>

@endsection
@push('scripts')
    {{-- <script script script src="{{ asset('js/script.js') }}"></script> --}}
@endpush
