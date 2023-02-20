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
    <div class="stockcategory grid-item mx-auto">
        <div>

            <h4 class="stock-heading">Stock Category List</h4>
            <div class="d-flex flex-wrap justify-content-start mt-4">

                <div class="services" data-stock-category="AllProduct">
                    <h3 class="text-center category-number">1</h3>
                    <h5 class="text-center category-bottom">All Product</h5>
                </div>
                @foreach ($stockCategories as $stockCategory)
                    <div class="services" data-stock-category="{{ $stockCategory->stock_category }}">
                        <h3 class="text-center category-number">{{ $loop->iteration + 1 }}</h3>
                        <h5 class="text-center category-bottom">{{ $stockCategory->stock_category }}</h5>
                    </div>
                @endforeach
                <div class="services">
                    <h3 class="text-center category-number">+</h3>
                    <h5 class="text-center category-bottom">Add New Category</h5>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal to add new category --}}
    <div>
        <div class="modal fade" id="AddStockCategory" tabindex="-1" aria-labelledby="AddStockCategoryLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center font" id="exampleModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{ route('addcategory') }}" id="categoryrecordform">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                                    name="categoryname">
                                <label for="floatingInput">Stock Category Name</label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Category </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".services").click(function() {
                var productCategory = $(this).data("stock-category");
                if (productCategory) {
                    window.location.href = '/stocks-list/' + productCategory;
                } else {
                    $('#AddStockCategory').modal('show');
                }
            });
            $('#AddStockCategory').modal({
                backdrop: 'static',
            });
            $('#AddStockCategory').on('hidden.bs.modal', function(e) {
                $("#categoryrecordform")[0].reset();
            });
        });
    </script>
@endpush
