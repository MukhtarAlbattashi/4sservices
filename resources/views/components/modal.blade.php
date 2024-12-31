<div  wire:ignore.self class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center {{ $background }}">
                <h4 class="modal-title w-100 text-white">{{ __($title) }}</h4>
                <button class="btn text-white" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"
                                                                                                class="fas fa-times"></span>
                </button>
            </div>
            <div class="modal-body bg-light-subtle">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
