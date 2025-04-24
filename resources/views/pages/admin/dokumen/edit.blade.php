<!-- Modal Edit Dokumen -->
<div class="modal fade" id="modal-edit-{{ $dokumen->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="permohonan_id" class="form-control" value="{{ $dokumen->permohonan_id}}" readonly>


                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" class="form-control" value="{{ $dokumen->nama_dokumen }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending" {{ $dokumen->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Disetujui" {{ $dokumen->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Ditolak" {{ $dokumen->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $dokumen->keterangan }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>File (opsional jika ingin ganti)</label>
                        <input type="file" name="file_path" class="form-control-file">
                        @if ($dokumen->file_path)
                            <small class="form-text text-muted">
                                File saat ini: <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank">Lihat File</a>
                            </small>
                        @endif
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
