<div>
    <x-loading-component wireTarget="save"/>
    <button class="btn btn-dark m-2" x-data @click="$dispatch('show-create-model')">
            {{ __('public.parts') }}
    </button>
    <x-modal id="createModal" title="public.add" background="bg-dark">
        <div class="container my-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="arName" class="form-label mt-2">{{ __("public.arName")}}*</label>
                    <input wire:model.defer="part.arName" type="text" class="form-control text-center"
                           id="arName" required>
                    @error('part.arName') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="enName" class="form-label mt-2">{{ __("public.enName")}}*</label>
                    <input wire:model.defer="part.enName" type="text" class="form-control text-center"
                           id="enName" required>
                    @error('part.enName') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="purchase_price" class="form-label mt-2">{{ __("public.purchase_price")}}
                        *</label>
                    <input wire:model.defer="part.purchase_price" type="number"
                           class="form-control text-center" id="purchase_price" required>
                    @error('part.purchase_price') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="sale_price" class="form-label mt-2">{{ __("public.sale_price")}}
                        *</label>
                    <input wire:model.defer="part.sale_price" type="number" class="form-control text-center"
                           id="sale_price" required>
                    @error('part.sale_price') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12">
                    <label for="image" class="form-label mt-2">{{ __("public.image")}}</label>
                    <input wire:model.defer="part.image" type="file" class="form-control" id="image"
                           accept=".jpg, .png">
                    @error('part.image') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" wire:loading wire:target="image">
                    {{__('public.upload')}}
                </div>
                <div class="col-md-12">
                    <label for="notes" class="form-label mt-2">{{__('public.note')}}</label>
                    <textarea wire:model.defer="part.notes" name="notes" id="notes"
                              class="form-control"></textarea>
                    @error('part.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
                </div>
            </div>
        </div>
    </x-modal>
</div>
<script>
    window.addEventListener('show-create-model', event => {
        $('#createModal').modal('show');
    })
    window.addEventListener('hide-create-model', event => {
        $('#createModal').modal('hide');
    })
</script>
