<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.parts") }} - {{$parts->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_PARTS)
                            <livewire:services.add-parts></livewire:services.add-parts>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.image") }}</td>
                            <td>{{ __("public.name") }}</td>
                            <td>{{ __("public.purchase_price") }} OMR</td>
                            <td>{{ __("public.sale_price") }} OMR</td>
                            <td>{{ __("public.store") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($parts as $part)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <img src="{{asset($part->image ?? 'images/no_image.png')}}" alt="" height="30">
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $part->arName : $part->enName}}
                                    </td>
                                    <td>
                                        {{number_format($part->purchase_price,3)}}
                                    </td>
                                    <td>
                                        {{number_format($part->sale_price,3)}}
                                    </td>
                                    <td @class([ "text-danger"=> ($part->purchases_sum_part_purchasequantity ?? 0)-($part->invoices_sum_invoice_partquantity ?? 0)<=10 ])>
                                        {{($part->purchases_sum_part_purchasequantity ?? 0)-($part->invoices_sum_invoice_partquantity ?? 0)}}
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($part->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_PARTS)
                                            <button
                                                wire:click="update({{$part->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_PARTS)
                                            <button
                                                wire:click="remove({{$part->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$part->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $parts->links() }}
            </div>
        </div>

        <x-modal id="dangerModal" title="public.delete" background="bg-danger">
            <div class="text-center">
                {{__('public.sure')}}
                <br>
                <button class="btn btn-danger text-white" wire:click="delete"
                        type="button">{{__('public.delete')}}</button>
            </div>
        </x-modal>

        <x-modal id="editModal" title="public.add" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="arName" class="form-label mt-2">{{ __("public.arName")}}*</label>
                        <input wire:model.defer="arName" type="text" class="form-control text-center"
                               id="arName" required>
                        @error('arName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="enName" class="form-label mt-2">{{ __("public.enName")}}*</label>
                        <input wire:model.defer="enName" type="text" class="form-control text-center"
                               id="enName" required>
                        @error('enName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="purchase_price" class="form-label mt-2">{{ __("public.purchase_price")}}
                            *</label>
                        <input wire:model.defer="purchase_price" type="number"
                               class="form-control text-center" id="purchase_price" required>
                        @error('purchase_price') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sale_price" class="form-label mt-2">{{ __("public.sale_price")}}
                            *</label>
                        <input wire:model.defer="sale_price" type="number" class="form-control text-center"
                               id="sale_price" required>
                        @error('sale_price') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="store" class="form-label mt-2">{{ __("public.store")}}*</label>
                        <input wire:model.defer="store" type="number" class="form-control text-center"
                               id="store" required disabled>
                        @error('store') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="image" class="form-label mt-2">{{ __("public.image")}}</label>
                        <input wire:model.defer="image" type="file" class="form-control text-center"
                               id="image" accept=".jpg, .png">
                        @error('image') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6" wire:loading wire:target="image">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{__('public.note')}}</label>
                        <textarea wire:model.defer="notes" name="notes" id="notes"
                                  class="form-control"></textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success"
                                wire:click="saveUpadte">{{__('public.save')}}</button>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
    <script>
        window.addEventListener('show-delete-model', event => {
            $('#dangerModal').modal('show');
        })
        window.addEventListener('hide-delete-model', event => {
            $('#dangerModal').modal('hide');
        })
        window.addEventListener('show-edit-model', event => {
            $('#editModal').modal('show');
        })
        window.addEventListener('hide-edit-model', event => {
            $('#editModal').modal('hide');
        })
    </script>
</div>
