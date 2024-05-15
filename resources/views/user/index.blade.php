<!DOCTYPE html>
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

</html>
