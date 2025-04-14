@extends('layouts.template_default')
@section('title', 'Data UMKM')
@section('umkm', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data UMKM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data UMKM</li>
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
                                    <i class="fa fa-plus"></i> Tambah UMKM
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama UMKM</th>
                                                <th>Jenis Usaha</th>
                                                <th>Alamat UMKM</th>
                                                <th>Kelurahan</th>
                                                <th>Kecamatan</th>
                                                <th>Kabupaten</th>
                                                <th>Provinsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($umkms as $umkm)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $umkm->nama_umkm }}</td>
                                                    <td>{{ $umkm->jenis_usaha }}</td>
                                                    <td>{!! $umkm->alamat_umkm !!}</td>
                                                    <td>{{ $umkm->kelurahan }}</td>
                                                    <td>{{ $umkm->kecamatan }}</td>
                                                    <td>{{ $umkm->kabupaten }}</td>
                                                    <td>{{ $umkm->provinsi }}</td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <a href="#" class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $umkm->id }}">
                                                            <i class="fa fa-pen"></i>
                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                @include('pages.admin.umkm.edit', ['umkm' => $umkm])
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

    @include('pages.admin.umkm.create')
@endsection
