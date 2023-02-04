<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Business Book</title>
    <!-- Boxiocns CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/account.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bx-book-add'></i>
            <span class="logo_name">Business Book</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/dashboard">
                    <i class="bx bx-grid-alt"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="">
                        <i class='bx bxs-user-account'></i>
                        <span class="link_name">Accounts</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Accounts</a></li>
                    <li><a href="/parties">Parties</a></li>
                    <li><a href="#">Customers</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-line-chart'></i>
                        <span class="link_name">Stock</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Stock</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bxs-report'></i>
                        <span class="link_name">Reports</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Reports</a></li>
                    <li><a href="#">VAT</a></li>
                    <li><a href="#">Confirmation letters</a></li>
                    <li><a href="#">Comparision</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bxs-coin-stack'></i>
                        <span class="link_name">Vat Bills</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Vat Bills</a></li>
                    <li><a href="#">Purchase</a></li>
                    <li><a href="#">Sales</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-receipt'></i>
                        <span class="link_name">Invoices</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Invoices</a></li>
                    <li><a href="#">Estimate</a></li>
                    <li><a href="#">Quotation</a></li>
                    <li><a href="#">Pricing</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-book-alt'></i>
                    <span class="link_name">DayBook</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">DayBook</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Setting</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="name-job">
                        <div class="profile_name">Accounting Software</div>
                    </div>
                    <i class="bx bx-log-out"></i>
                </div>
            </li>

            </li>
        </ul>
    </div>
    <section class="home-section">

        <div class="home-content">
            <i class="bx bx-menu"></i>
        </div>
        <!-- codes here -->

        <div class="grid-container">
            <div class="grid-item grid-item-1">

                <div class="shadow p-3 mb-4 bg-white bottom-radius border border-2 border-danger">
                    <h6 class="text-center font">Parties list</h6>
                </div>
                <div class="d-flex">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-text hide searchbar btn-custom" id="basic-addon1"><i
                                    class="fas fa-search"></i></span>
                            <input type="search" id="partiessearchbar"
                                class=" hide searchbar form-control shadow-none" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn-custom" id="toogleSearchbar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="container addbutton">
                        <button class="btn-custom btn-size ms-5" type="button" data-bs-toggle="modal"
                            data-bs-target="#AddPartyModal">Add Party</button>
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
                                                <div class="form-floating mb-3">
                                                    <input type="Date" class="form-control" id="floatingInput"
                                                        placeholder="Date" name="date">
                                                    <label for="floatingInput">As of</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Party</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                {{-- table to show summary of accounts --}}
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>$50</td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>$75</td>
                            </tr>
                            <tr>
                                <td>Bob Johnson</td>
                                <td>$100</td>
                            </tr>
                        </tbody>
                    </table>

                </div>


            </div>
            <div class="grid-item grid-item-2">grid2</div>
            <div class="grid-item grid-item-3">

            </div>
        </div>





        <script>
            $(document).ready(function() {
                $("#toogleSearchbar").click(function() {
                    $(".searchbar").removeClass("hide");
                    $("#partiessearchbar").focus();
                    $('#toogleSearchbar').hide();
                    $('.addbutton').hide();
                });

                $("#partiessearchbar").focusout(function() {
                    $(".searchbar").addClass("hide");
                    $('#toogleSearchbar').show();
                    $('.addbutton').show();
                });
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
            });
        </script>
        <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
