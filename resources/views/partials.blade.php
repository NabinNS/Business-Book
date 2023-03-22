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
    <link rel="stylesheet" href="{{ asset('css/stock.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirmation.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vat.css') }}" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    {{-- select2 cdn for selecting and searching in the textfield --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
   
      


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    
    <div class="sidebar">
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
                    <a href="/parties">
                        <i class='bx bxs-user-account'></i>
                        <span class="link_name ">Accounts</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="/parties">Accounts</a></li>
                    <li><a href="/parties">Parties</a></li>
                    <li><a href="/customers">Customers</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="/stocks/categories">
                        <i class='bx bx-line-chart'></i>
                        <span class="link_name">Stock</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="/stocks/categories">Stock</a></li>
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
                    <li><a href="/vat">VAT</a></li>
                    <li><a href="/confirmationletters">Confirmation letters</a></li>
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
                    <li><a href="/purchasebillmonths">Purchase</a></li>
                    <li><a href="/salesbillmonths">Sales</a></li>
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
                    <li><a href="/quotation">Quotation</a></li>
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
       

        <nav class="bg-white grid-item pb-2 mb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="home-content">
                    <i class="bx bx-menu"></i>
                </div>
                <strong>
                    <div id="clock" onload="currentTime()"></div>
                </strong>
                <div>
                    <h6>Welcome, {{ Auth::user()->name }}</h6>
                </div>
            </div>
        </nav>

        <!-- codes here -->
        @yield('content')



        <script></script>
    </section>
    <script script script src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript">
        setTimeout(function() {
            $('.alert').fadeOut(1000, function() {
                $(this).alert('close');
            });

        }, 4000);
    </script>

    @stack('scripts')


</body>

</html>
