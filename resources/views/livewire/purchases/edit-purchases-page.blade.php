<div>
    <div class="container-fluid px-5">
        <div wire:loading.flex wire:target="addToInvoice">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <div wire:loading.flex wire:target="remove">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <div wire:loading.flex wire:target="saveInvoice">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-md-6">
                <div class="card full-screen-card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __("public.parts") }} - {{$parts->total()}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between g-1">
                            <div class="col-md-5">
                                <button class="btn btn-dark m-2" wire:click="add"
                                >
                                    {{ __('public.add') }} {{ __('public.parts') }}
                                </button>
                            </div>
                            <div class="col-md-7">
                                <input wire:model.debounce.500ms="search" class="form-control" type="search"
                                       name="search" id="search" placeholder="{{ __('public.search') }}"/>
                            </div>
                            <div class="col-md-12 mt-2">
                                <span class="text-info">
                                    *{{__('public.saveBeforeAdd')}}
                                </span>
                            </div>
                            <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                                <table class="table table-bordered table-sm table-responsive">
                                    <thead class=" text-center text-danger align-middle">
                                    <td>#</td>
                                    <td>{{ __("public.name") }}</td>
                                    <td>{{ __("public.purchase_price") }} <br> OMR</td>
                                    <td>{{ __("public.sale_price") }} <br> OMR</td>
                                    <td>{{ __("public.store") }}</td>
                                    <td>{{ __("public.add") }}</td>
                                    </thead>
                                    @foreach($parts as $index => $part)
                                        <tr class="text-center table-font align-middle" :wire:key="part-{{$part->id}}">
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{app()->getLocale()=='ar' ? $part->arName : $part->enName}}
                                            </td>
                                            <td>
                                                <div class="input-group" wire:key="part-field-{{ $part->id }}">
                                                <span class="input-group-text bg-white">
                                                    <button wire:click="update({{$part->id}})"
                                                            class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                        {{__('public.edit')}}
                                                    </button>
                                                </span>
                                                    <input type="text"
                                                           value="{{number_format($parts[$index]->purchase_price,3)}}"
                                                           class="form-control text-primary text-center" disabled
                                                           readonly>
                                                </div>
                                            </td>
                                            <td>
                                                {{number_format($part->sale_price,3)}}
                                            </td>
                                            <td>
                                                {{$part->purchases_sum_part_purchasequantity ?? 0}}
                                            </td>
                                            <td>
                                                <button wire:click="addToInvoice({{$part}})"
                                                        class="btn btn-primary btn-sm" wire:key="part-{{$part->id}}"
                                                        wire:loading.attr="disabled">
                                                    <span class="fas fa-plus text-white"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center p-1">
                        {{ $parts->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-6" wire:ignore.self>
                <div class="card full-screen-card">
                    <div class="card-header bg-green">
                        <h4 class="text-white text-center">{{__('public.edit')}} {{__('public.invoice')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-1">
                            <div class="col-md-6">
                                <label for="supplier" class="form-label mt-2">{{ __("public.supplier")}}*</label>
                                <select name="supplier" wire:model.defer="supplier" class="text-center form-select">
                                    @foreach($this->getSuppliers() as $item)
                                        <option value="{{ $item->id }}"
                                                :wire:key="supplier-{{$item->id}}">{{ $item->name }}
                                            / {{$item->phone}} </option>
                                    @endforeach
                                </select>
                                @error('supplier') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label mt-2">{{ __("public.date")}}*</label>
                                <input wire:model.defer="date" type="date" name="date" id="date"
                                       class="text-center form-control">
                            </div>
                            <div class="col-md-3 text-center">
                                {{ __("public.sub-total") }}
                                <input type="text" value="{{number_format($subTotal,3)}}"
                                       class="form-control text-success text-center" disabled readonly>
                            </div>
                            <div class="col-md-3 text-center">
                                {{ __("public.taxAmount") }} {{$gtax}} %
                                <input type="number" min="0" wire:model.decbounce.500ms="tax"
                                       class="numberInput form-control text-success text-center">
                            </div>
                            <div class="col-md-3 text-center">
                                {{ __("public.discount") }}
                                <input type="number" min="0" wire:model.decbounce.500ms="discount"
                                       class="numberInput form-control text-success text-center">
                            </div>
                            <div class="col-md-3 text-center">
                                {{ __("public.totalAmount") }}
                                <input type="text" value="{{number_format($totalPrice,3)}}"
                                       class="form-control text-success text-center" disabled readonly>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-sm table-responsive">
                                    <tr class=" text-center text-danger align-middle">
                                        <td>#</td>
                                        <td>{{ __("public.partName") }}</td>
                                        <td>{{ __("public.purchase_price") }}</td>
                                        <td>{{ __("public.quantity") }}/{{ __("public.liter") }}</td>
                                        <td>{{ __("public.totalAmount") }}</td>
                                        <td>{{ __("public.delete") }}</td>
                                    </tr>
                                    @foreach($addedParts as $index => $part)
                                        <tr class="text-center table-font align-middle"
                                            :wire:key="addedPart-{{$part['id']}}">
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>{{app()->getLocale()=='ar' ? $part['arName'] : $part['enName']}}</td>
                                            <td>{{number_format($part['purchase_price'],3)}}</td>
                                            <td>
                                                <input wire:model="quantity.{{ $index }}" min="1" type="number"
                                                       class="form-control text-center">
                                                @error('quantity.' .$index) <span class="error text-danger fs-6">{{ $message
                                                }}</span> @enderror
                                            </td>
                                            <td>{{number_format($part['purchase_price'] * ($quantity[$index] ?? 1),3)}}</td>
                                            <td>
                                                <button wire:click="remove({{$index}})" class="btn btn-danger btn-sm"
                                                        wire:key="part-remove-{{$part['id']}}"
                                                        wire:loading.attr="disabled">
                                                    <span class="fas fa-remove"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-12">
                                <label for="notes" class="form-label mt-2">{{__('public.note')}}</label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        @can(\App\Enums\AppPermissions::CAN_EDIT_PURCHASES)
                            @if(empty($addedParts))
                                <button disabled class="btn btn-success text-white btn-sm">
                                    {{ __("public.save") }} {{ __("public.invoice") }}
                                </button>
                            @else
                                <button wire:click="saveInvoice" class="btn btn-success text-white btn-sm"
                                        id="save-btn" wire:key="save-invoice" wire:loading.attr="disabled">
                                    {{ __("public.save") }} {{ __("public.invoice") }}
                                </button>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="arName" class="form-label mt-2">{{ __("public.arName")}}*</label>
                        <input wire:model.defer="arName" type="text" class="form-control text-center"
                               id="arName" required>
                        @error('arName') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="enName" class="form-label mt-2">{{ __("public.enName")}}*</label>
                        <input wire:model.defer="enName" type="text" class="form-control text-center"
                               id="enName" required>
                        @error('enName') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="purchase_price" class="form-label mt-2">{{
                                        __("public.purchase_price")}}*</label>
                        <input wire:model.defer="purchase_price" type="number"
                               class="form-control text-center" id="purchase_price" required>
                        @error('purchase_price') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sale_price" class="form-label mt-2">{{
                                        __("public.sale_price")}}*</label>
                        <input wire:model.defer="sale_price" type="number" class="form-control text-center"
                               id="sale_price" required>
                        @error('sale_price') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
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
                        <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
                    </div>
                </div>
            </div>
        </x-modal>

        <x-modal id="editModal" title="public.add" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-12">
                        <label for="purchase_price" class="form-label mt-2">{{
                                        __("public.purchase_price")}}*</label>
                        <input wire:model.defer="purchase_price" type="number"
                               class="form-control text-center" id="purchase_price" required>
                        @error('purchase_price') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        @can(\App\Enums\AppPermissions::CAN_EDIT_PURCHASES)
                            <button class="btn btn-primary" wire:click="saveUpadte">
                                {{__('public.save')}}
                                <div wire:loading wire:target="saveUpadte">
                                    <div class="spinner-border text-white spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
    <script>
        function disableDirectInput(e) {
            const isNumber = !isNaN(parseInt(e.key));
            if (e.key !== '.' && !isNumber && e.key !== 'Backspace') {
                e.preventDefault();
            }
        }

        function setInputToZero(e) {
            if (e.target.value === '') {
                e.target.value = '0';
            }
        }

        const numberInputs = document.querySelectorAll('.numberInput');
        numberInputs.forEach(input => {
            input.addEventListener('keydown', disableDirectInput);
            input.addEventListener('input', setInputToZero);
        });

        window.addEventListener('show-create-model', event => {
            $('#createModal').modal('show');
        })
        window.addEventListener('hide-create-model', event => {
            $('#createModal').modal('hide');
        })
        window.addEventListener('show-edit-model', event => {
            $('#editModal').modal('show');
        })
        window.addEventListener('hide-edit-model', event => {
            $('#editModal').modal('hide');
        })
    </script>
</div>
