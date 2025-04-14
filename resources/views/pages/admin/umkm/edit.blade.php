<div class="modal fade" id="modal-edit-{{ $umkm->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $umkm->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditLabel{{ $umkm->id }}">Edit UMKM</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="editForm-{{ $umkm->id }}" action="{{ route('umkm.update', $umkm->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_umkm">Nama UMKM</label>
                        <input type="text" class="form-control" name="nama_umkm" value="{{ $umkm->nama_umkm }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_usaha">Jenis Usaha</label>
                        <input type="text" class="form-control" name="jenis_usaha" value="{{ $umkm->jenis_usaha }}" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat_umkm">Alamat UMKM</label>
                        <textarea class="form-control" name="alamat_umkm" id="summernote" rows="3" required>{{ $umkm->alamat_umkm }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" value="{{ $umkm->kelurahan }}" required>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
