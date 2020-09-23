<form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST">
    @csrf
    @method('DELETE')
    
    <span class="dropdown">
        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false"
            title="Menu">
            <i class="fa flaticon-more-1 text-danger"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right"
            style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);"
            x-placement="bottom-end">
            <a class="dropdown-item" href="{{ route('peminjaman.edit', $peminjaman->id) }}"><i class="la la-edit"></i>Ubah</a>
            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_modal-{{ $peminjaman->id }}">
                <i class="la la-trash"></i>Hapus
            </button>
            <a class="dropdown-item" href="{{ route('kembalikan.view', $peminjaman->id) }}"><i class="la la-mail-reply"></i>Kembalikan</a>
        </div>
    </span>

    <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail">
        <i class="fa fa-search text-brand"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="delete_modal-{{ $peminjaman->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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