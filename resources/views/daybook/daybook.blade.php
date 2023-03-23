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

        <div>
            <div class="p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
                <h6 class="text-center font">Day Book</h6>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <div class="input-group">
                        <select class="custom-select select-sizing">
                            <option value="All">All Transaction</option>
                            <option value="Purchase">Purchase</option>
                            <option value="Sales">Sales</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="input-group">
                        <div class="input-group-append">
                            <button class="btn-custom bg-secondary" id="toogleSearchbar">
                                From
                            </button>
                        </div>
                        <input type="date" name="from"/>
                        <div class="input-group-append">
                            <button class="btn-custom bg-secondary" id="toogleSearchbar">
                                To
                            </button>
                        </div>
                        <input type="date" name="to"/>
                        <div class="input-group-append">
                            <button class="btn-custom ms-1" id="toogleSearchbar">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table mt-3 table-bordered">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Voucher No</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
        </div>



    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
