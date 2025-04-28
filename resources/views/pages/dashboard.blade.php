@extends('layouts.template_default')

@section('title', 'Sepatan UMKM')
@section('dashboard', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang,
                        <span class="btn btn-xs btn-success font-italic">{{ auth()->user()->name }}</span>
                        di Sepatan UMKM
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (auth()->user()->level_id == 1)
            <div class="row">
                <!-- User Registrations -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $user }}</h3>
                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Kategori UMKM -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $umkm }}</h3>
                            <p>Kategori UMKM</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <a href="{{ route('umkm.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Permohonan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $permohonan }}</h3>
                            <p>Permohonan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <a href="{{ route('permohonan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $dokumen }}</h3>
                            <p>Dokumen</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="{{ route('dokumen.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row justify-content-center align-items-center" style="min-height: 75vh;">
            <div class="col-md-8 text-center">
                <!-- Judul -->
                <h1 class="font-weight-bold mb-4" style="font-size: 2.5rem; color: #2c3e50;">
                    Selamat Datang di <span style="color: #28a745;">Sepatan UMKM</span>
                </h1>

                <!-- Logo -->
                <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo Sepatan UMKM"
                     class="img-fluid mb-4"
                     style="max-width: 250px; animation: zoomIn 1s ease;">

                <!-- Deskripsi -->
                <p style="font-size: 18px; color: #555;">
                    Mendorong pertumbuhan UMKM lokal dengan teknologi dan inovasi.
                </p>

                <!-- Tombol Aksi -->
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg mx-2">
                        Jelajahi UMKM
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg mx-2">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        @endif
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
