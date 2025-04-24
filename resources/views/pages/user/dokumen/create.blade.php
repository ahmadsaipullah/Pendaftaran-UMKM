<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('userdokumen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createModalLabel">Tambah Dokumen Permohonan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Sembunyikan permohonan_id -->
                    @if($latestPermohonan)
                    <input type="hidden" name="permohonan_id" value="{{ $latestPermohonan->id }}">
                @else
                    <div class="alert alert-warning">
                        Anda belum memiliki permohonan yang terdaftar.
                    </div>
                @endif

                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Unggah Dokumen (PDF, Max 2MB)</label>
                        <input type="file" name="file_path" class="form-control-file" accept=".pdf" required>
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
