<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h1>Data File</h1>
        <!-- Button trigger modal -->
        <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#uploadModal">Upload File</a>
        <div class="mt-4">
            <table id="fileTable" class="table">
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
                                <form action="{{ route('delete', $file) }}" method="post"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="openConfirmModal(this)">Hapus</button>
                                </form>
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

    <!-- Modal Upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="file" id="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="confirmModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus file ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/jquery-3.7.1.min.js') }}"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>

    <script>
        function openConfirmModal(button) {
            $('#confirmModal').modal('show');
            $('#confirmDelete').click(function() {
                $('#confirmModal').modal('hide');
                button.form.submit();
            });
        }
    </script>

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
