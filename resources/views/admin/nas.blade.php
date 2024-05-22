@extends('admin.layout.admin')

@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Data Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data File</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#uploadModal">Upload
                            File</a>
                    </div>
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
                                            <td>{{ \Carbon\Carbon::createFromTimestamp(\Storage::disk('drive_d')->lastModified($file))->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('download', $file) }}"
                                                    class="btn btn-primary btn-sm">Download</a>
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
                </div>
            </div>
        </div>

        <!-- Modal Upload -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Confirm Delete -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus file ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" id="confirmDelete" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
