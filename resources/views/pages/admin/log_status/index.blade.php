@extends('layouts.template_default')
@section('title', 'Log Status Permohonan')
@section('logs', 'active')
@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <section class="content-header">
        <div class="container-fluid">
            <h1>Log Status Permohonan</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-sm text-sm" id="logTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemohon</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Diupdate Oleh</th>
                            <th>Tanggal Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logStatus as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->permohonan->user->name ?? '-' }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->catatan }}</td>
                                <td>{{ $log->user->name ?? '-' }}</td>
                                <td>{{ $log->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
