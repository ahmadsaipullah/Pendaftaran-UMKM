@extends('layouts.template_default')
@section('title', 'Halaman Admin')
@section('admin','active')
@section('content')
<style>
    .text-xs {
    font-size: 0.75rem;
}

    </style>
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Halaman Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Admin</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary" href="{{route('admin.create')}}"><i class="fa fa-plus"></i> Tambah Admin</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="Table" class="table table-bordered table-striped table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Role</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admins as $admin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->no_hp }}</td>
                                                <td>{{ $admin->level->level }}</td>
                                                <td class="text-center">
                                                    @if ($admin->image)
                                                        <img src="{{ Storage::url($admin->image) }}" alt="gambar"
                                                             class="img-fluid rounded-circle" width="60" height="60"
                                                             style="object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('assets/img/user_default.png') }}"
                                                             class="img-fluid rounded-circle" width="60" height="60"
                                                             alt="default">
                                                    @endif
                                                </td>
                                                <td class="text-center d-flex">
                                                    <a href="{{ route('admin.edit', $admin->id) }}"
                                                       class="btn btn-warning btn-sm mr-1">
                                                        <i class="fa fa-pen"></i>
                                                    </a>
                                                    <form action="{{ route('admin.destroy', $admin->id) }}"
                                                          method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center p-5">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
