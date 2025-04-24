@extends('layouts.template_default')
@section('title', 'Data Permohonan')
@section('permohonan', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Permohonan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data Permohonan</li>
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
                                    <i class="fa fa-plus"></i> Tambah Permohonan
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Permohonan</th>
                                                <th>Nik</th>
                                                <th>Nama Permohonan</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Nama UMKM</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Approval</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permohonans as $permohonan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $permohonan->nomor_permohonan }}</td>
                                                    <td>{{ $permohonan->user->nik }}</td>
                                                    <td>{{ $permohonan->user->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y') }}</td>
                                                    <td>{{ $permohonan->umkm->nama_umkm ?? '-' }}</td>
                                                    <td>
                                                        <span class="badge
                                                            @if($permohonan->status == 'Pending') badge-warning
                                                            @elseif($permohonan->status == 'Disetujui') badge-success
                                                            @elseif($permohonan->status == 'Ditolak') badge-danger
                                                            @else badge-secondary
                                                            @endif">
                                                            {{ $permohonan->status }}
                                                        </span>
                                                    </td>
                                                    <td>{!! $permohonan->keterangan ?? '-' !!}</td>
                                                    <td>
                                                        @if ($permohonan->status == 'Pending')
        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#approveModal{{ $permohonan->id }}">
            Setujui
        </button>
        <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#rejectModal{{ $permohonan->id }}">
            Tolak
        </button>
    @endif

    <!-- Modal Setujui -->
    <div class="modal fade" id="approveModal{{ $permohonan->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('permohonan.approve', $permohonan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="Disetujui">
                <div class="modal-content">
                    <input type="hidden" name="action" value="Disetujui">
                    <div class="modal-body">
                        <label>Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Permohonan disetujui karena memenuhi syarat."></textarea>
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
    <div class="modal fade" id="rejectModal{{ $permohonan->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('permohonan.approve', $permohonan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="Ditolak">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak Permohonan</h5>
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
                                                        <button class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $permohonan->id }}">
                                                            <i class="fa fa-pen"></i>
                                                        </button>

                                                        <form action="{{ route('permohonan.destroy', $permohonan->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Modal Edit --}}
                                                @include('pages.admin.permohonan.edit', ['permohonan' => $permohonan])
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
    @include('pages.admin.permohonan.create')
@endsection
