@extends('layouts.template_default')
@section('title', 'Data Dokumen dokumen')
@section('dokumen', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Dokumen dokumen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data Dokumen dokumen</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-plus"></i> Tambah Dokumen
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor dokumen</th>
                                                <th>Nama Dokumen</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th>Tanggal Upload</th>
                                                <th>Keterangan</th>
                                                <th>Approval</th>
                                                <th>Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dokumen_permohonans as $dokumen)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dokumen->permohonan->nomor_permohonan ?? '-' }}</td>
                                                    <td>{{ $dokumen->nama_dokumen }}</td>
                                                    <td>
                                                        @if($dokumen->file_path) {{-- Pastikan ini nama kolom yang benar di tabel --}}
                                                            <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                                                                <i class="fa fa-download"></i> Lihat
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </td>
<td> <span class="badge
    @if($dokumen->status == 'Pending') badge-warning
    @elseif($dokumen->status == 'Disetujui') badge-success
    @elseif($dokumen->status == 'Ditolak') badge-danger
    @else badge-secondary
    @endif">
    {{ $dokumen->status }}
</span></td>
                                                    <td>{{ \Carbon\Carbon::parse($dokumen->created_at)->format('d M Y') }}</td>
                                                    <td>{!! $dokumen->keterangan !!}</td>
                                                    <td>
                                                        @if ($dokumen->status == 'Pending')
        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#approveModal{{ $dokumen->id }}">
            Setujui
        </button>
        <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#rejectModal{{ $dokumen->id }}">
            Tolak
        </button>
    @endif

    <!-- Modal Setujui -->
    <div class="modal fade" id="approveModal{{ $dokumen->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('dokumen.approve', $dokumen->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="Disetujui">
                <div class="modal-content">
                    <input type="hidden" name="action" value="Disetujui">
                    <div class="modal-body">
                        <label>Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: dokumen disetujui karena memenuhi syarat."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Konfirmasi Setujui</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div class="modal fade" id="rejectModal{{ $dokumen->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('dokumen.approve', $dokumen->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="Ditolak">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <label>Alasan Penolakan</label>
                        <textarea name="keterangan" class="form-control" rows="3" required placeholder="Contoh: Profile Akun tidak lengkap."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Konfirmasi Tolak</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
                                                    </td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-{{ $dokumen->id }}">
                                                                <i class="fa fa-pen"></i>
                                                            </button>
                                                            <form action="{{ route('dokumen.destroy', $dokumen->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>

                                                </tr>

                                                {{-- Modal Edit --}}
                                                @include('pages.admin.dokumen.edit', ['dokumen' => $dokumen])
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Create --}}
    @include('pages.admin.dokumen.create')
@endsection
