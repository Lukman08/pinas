@extends('admin.layout.admin')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid pb-0">
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="page-head-box">
                    <h1>Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            {{-- <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Job Dashboard</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <h3>Selamat Datang Lukman Hakim!</h3>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card flex-fill tickets-card">
                    <div class="card-header">
                        <div class="text-center w-100 p-3">
                            <h3 class="bl-text mb-1">{{ $fileCount }}</h3>
                            <h2>Total Files</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card flex-fill tickets-card">
                    <div class="card-header">
                        <div class="text-center w-100 p-3">
                            <h3 class="bl-text mb-1">{{ $totalSize }}</h3>
                            <h2>Total file size</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card flex-fill tickets-card">
                    <div class="card-header">
                        <div class="text-center w-100 p-3">
                            <h3 class="bl-text mb-1">{{ $mostCommonExtension }}</h3>
                            <h2>Format Terbanyak</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card flex-fill tickets-card">
                    <div class="card-header">
                        <div class="text-center w-100 p-3">
                            <h3 class="bl-text mb-1">{{ $largestExtension }}</h3>
                            <h2>Format Terbesar</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
