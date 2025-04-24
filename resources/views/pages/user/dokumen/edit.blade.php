<div class="modal fade" id="modal-edit-{{ $dokumen->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('userdokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Dokumen Permohonan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" class="form-control" value="{{ $dokumen->nama_dokumen }}" required>
                    </div>

                    <div class="form-group">
                        <label>Ganti File (PDF, Max 2MB)</label><br>
                        @if($dokumen->file_path)
                            <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="btn btn-sm btn-info mb-2">
                                <i class="fa fa-eye"></i> Lihat Dokumen Lama
                            </a>
                        @endif
                        <input type="file" name="file_path" class="form-control-file" accept=".pdf">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
