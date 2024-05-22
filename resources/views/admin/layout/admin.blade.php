<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard - Guru</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/admin/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/css/bootstrap.min.css') }}">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/css/dataTables.bootstrap4.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/css/material.css') }}">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/css/line-awesome.min.css') }}">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/morris/morris.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/css/style.css') }}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('template/admin/img/logo.png') }}" width="40" height="40" alt="">
                </a>
            </div>
            <!-- /Logo -->

            <div class="header-center">
                <h1>Smarthr</h1>
            </div>

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="header-new-menu">
                {{-- <li>
                    <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Clients</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="clients.html">Clients</a>
                    </div>
                </li>
                <li>
                    <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Projects</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="projects.html">Projects</a>
                        <a class="dropdown-item" href="tasks.html">Tasks</a>
                        <a class="dropdown-item" href="task-board.html">Task Board</a>
                    </div>
                </li>
                <li>
                    <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Leads</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="leads.html">Leads</a>
                    </div>
                </li>
                <li>
                    <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Tickets</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="tickets.html">Tickets</a>
                    </div>
                </li> --}}
            </ul>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                {{-- <li>
                    <a href="#" class="report-btn">
                        <span class="material-icons-outlined">
                            text_snippet
                        </span>
                    </a>
                </li> --}}

                {{-- <li>
                    <!-- Header Search -->
                    <div class="page-title-box">
                        <div class="top-nav-search">
                            <a href="javascript:void(0);" class="responsive-search">
                                <i class="fa fa-search"></i>
                            </a>
                            <form action="search.html">
                                <!-- <input class="form-control" type="text" placeholder="Search"> -->

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <span class="material-icons-outlined">
                                            search
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Header Search -->
                </li> --}}

                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        {{-- <i class="far fa-bell"></i> <span class="badge rounded-pill">3</span> --}}
                    </a>
                    {{-- <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('template/admin/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment
                                                        booking</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('template/admin/img/profiles/avatar-03.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Tarah
                                                        Shropshire</span> changed the task name <span
                                                        class="noti-title">Appointment booking with payment
                                                        gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('template/admin/img/profiles/avatar-06.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('template/admin/img/profiles/avatar-17.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins
                                                        ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt=""
                                                    src="{{ asset('template/admin/img/profiles/avatar-13.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Bernardo
                                                        Galaviz</span> added new task <span class="noti-title">Private
                                                        chat module</span></p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div> --}}
                </li>
                <!-- /Notifications -->

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="{{ asset('template/admin/img/user.jpg') }}"
                                alt=""></span>
                        <span>Lukman Hakim</span>
                    </a>
                    <div class="dropdown-menu">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="index.html">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->

        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        @extends('admin.layout.sidebar')
        <!-- Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('template/admin/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap Bundle JS (Includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable JS -->
    <script src="{{ asset('template/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('template/admin/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });

        function openConfirmModal(button) {
            $('#confirmModal').modal('show');
            $('#confirmDelete').off('click').on('click', function() {
                $('#confirmModal').modal('hide');
                button.form.submit();
            });
        }
    </script>

    <!-- Theme Settings JS -->
    <script src="{{ asset('template/admin/js/layout.js') }}"></script>
    <script src="{{ asset('template/admin/js/theme-settings.js') }}"></script>
    <script src="{{ asset('template/admin/js/greedynav.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('template/admin/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('template/admin/js/chart.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('template/admin/plugins/apexcharts/apexcharts.min.js') }}"></script>


</body>

</html>
