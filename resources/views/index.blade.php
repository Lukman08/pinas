<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nas - Siswa</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatable/datatables.min.css') }}" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #5A72A0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/icon.png') }}" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">Network Attached Storage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Uncomment these lines if needed
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                    -->
                </ul>
                <a class="btn btn-success" href="/login" style="background-color: #83B4FF;">Login</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>File List</h2>
        <div class="table-responsive">
        </div>
        <table id="fileTable" class="table table-striped">
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
                            <a href="{{ route('download', $file) }}" class="btn btn-sm"
                                style="background-color: #6295A2;">Download</a>
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

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#fileTable').DataTable();
        });
    </script>
</body>

</html>
