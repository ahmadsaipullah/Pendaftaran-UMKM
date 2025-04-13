@extends('layouts.template_default')
@section('title', 'Update Admin')
@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="text-center">Update Admin</h3>
            </div>
            <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" placeholder="Nama"
                               value="{{ old('name', $admin->name) }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" placeholder="Email"
                               value="{{ old('email', $admin->email) }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password (isi jika ingin diubah)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="Password baru">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="level_id">Level User</label>
                        <select class="form-control" id="level_id" name="level_id">
                            <option value="{{ $admin->level_id }}" selected disabled>{{ $admin->level->level }}</option>
                            @foreach ($levels as $level)
                                @if ($level->id != $admin->level_id)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                               id="nik" name="nik" placeholder="NIK"
                               value="{{ old('nik', $admin->nik) }}">
                        @error('nik')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                               id="no_hp" name="no_hp" placeholder="Nomor Handphone"
                               value="{{ old('no_hp', $admin->no_hp) }}">
                        @error('no_hp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Alamat lengkap">{{ old('alamat', $admin->alamat) }}</textarea>
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Foto</label><br>
                        @if ($admin->image)
                            <img src="{{ Storage::url($admin->image) }}" alt="gambar" width="120px"
                                 style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;" class="img-fluid mb-2">
                        @else
                            <img alt="image" class="img-fluid thumbnail" src="{{ asset('assets/img/user_default.png') }}" width="120px">
                        @endif
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
