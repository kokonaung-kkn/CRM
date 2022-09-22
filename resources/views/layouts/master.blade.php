<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRM</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    @yield('schedule_link')
    <link rel="stylesheet" href="/css/style.css">
    {{-- <link rel="stylesheet" href="/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
</head>

<body>
    <main>
        <div class="nav-side">
            <div class="sidebar">
                <div class="brand-logo">
                    <div class="logo">
                        <img src="/images/logo.png" alt="">
                    </div>
                    <div class="logo-desc">
                        <span>Solar</span><span>CRM</span>
                    </div>
                </div>
                <div class="menu-item">
                    <ul class="main">
                        <li><a href="/" class="{{ Request::segment(1) == '' ? 'active' : '' }}"><i class="uil uil-dashboard"></i><span>Dashboard</span></a></li>
                        <li><a href="{{ route('leads.index') }}" class="{{ Request::segment(1) == 'leads' ? 'active' : '' }}"><i class="uil uil-phone"></i><span>Leads</span></a></li>
                        <li><a href="{{ route('clients.index') }}" class="{{ Request::segment(1) == 'clients' ? 'active' : '' }}"><i class="uil uil-users-alt"></i><span>Clients</span></a></li>
                        <li><a href="#" class="{{ Request::segment(1) == 'products' ? 'active' : '' }}"><i class="uil uil-tag-alt"></i><span>Products</span></a></li>
                        <li><a href="#" class="{{ Request::segment(1) == 'orders' ? 'active' : '' }}"><i class="uil uil-shopping-cart"></i><span>Orders</span></a></li>
                        <li><a href="{{ route('staff.index') }}" class="{{ Request::segment(1) == 'staff' ? 'active' : '' }}"><i class="uil uil-user-check"></i><span>Staff</span></a></li>
                        <li><a href="#" class="{{ Request::segment(1) == 'schedule' ? 'active' : '' }}"><i class="uil uil-calendar-alt"></i><span>Schedule</span></a></li>
                        <li class="sub-menu">
                            <a href="#"><i class="uil uil-folder-open"></i><span>Reports <i class="uil uil-angle-down"></i></span></a>
                            <ul>
                                <li><a href="#"><span>Example 1</span></a></li>
                                <li><a href="#"><span>Example 1</span></a></li>
                                <li><a href="#"><span>Example 1</span></a></li>
                                <li><a href="#"><span>Example 1</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header">
                            <div class="icon-box">
                                <div class="icon">
                                    <div class="nav-icon closed">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="system-access">
                                <div class="notification">
                                    <i class="uil uil-bell"></i>
                                    <div class="notification-box">
                                        <ul>
                                            <li class="success">
                                                <div class="notify-icon">
                                                    <i class="uil uil-check-circle"></i>
                                                </div>
                                                <div class="notify-data">
                                                    <div class="title">
                                                        Lorem ipsum dolor sit.
                                                    </div>
                                                    <div class="subtitle">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </div>
                                                </div>
                                                <div class="notify-status">
                                                    <p>Success</p>
                                                </div>
                                            </li>
                                            <li class="fail">
                                                <div class="notify-icon">
                                                    <i class="uil uil-times-circle"></i>
                                                </div>
                                                <div class="notify-data">
                                                    <div class="title">
                                                        Lorem ipsum dolor sit.
                                                    </div>
                                                    <div class="subtitle">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </div>
                                                </div>
                                                <div class="notify-status">
                                                    <p>Failed</p>
                                                </div>
                                            </li>
                                            <li class="show-all">
                                                <p>Show All Activities</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="user-info">
                                    <div class="dropdown">
                                        <div class="user-img" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                            <img src="/images/unnamed.png" alt="" srcset="">
                                        </div>
                                        <div class="user-detail dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                            Millie Bobby Brown
                                        </div>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#"><i class="uil uil-user-check"></i> Update Profile</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="uil uil-signout"></i> Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/all.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    @yield('schedule_script')
    <script src="/js/main.js"></script>
    @yield('alert')
</body>
</html>