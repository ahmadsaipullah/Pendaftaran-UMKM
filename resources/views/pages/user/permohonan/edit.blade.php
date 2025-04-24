<div class="modal fade" id="modal-edit-{{ $permohonan->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('userpermohonan.update', $permohonan->id) }}" method="POST">
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
                    <input type="text" name="user_id" class="form-control" value="{{ $permohonan->user->name }}" required readonly>
                </div>
                <input type="hidden" name="status" class="form-control" value="Pending" required>

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ $permohonan->tanggal_pengajuan }}" required>
            </div>

            <div class="form-group">
                <label>UMKM</label>
                <select name="umkm_id" class="form-control" required>
                    @foreach($umkmss as $umkm)
                        <option value="{{ $umkm->id }}" {{ $permohonan->umkm_id == $umkm->id ? 'selected' : '' }}>
                            {{ $umkm->nama_umkm }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" readonly>{{ $permohonan->keterangan }}</textarea>
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
