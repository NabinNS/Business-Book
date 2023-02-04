<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Business Book</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
    <!-- Boxiocns CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
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
                <a href="#">
                    <i class="bx bx-grid-alt"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bxs-user-account'></i>
                        <span class="link_name">Accounts</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Accounts</a></li>
                    <li><a href="/parties">Parties</a></li>
                    <li><a href="#">Vendors</a></li>
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
        <div class="d-flex justify-content-between">
            <div class="home-content">
                <i class="bx bx-menu"></i>
            </div>
            <div>
                <p>Date and Time</p>
            </div>
            <div>
                <p>Username</p>
            </div>
        </div>

        <!-- codes here -->





    </section>

    <script script src = "{{ asset('js/script.js') }}" >
    </script>
</body>

</html>
