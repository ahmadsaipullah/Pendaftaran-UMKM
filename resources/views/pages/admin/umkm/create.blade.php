<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel">Tambah UMKM</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('umkm.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_umkm">Nama UMKM</label>
                        <input type="text" class="form-control" name="nama_umkm" id="nama_umkm" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_usaha">Jenis Usaha</label>
                        <input type="text" class="form-control" name="jenis_usaha" id="jenis_usaha" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat_umkm">Alamat UMKM</label>
                        <textarea class="form-control" name="alamat_umkm" id="summernote" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" id="kelurahan" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
