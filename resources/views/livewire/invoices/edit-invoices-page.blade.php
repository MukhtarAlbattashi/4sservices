<div>
    <div class="container-fluid px-5">
        <div wire:loading.flex wire:target="addToInvoiceService">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
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
        <div wire:loading.flex wire:target="removeService">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <div wire:loading.flex wire:target="saveInvoice">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <div wire:loading.flex wire:target="viewCardJob">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-md-12">
                @livewire('invoices.car-info-page', ['car' => $car])
            </div>
            <div class="col-md-3">
                <div class="card full-screen-card">
                    <div class="card-header bg-info text-white text-center">
                        <h4>
                            {{ __("public.services") }} - {{$services->total()}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between g-1">
                            <div class="col-md-12">
                                <input wire:model.debounce.500ms="searchService" class="form-control"
                                       type="searchService" name="searchService" id="searchService"
                                       placeholder="{{ __('public.search') }}"/>
                            </div>
                            <div class="col-md-12 mt-2">
                                <span class="text-info">
                                    *{{ __("public.saveBeforeAdd") }}
                                </span>
                            </div>
                            <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                                <table class="table table-bordered table-sm table-responsive">
                                    <thead class=" text-center text-danger align-middle">
                                    <td>#</td>
                                    <td>{{ __("public.name") }}</td>
                                    <td>
                                        {{ __("public.sale_price") }} <br/>
                                        OMR
                                    </td>
                                    <td>{{ __("public.add") }}</td>
                                    </thead>
                                    @foreach($services as $index => $service)
                                        <tr class="text-center table-font align-middle"
                                            :wire:key="service-{{$service->id}}">
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{app()->getLocale()=='ar' ? $service->arName : $service->enName}}
                                            </td>
                                            <td>
                                                {{number_format($service->amount,3)}}
                                            </td>
                                            <td>
                                                @if(in_array($service->toArray(),
                                                $addedServices))
                                                    <button class="btn btn-secondary btn-sm" disabled>
                                                        <span class="fas fa-plus text-white"></span>
                                                    </button>
                                                @else
                                                    <button wire:click="addToInvoiceService({{
                                                    $service
                                                }})" class="btn btn-primary btn-sm"
                                                            wire:key="item-services-{{$service->id}}"
                                                            wire:loading.attr="disabled">
                                                        <span class="fas fa-plus text-white"></span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center p-1">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card full-screen-card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __("public.parts") }} - {{$parts->total()}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between g-1">
                            <div class="col-md-12">
                                <input wire:model.debounce.500ms="searchPart" class="form-control" type="searchPart"
                                       name="searchPart" id="searchPart" placeholder="{{ __('public.search') }}"/>
                            </div>
                            <div class="col-md-12 mt-2">
                                <span class="text-info">
                                    *{{ __("public.saveBeforeAdd") }}
                                </span>
                            </div>
                            <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                                <table class="table table-bordered table-sm table-responsive">
                                    <thead class=" text-center text-danger align-middle">
                                    <td>#</td>
                                    <td>{{ __("public.name") }}</td>
                                    <td>
                                        {{ __("public.purchase_price") }}
                                        <br/>
                                        OMR
                                    </td>
                                    <td>
                                        {{ __("public.sale_price") }} <br/>
                                        OMR
                                    </td>
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
                                                {{number_format($part->purchase_price,3)}}
                                            </td>
                                            <td>
                                                {{number_format($part->sale_price,3)}}
                                            </td>
                                            <td>
                                                {{($part->purchases_sum_part_purchasequantity ?? 0)-($part->invoices_sum_invoice_partquantity ?? 0)}}
                                            </td>
                                            <td>
                                                @if(in_array($part->toArray(),$addedParts) || (($part->purchases_sum_part_purchasequantity - $part->invoices_sum_invoice_partquantity)<=0))
                                                    <button class="btn btn-secondary btn-sm" disabled>
                                                        <span class="fas fa-plus text-white"></span>
                                                    </button>
                                                @else
                                                    <button wire:click="addToInvoice({{
                                                    $part
                                                }})" class="btn btn-primary btn-sm" wire:key="item-parts-{{$part->id}}"
                                                            wire:loading.attr="disabled">
                                                        <span class="fas fa-plus text-white"></span>
                                                    </button>
                                                @endif
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
                        <h4 class="text-white text-center">
                            {{ __("public.edit") }} {{ __("public.invoice") }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-1">
                            <div class="col-md-12 text-center">
                                {{ __("public.jobCard") }}
                                <input type="number" wire:model.debounce.500ms="jobCard"
                                       class="form-control text-success text-center"/>
                                @error('jobCard')
                                <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2 text-center">
                                {{ __("public.subTotalService") }}
                                <input type="text" value="{{ number_format($subTotalService, 3) }}"
                                       class="form-control text-success text-center" disabled readonly/>
                            </div>
                            <div class="col-md-2 text-center">
                                {{ __("public.subTotalParts") }}
                                <input type="text" value="{{ number_format($subTotalPart, 3) }}"
                                       class="form-control text-success text-center" disabled readonly/>
                            </div>
                            <div class="col-md-2 text-center">
                                {{ __("public.sub-total") }}
                                <input type="text" value="{{ number_format(($subTotal), 3) }}"
                                       class="form-control text-success text-center" disabled readonly/>
                            </div>
                            <div class="col-md-2 text-center">
                                {{ __("public.taxAmount") }} {{ $gtax }} %
                                <input type="text" wire:model.decbounce.500ms="tax"
                                       class="numberInput form-control text-success text-center"/>
                            </div>
                            <div class="col-md-2 text-center">
                                {{ __("public.discount") }}
                                <input type="number" min="0" wire:model.decbounce.500ms="discount"
                                       value="{{ $discount }}"
                                       class="numberInput form-control text-success text-center"/>
                            </div>
                            <div class="col-md-2 text-center">
                                {{ __("public.totalAmount") }}
                                <input type="text" value="{{ number_format(($total), 3) }}"
                                       class="form-control text-success text-center" disabled readonly/>
                            </div>
                            <div class="col-md-12">
                                <label for="notes" class="form-label mt-2">{{
                                    __("public.note")
                                }}</label>
                                <textarea wire:model.defer="notes" name="notes" id="notes" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 bg-grey">
                                <h3 class="text-center text-danger">{{__('public.services')}}</h3>
                                <div class="row g-1">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-sm table-responsive bg-white">
                                            <tr class=" text-center text-danger align-middle">
                                                <td>#</td>
                                                <td>{{ __("public.name") }}</td>
                                                <td>
                                                    {{ __("public.amount") }}
                                                </td>
                                                <td>
                                                    {{ __("public.quantity") }}/{{ __("public.liter")}}
                                                </td>
                                                <td>{{ __("public.totalAmount") }}</td>
                                                <td>{{ __("public.delete") }}</td>
                                            </tr>
                                            @foreach($addedServices as $index => $service)

                                                <tr class="text-center table-font align-middle"
                                                    :wire:key="addedService-{{ $service['id'] }}">
                                                    <td>
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td>
                                                        {{app()->getLocale()=='ar' ? $service['arName'] : $service['enName']}}
                                                    </td>
                                                    <td>
                                                        {{
                                                    number_format(
                                                        $service["amount"],
                                                        3
                                                    )
                                                }}
                                                    </td>
                                                    <td>
                                                        <input wire:model="quantityService.{{$index}}" min="1"
                                                               type="number" class="form-control text-center"/>
                                                        @error('quantityService.' .$index)
                                                        <span class="error text-danger fs-6">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        {{
                                                    number_format(
                                                        $service["amount"] *
                                                            $quantityService[$index],
                                                        3
                                                    )
                                                }}
                                                    </td>
                                                    <td>
                                                        <button wire:click="removeService({{
                                                    $index
                                                }})" class="btn btn-danger btn-sm"
                                                                wire:key="remove-service{{$loop->iteration}}"
                                                                wire:loading.attr="disabled">
                                                            <span class="fas fa-remove"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 bg-blue">
                                <h3 class="text-center text-primary">{{__('public.parts')}}</h3>
                                <div class="row g-1">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-sm table-responsive bg-white">
                                            <tr class=" text-center text-danger align-middle">
                                                <td>#</td>
                                                <td>{{ __("public.partName") }}</td>
                                                <td>
                                                    {{ __("public.sale_price") }}
                                                </td>
                                                <td>
                                                    {{ __("public.quantity") }}/{{ __("public.liter")}}
                                                </td>
                                                <td>{{ __("public.totalAmount") }}</td>
                                                <td>{{ __("public.delete") }}</td>
                                            </tr>
                                            @foreach($addedParts as $index => $part)

                                                <tr class="text-center table-font align-middle"
                                                    :wire:key="addedPart-{{ $part['id'] }}">
                                                    <td>
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td>
                                                        {{app()->getLocale()=='ar' ? $part['arName'] : $part['enName']}}
                                                    </td>
                                                    <td>
                                                        {{
                                                    number_format(
                                                        $part["sale_price"],
                                                        3
                                                    )
                                                }}
                                                    </td>
                                                    <td>
                                                        <input wire:model="quantity.{{$index}}" min="1" type="number"
                                                               class="form-control text-center"/>
                                                        @error('quantity.' .$index)
                                                        <span class="error text-danger fs-6">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        {{
                                                    number_format(
                                                        $part["sale_price"] *
                                                            $quantity[$index],
                                                        3
                                                    )
                                                }}
                                                    </td>
                                                    <td>
                                                        <button wire:click="remove({{
                                                    $index
                                                }})" class="btn btn-danger btn-sm"
                                                                wire:key="remove-{{$loop->iteration}}"
                                                                wire:loading.attr="disabled">
                                                            <span class="fas fa-remove"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        @can(\App\Enums\AppPermissions::CAN_EDIT_INVOICES)
                            @if(empty($addedParts) && empty($addedServices))
                                <button disabled class="btn btn-success text-white btn-sm">
                                    {{ __("public.save") }} {{ __("public.invoice") }}
                                </button>
                            @else
                                <button wire:click="saveInvoice" class="btn btn-success text-white btn-sm" id="save-btn"
                                        wire:key="save-invoice" wire:loading.attr="disabled">
                                    {{ __("public.save") }} {{ __("public.invoice") }}
                                </button>
                            @endif
                            <button {{!isset($jobCard) ? 'disabled':''}} class="mx-2 btn btn-primary text-white"
                                    wire:click="viewCardJob">
                                {{__('public.view')}} {{__('public.jobCard')}}
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
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
    </script>
</div>
