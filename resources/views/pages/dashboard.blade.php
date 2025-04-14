@extends('layouts.template_default')

@section('title', 'Sepatan UMKM')
@section('dashboard', 'active ')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Selamat Datang, <span class="btn btn-xs btn-success font-italic">{{ auth()->user()->name }}</span> Sepatan UMKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                @if (auth()->user()->level_id == 1)
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $user }}</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i> <!-- Icon for User Registrations -->
                            </div>
                            <a href="{{ route('admin.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success"> <!-- Changed to green for UMKM -->
                            <div class="inner">
                                <h3>{{ $umkm }}</h3>
                                <p>Kategori Umkm</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-home"></i> <!-- Icon for UMKM (Business category) -->
                            </div>
                            <a href="{{ route('umkm.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Example of adding more boxes for different categories --}}
                {{-- <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $pria }}</h3>
                            <p>Mahasiswa Pria</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-male"></i>
                        </div>
                        <a href="{{ route('admin.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> --}}
                <!-- ./col -->

                @else
                    <div class="mb-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 mb-4">
                                <h1 class="text-center text-bold">Sepatan UMKM</h1>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
