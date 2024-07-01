<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nas - Admin</title>
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
                <form id="logoutForm" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
                <a id="logoutBtn" class="btn btn-success" href="#" style="background-color: #83B4FF;">
                    <img src="{{ asset('img/usr.png') }}" alt="Icon"
                        style="width: 16px; height: 16px; margin-right: 5px;">
                    Lukman Hakim
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>File List</h2>
        <div class="card-header">
            <a href="#" class="btn btn-primary mr-2 mt-4" data-toggle="modal" data-target="#uploadModal">Upload
                File</a>
        </div>
        <div class="card-body">
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

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel1">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus file ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" id="confirmDelete" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="uploadForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih file:</label>
                            <input type="file" class="form-control-file" id="file" name="file" required>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" id="progressBar">0%
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="uploadFile()">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function uploadFile() {
            const form = document.getElementById('uploadForm');
            const formData = new FormData(form);
            const progressBar = document.getElementById('progressBar');

            axios.post('{{ route('upload') }}', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function(progressEvent) {
                        let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        progressBar.style.width = percentCompleted + '%';
                        progressBar.innerHTML = percentCompleted + '%';
                    }
                })
                .then(function(response) {
                    alert(response.data.success);
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '0%';
                    location.reload(); // Refresh halaman
                })
                .catch(function(error) {
                    alert('Gagal upload file');
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '0%';
                });
        }

        $(document).ready(function() {
            $('#logoutBtn').click(function(e) {
                e.preventDefault();
                $('#logoutForm').submit();
            });

            $('#fileTable').DataTable();

            $('#confirmDelete').click(function() {
                $('#confirmModal').modal('hide');
                $('#confirmModal').closest('form').submit();
            });
        });

        function openConfirmModal(button) {
            $('#confirmModal').modal('show');
            $('#confirmDelete').click(function() {
                $('#confirmModal').modal('hide');
                button.form.submit();
            });
        }
    </script>

</body>

</html>
