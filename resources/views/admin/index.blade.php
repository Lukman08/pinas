<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .download-link {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4caf50;
            color: white;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <h1>Data File</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Upload File</button>
    <table class="table">
        <thead>
            <tr>
                <th>Nama File</th>
                <th>Tipe File</th>
                <th>Ukuran File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($files) > 0)
                @foreach ($files as $file)
                    <tr>
                        <td>{{ $file }}</td>
                        <td>{{ \File::extension($file) }}</td>
                        <td>
                            {{ round(\Storage::disk('drive_d')->size($file) / 1048576, 2) }} MB
                        </td>
                        <td>
                            <a href="{{ route('download', $file) }}" class="btn btn-primary btn-sm">Download</a>
                            <form action="{{ route('delete', $file) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="openConfirmModal(this)">Hapus</button>
                            </form>                            
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">File tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Modal -->
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


    <script>
        function openConfirmModal(button) {
            $('#confirmModal').modal('show');
            $('#confirmDelete').click(function () {
                $('#confirmModal').modal('hide');
                button.form.submit();
            });
        }
    </script>    

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>

</html>
