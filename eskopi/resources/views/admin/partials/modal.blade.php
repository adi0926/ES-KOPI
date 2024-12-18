<!-- Modal -->
<div class="modal fade dynamic-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items:center p-3">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@props(['id' =>"deleteModal" ])
<div tabindex="-1" role="dialog" id="{{$id}}" {{ $attributes->merge(['class' => 'modal fade']) }}>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Konfirmasi Hapus') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('Apakah yakin ingin hapus data ini ?') }}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Tutup') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Ya, Hapus') }}</button>

                </form>
            </div>
        </div>
    </div>
</div>
