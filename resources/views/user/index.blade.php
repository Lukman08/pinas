<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Smart HR</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/user/img/favicon.png') }}" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('template/user/css/aos.css') }}" />

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/css/dataTables.bootstrap4.min.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('template/user/css/owl.carousel.min.css') }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/user/css/bootstrap.min.css') }}" />

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('template/user/plugins/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/user/plugins/fontawesome/css/all.min.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('template/user/css/style.css') }}" />

</head>

<body class="second-landing-page">

    <!-- Header -->
    <header id="header" class="site-header home-header home-header-while header-land">
        <div class="container">
            <div class="row">
                <div class="main-menu-wrapper">
                    {{-- <div class="menu-header">
                        <a href="index.html" class="menu-logo">
                            <img src="{{ asset('template/user/img/logo.png') }}" class="img-fluid" alt="Logo" />
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div> --}}
                    {{-- <ul class="main-nav bg-trans">
                        <li>
                            <a href="#features">Features</a>
                        </li>
                        <li>
                            <a href="#pricing">Pricing</a>
                        </li>
                        <li>
                            <a href="#reviews">Reviews</a>
                        </li>
                        <li>
                            <a href="#blog">Blog</a>
                        </li>
                        <li>
                            <a href="#contact">Contact us</a>
                        </li>
                    </ul> --}}
                    {{-- <div class="try-free link mobile-head-menu">
                        <a class="btn btn-primary response-head-menu"
                            href="https://themeforest.net/item/smarthr-bootstrap-admin-panel-template/21153150"
                            target="_blank" role="button">Try It Free</a>
                    </div> --}}
                </div>
                <div class="main-menu-head d-flex justify-content-between">
                    <div class="res-center col-lg-3 col-sm-12 col-12">
                        <div class="site">
                            <a id="mobile_btn" href="javascript:void(0);">
                                <span class="bar-icon-second">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                            <div class="site-brand">
                                <a href="/" class="site-branding-logo"><img
                                        src="{{ asset('template/user/img/logo.png') }}" alt="logo"
                                        class="img-fluid" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="menu-list">
                        <div class="right-header d-flex justify-content-center">
                            <nav class="land-menu">
                                <ul>
                                    {{-- <li><a href="#features" class="scrollTo">Features</a></li>
                                    <li><a href="#pricing" class="scrollTo">Pricing</a></li>
                                    <li><a href="#reviews" class="scrollTo">Reviews</a></li>
                                    <li><a href="#blog" class="scrollTo">Blog</a></li>
                                    <li><a href="#contact" class="scrollTo">Contact us</a></li> --}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="home-buy-button">
                        <div class="buy-btns">
                            <a href="/login" class="btn btn-buy">Login </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- / Header -->

    <!-- Features section list -->
    <div class="main-banner-section" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-0">
                        {{-- <div class="card-header">
                            <a href="#" class="btn btn-primary mr-2" data-toggle="modal"
                                data-target="#uploadModal">Upload
                                File</a>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-striped mb-0">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama File</th>
                                        <th>Tipe File</th>
                                        <th>Ukuran File</th>
                                        <th>Tanggal Modifikasi</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($files as $index => $file)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $file }}</td>
                                                <td>{{ \File::extension($file) }}</td>
                                                @php
                                                    $size = \Storage::disk('drive_d')->size($file);
                                                    $sizeInKb = $size / 1024;
                                                    $sizeInMb = $size / 1048576;
                                                    $sizeInGb = $size / 1073741824;
                                                @endphp
                                                <td>
                                                    @if ($sizeInGb >= 1)
                                                        {{ round($sizeInGb, 2) }} GB
                                                    @elseif ($sizeInMb >= 1)
                                                        {{ round($sizeInMb, 2) }} MB
                                                    @else
                                                        {{ round($sizeInKb, 2) }} KB
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::createFromTimestamp(\Storage::disk('drive_d')->lastModified($file))->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('userdownload', $file) }}"
                                                        class="btn btn-primary btn-sm">Download</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">File tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Features Section List-->

    <!-- Footer-->
    <footer class="footer-second">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="copy-rights-second">
                        <p>Copyrights © 2022. All Rights Reserved By Smart HR</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="company-logo-second">
                        <p>a product of <img src="{{ asset('template/user/img/company-logo-2.png') }}"
                                alt="Company-logo" /></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer-->

    <!-- jQuery -->
    <script src="{{ asset('template/user/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('template/user/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Bootstrap Bundle JS (Includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable JS -->
    <script src="{{ asset('template/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

    <!-- Wow JS -->
    <script src="{{ asset('template/user/js/aos.js') }}"></script>

    <!-- Owl JS -->
    <script src="{{ asset('template/user/js/owl.carousel.min.js') }}"></script>

    <!-- Smooth Scroll JS -->
    <script src="{{ asset('template/user/js/smooth-scroll.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('template/user/js/script.js') }}"></script>
</body>

</html>


{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h1>Data File</h1>
        <div class="mt-4 table-responsive">
            <table id="fileTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Tipe File</th>
                        <th>Ukuran File</th>
                        <th>Tanggal Modifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $index => $file)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $file }}</td>
                            <td>{{ \File::extension($file) }}</td>
                            <td>{{ round(\Storage::disk('drive_d')->size($file) / 1048576, 2) }} MB</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp(\Storage::disk('drive_d')->lastModified($file))->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                <a href="{{ route('download', $file) }}" class="btn btn-primary btn-sm">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">File tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="{{ asset('bootstrap/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            @if (count($files) > 0)
                $('#fileTable').DataTable({
                    "columnDefs": [{
                        "orderable": false,
                        "targets": 5
                    }]
                });
            @endif
        });
    </script>
</body>

</html> --}}
