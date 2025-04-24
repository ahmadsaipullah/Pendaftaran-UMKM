<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('userpermohonan.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel">Tambah Permohonan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body">
            <!-- Hapus input hidden ini -->
            <div class="form-group">
                <label>Tanggal Menyerahkan Berkas</label>
                <input type="date" name="tanggal_pengajuan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>UMKM</label>
                <select name="umkm_id" class="form-control" required>
                    <option value="">-- Pilih UMKM --</option>
                    @foreach($umkms as $umkm)
                        <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </form>
    </div>
  </div>
