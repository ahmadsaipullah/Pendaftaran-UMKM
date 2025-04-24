@extends('layouts.template_default')
@section('title', 'Data Dokumen Permohonan')
@section('dokumen', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Dokumen Permohonan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data Dokumen Permohonan</li>
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
                                                <th>Nomor Permohonan</th>
                                                <th>Nama Dokumen</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th>Tanggal Upload</th>
                                                <th>Keterangan</th>
                                                @if($showAksi)
                                                    <th>Aksi</th>
                                                @endif
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
                                                    @if($showAksi)
                                                        <td>
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-{{ $dokumen->id }}">
                                                                <i class="fa fa-pen"></i>
                                                            </button>
                                                            {{-- <form action="{{ route('dokumen-permohonan.destroy', $dokumen->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form> --}}
                                                        </td>
                                                    @endif
                                                </tr>

                                                {{-- Modal Edit --}}
                                                @include('pages.user.dokumen.edit', ['dokumen' => $dokumen])
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
    @include('pages.user.dokumen.create')
@endsection
