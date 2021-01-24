<form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <a type="button" data-toggle="modal" data-target="#delete_modal-{{ $jabatan->id }}" class="btn btn-sm btn-icon btn-icon-sm btn-elevate btn-elevate-air" title="Hapus">
        <i class="fa fa-trash text-danger"></i>
    </a>

    <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn btn-sm btn-icon btn-icon-sm btn-elevate btn-elevate-air" title="Ubah">
        <i class="fa fa-edit text-warning"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="delete_modal-{{ $jabatan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus data ini ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clean" data-dismiss="modal">
                        <i class="fa fa-reply"></i>Kembali</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>Hapus</button>
                </div>
            </div>
        </div>
    </div>

</form>