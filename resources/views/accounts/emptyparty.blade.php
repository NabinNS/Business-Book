@extends('partials')
@section('content')
    <!-- codes here -->

    <div class=" d-flex align-items-center justify-content-center emptyparty grid-item mx-auto">
        <div>
          <h5>No party record found.</h5>
          <div class="container addbutton">
              <button class="btn-custom btn-size ms-5 mt-3" type="button" data-bs-toggle="modal"
                  data-bs-target="#AddPartyModal">Add Party</button>
          </div>
        </div>
      </div>


            

            <!-- Modal -->
            <div class="modal fade" id="AddPartyModal" tabindex="-1" aria-labelledby="AddPartyModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center font" id="exampleModalLabel">Add Party</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <form method="get" action="{{ route('addnewparty') }}">
                            <div class="modal-body">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" name="companyname">
                                    <label for="floatingInput">Company Name</label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Vat Number" name="vatnumber">
                                            <label for="floatingInput">Vat Number</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Phone Number" name="phonenumber">
                                            <label for="floatingInput">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around m-3">
                                    <h6 id="additionalinfo" class="under-border">Additional Information</h6>
                                    <h6 id="otherinfo">Other Information</h6>
                                </div>
                                <div class="additionalinfo">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="Address" name="address">
                                                <label for="floatingInput">Address</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="Email" name="emailaddress">
                                                <label for="floatingInput">Email Address</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="otherinfo hide">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput"
                                                    placeholder="Opening Balance" name="openingbalance">
                                                <label for="floatingInput">Opening Balance</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            {{-- <div class="form-floating mb-3"> --}}
                                            <input type="date" class="form-control" id="dateField" name="date">


                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Party</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
          
            $('#AddPartyModal').modal({
                backdrop: 'static',
            });
            $('#otherinfo').click(function() {
                $(".otherinfo").removeClass("hide");
                $(".additionalinfo").addClass("hide");
                $("#otherinfo").addClass("under-border");
                $("#additionalinfo").removeClass("under-border");
            });
            $('#additionalinfo').click(function() {
                $(".otherinfo").addClass("hide");
                $("#additionalinfo").addClass("under-border");
                $("#otherinfo").removeClass("under-border");
                $(".additionalinfo").removeClass("hide");
            });
            $('#AddPartyModal').on('hidden.bs.modal', function(e) {
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end()
            });
         

        });
    </script>
@endpush
