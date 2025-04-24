<div class="modal fade" id="modal-edit-{{ $permohonan->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Permohonan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $permohonan->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ $permohonan->tanggal_pengajuan }}" required>
            </div>

            <div class="form-group">
                <label>UMKM</label>
                <select name="umkm_id" class="form-control" required>
                    @foreach($umkms as $umkm)
                        <option value="{{ $umkm->id }}" {{ $permohonan->umkm_id == $umkm->id ? 'selected' : '' }}>
                            {{ $umkm->nama_umkm }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Pending" {{ $permohonan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Disetujui" {{ $permohonan->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Ditolak" {{ $permohonan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" id="summernote">{{ $permohonan->keterangan }}</textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </form>
    </div>
  </div>
