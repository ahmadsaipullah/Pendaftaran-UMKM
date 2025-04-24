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
                                                @if($showAksi)
                                                <th>Aksi</th>
                                                @endif
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
                                                    @if($showAksi)
                                                  <td>
                                                        <button class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $permohonan->id }}">
                                                            <i class="fa fa-pen"></i>
                                                        </button>
                                                    </td>
                                                    @endif
  {{--
                                                        <form action="{{ route('userpermohonan.destroy', $permohonan->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                 --}}
                                                </tr>

                                                {{-- Modal Edit --}}
                                                @include('pages.user.permohonan.edit', ['permohonan' => $permohonan])
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
    @include('pages.user.permohonan.create')
@endsection
