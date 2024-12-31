<div>
    <div class="container-fluid px-5">
        <x-loading-component wireTarget="save"/>
        <x-loading-component wireTarget="saveUpdate"/>
        <x-loading-component wireTarget="delete"/>
        <x-loading-component wireTarget="search"/>
        <x-loading-component wireTarget="add"/>
        <x-loading-component wireTarget="remove"/>
        <x-loading-component wireTarget="update"/>

        <x-card title="public.vehicles" :total="$cars->total()" :link="$cars">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    @can(\App\Enums\AppPermissions::CAN_CREATE_CARS)
                        <button class="btn btn-dark m-2 m-2" wire:click="add">
                            {{ __('public.add') }} {{ __("public.vehicles") }}
                        </button>
                    @endcan
                </div>
                <div class="col-md-3">
                    <x-search-component wireModel="search"/>
                </div>

                <x-table :headers="[
                '#',
                'public.customerName',
                'public.carType',
                'public.vehicleNumber',
                'public.chassisNo',
                'public.action',
                'public.numberInvoices',
                'public.totalAmount',
                'public.paid',
                'public.restAmount',
                'public.attached',
                'public.attached',
                'public.createdAt',
                'public.user',
                'public.action',
                ]">
                    @foreach($cars as $car)
                        <tr class="text-center table-font align-middle">
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$car->customer->name}}
                                <br>
                                {{$car->customer->phone}}
                            </td>
                            <td>
                                {{app()->getLocale()=='ar' ? $car->brand->arName : $car->brand->enName}}
                                <br>
                                {{app()->getLocale()=='ar' ? $car->model->arName : $car->model->enName}}
                                <br>
                                {{app()->getLocale()=='ar' ? $car->type->arName : $car->type->enName}}
                            </td>
                            <td>{{$car->number}} {{$car->letter}} <br>{{$car->color}} <br>{{$car->year}}</td>
                            <td class="text-uppercase">{{$car->chassis}}</td>
                            <td>
                                @can(\App\Enums\AppPermissions::CAN_CREATE_INVOICES)
                                    @if($car->jobs_count <=0)
                                        <button
                                            class="btn btn-outline-secondary btn-sm disabled">
                                            {{__('public.newInvoice')}}
                                        </button>
                                    @else
                                        <a href="{{route('add-invoice',$car)}}"
                                           class="btn btn-outline-success btn-sm">
                                            {{__('public.newInvoice')}}
                                        </a>
                                    @endif
                                @endcan
                                @can(\App\Enums\AppPermissions::CAN_CREATE_INVOICES)
                                    <a href="{{route('add-invoice-part',$car)}}"
                                       class="btn btn-outline-violet btn-sm">
                                        {{__('public.invoice')}} ( {{__('public.part')}} )
                                    </a>
                                @endcan
                                @can(\App\Enums\AppPermissions::CAN_CREATE_QUOTATIONS)
                                    <a href="{{route('add-quotation',$car)}}"
                                       class="btn btn-outline-primary btn-sm">
                                        {{__('public.newQuotation')}}
                                    </a>
                                @endcan
                                @can(\App\Enums\AppPermissions::CAN_CREATE_JOB_CARDS)
                                    <a href="{{route('add-jop-card',$car)}}"
                                       class="btn btn-outline-dark btn-sm">
                                        {{__('public.jopCardNo')}}
                                    </a>
                                @endcan
                            </td>
                            <td>
                                        <span class="dark-card">
                                            {{$car->invoices_count}}
                                        </span>
                            </td>
                            <td>
                                        <span @class([
                                            'warning-card' => ($car->invoices_sum_total ?? 0) > 0,
                                            'dark-card' => ($car->invoices_sum_total ?? 0) == 0,
                                            'danger-card' => ($car->invoices_sum_total ?? 0) < 0,
                                        ])>
                                            {{number_format($car->invoices_sum_total,3)}}
                                        </span>
                            </td>
                            <td>
                                        <span @class([
                                            'success-card' => ($car->payments_sum_amount ?? 0) > 0,
                                            'dark-card' => ($car->payments_sum_amount ?? 0) == 0,
                                            'danger-card' => ($car->payments_sum_amount ?? 0) < 0,
                                        ])>
                                             {{number_format($car->payments_sum_amount,3)}}
                                        </span>
                            </td>
                            <td>
                                        <span @class([
                                            'success-card' => ($car->invoices_sum_total - $car->payments_sum_amount ?? 0) < 0,
                                            'dark-card' => ($car->invoices_sum_total - $car->payments_sum_amount ?? 0) == 0,
                                            'danger-card' => ($car->invoices_sum_total - $car->payments_sum_amount ?? 0) > 0,
                                        ])>
                                            {{number_format(($car->invoices_sum_total-$car->payments_sum_amount),3)}}
                                        </span>
                            </td>
                            <td>
                                @if($car->attach)
                                    <a href="{{asset($car->attach)}}" target="_blank"
                                       class="btn text-info">
                                        <span class="fas fa-file"></span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($car->other)
                                    <a href="{{asset($car->other)}}" target="_blank"
                                       class="btn text-info">
                                        <span class="fas fa-file"></span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{date('Y-m-d', strtotime($car->created_at))}}
                            </td>
                            <td>
                                        <span class="dark-card">
                                        {{$car->user->name ?? trans('public.not-available')}}
                                        </span>
                            </td>
                            <td>
                                @can(\App\Enums\AppPermissions::CAN_EDIT_CARS)
                                    <button
                                        wire:click="update({{$car->id}})"
                                        class="btn btn-outline-primary btn-sm mb-2">
                                        <span class="fas fa-edit"></span>
                                        {{__('public.edit')}}
                                    </button>
                                @endcan
                                <br>
                                @can(\App\Enums\AppPermissions::CAN_DELETE_CARS)
                                    <button
                                        wire:click="remove({{$car->id}})"
                                        class="btn btn-outline-danger rounded-3 btn-sm">
                                        <span class="fas fa-trash"></span>
                                        {{__('public.delete')}}
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            </div>
        </x-card>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="customer" class="form-label mt-2">{{
                                        __("public.customerName")}}*</label>
                        <select name="customer" wire:model.defer="customer" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCustomers() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}
                                    / {{$item->phone}} </option>
                            @endforeach
                        </select>
                        @error('customer') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label mt-2">{{ __("public.carBrand")}}*</label>
                        <select name="brand" wire:model="brand" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getBrands() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('brand') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label mt-2">{{ __("public.carModel")}}*</label>
                        <select name="model" wire:model="model" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getModels() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('model') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label mt-2">{{ __("public.carType")}}*</label>
                        <select name="type" wire:model.defer="type" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getTypes() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('type') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label mt-2">{{ __("public.vehicleNumber")}}*</label>
                        <input wire:model.defer="number" type="text" class="form-control text-center" id="number"
                               required>
                        @error('number') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="letter" class="form-label mt-2">{{ __("public.letter")}}*</label>
                        <input wire:model.defer="letter" type="text" class="form-control text-center" id="letter"
                               required>
                        @error('letter') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="owner" class="form-label mt-2">{{ __("public.owner")}}*</label>
                        <input wire:model.defer="owner" type="text" class="form-control text-center" id="owner"
                               required>
                        @error('owner') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="owner_id" class="form-label mt-2">{{ __("public.owner_id")}}</label>
                        <input wire:model.defer="owner_id" type="text" class="form-control text-center" id="owner_id"
                               required>
                        @error('owner_id') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="color" class="form-label mt-2">{{ __("public.carColor")}}*</label>
                        <select wire:model.defer="color" id="color" class="form-select"
                                aria-label="Car Colors">
                            <option value="">{{__('public.choose')}}</option>
                            <option value="####">####</option>
                            <option value="White / أبيض">White / أبيض</option>
                            <option value="Black / أسود">Black / أسود</option>
                            <option value="Silver / فضي">Silver / فضي</option>
                            <option value="Gray / رمادي">Gray / رمادي</option>
                            <option value="Red / أحمر">Red / أحمر</option>
                            <option value="Blue / أزرق">Blue / أزرق</option>
                            <option value="Green / أخضر">Green / أخضر</option>
                            <option value="Green / أخضر">Yellow / أصفر</option>
                            <option value="Orange / برتقالي">Orange / برتقالي</option>
                            <option value="Brown / بني">Brown / بني</option>
                            <option value="Gold / ذهبي">Gold / ذهبي</option>
                            <option value="Dewani / ديواني">Dewani / ديواني</option>
                            <option value="Pink / وردي">Pink / وردي</option>
                            <option value="Purple / بنفسجي">Purple / بنفسجي</option>
                            <option value="Light Green / أخضر فاتح">Light Green / أخضر فاتح</option>
                        </select>
                        @error('color') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="year" class="form-label mt-2">{{
                                        __("public.manufacturingYear")}}*</label>
                        <input wire:model.defer="year" type="number" class="form-control text-center isNumber" id="year"
                               oninput="validateNumberInput(this)">
                        @error('year') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="chassis" class="form-label mt-2">{{ __("public.chassisNo")}}*</label>
                        <input wire:model.defer="chassis" type="text"
                               class="chassis form-control text-center text-uppercase" id="chassis" required>
                        @error('chassis') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cylinders" class="form-label mt-2">{{
                                        __("public.cylindersNo")}}*</label>
                        <input wire:model.defer="cylinders" type="number" min="1" max="20"
                               class="form-control text-center" id="cylinders" required>
                        @error('cylinders') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control text-center" id="attach">
                        @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="other" class="form-label mt-2">{{ __("public.other")}}</label>
                        <input wire:model.defer="other" type="file" class="form-control text-center" id="other">
                        @error('other') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6" wire:loading wire:target="attach">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-6" wire:loading wire:target="other">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note")}}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control text-center" id="notes"
                                  required></textarea>
                        @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
                    </div>
                </div>
            </div>
        </x-modal>

        <x-modal id="dangerModal" title="public.delete" background="bg-danger">
            <div class="text-center">
                {{__('public.sure')}}
                <br>
                <button class="btn btn-danger text-white" wire:click="delete"
                        type="button">{{__('public.delete')}}</button>
            </div>
        </x-modal>

        <x-modal id="editModal" title="public.edit" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="customer" class="form-label mt-2">{{
                                        __("public.customerName")}}*</label>
                        <select name="customer" wire:model.defer="customer" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCustomers() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}
                                    / {{$item->phone}} </option>
                            @endforeach
                        </select>
                        @error('customer') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label mt-2">{{ __("public.carBrand")}}*</label>
                        <select name="brand" wire:model="brand" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getBrands() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('brand') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label mt-2">{{ __("public.carModel")}}*</label>
                        <select name="model" wire:model="model" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getModels() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('model') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label mt-2">{{ __("public.carType")}}*</label>
                        <select name="type" wire:model.defer="type" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getTypes() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('type') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label mt-2">{{ __("public.vehicleNumber")}}*</label>
                        <input wire:model.defer="number" type="text" class="form-control text-center" id="number"
                               required>
                        @error('number') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="letter" class="form-label mt-2">{{ __("public.letter")}}*</label>
                        <input wire:model.defer="letter" type="text" class="form-control text-center" id="letter"
                               required>
                        @error('letter') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="owner" class="form-label mt-2">{{ __("public.owner")}}*</label>
                        <input wire:model.defer="owner" type="text" class="form-control text-center" id="owner"
                               required>
                        @error('owner') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="owner_id" class="form-label mt-2">{{ __("public.owner_id")}}</label>
                        <input wire:model.defer="owner_id" type="text" class="form-control text-center" id="owner_id"
                               required>
                        @error('owner_id') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="color" class="form-label mt-2">{{ __("public.carColor")}}*</label>
                        <select wire:model.defer="color" id="color" class="form-select"
                                aria-label="Car Colors">
                            <option value="">{{__('public.choose')}}</option>
                            <option value="####">####</option>
                            <option value="White / أبيض">White / أبيض</option>
                            <option value="Black / أسود">Black / أسود</option>
                            <option value="Silver / فضي">Silver / فضي</option>
                            <option value="Gray / رمادي">Gray / رمادي</option>
                            <option value="Red / أحمر">Red / أحمر</option>
                            <option value="Blue / أزرق">Blue / أزرق</option>
                            <option value="Green / أخضر">Green / أخضر</option>
                            <option value="Green / أخضر">Yellow / أصفر</option>
                            <option value="Orange / برتقالي">Orange / برتقالي</option>
                            <option value="Brown / بني">Brown / بني</option>
                            <option value="Gold / ذهبي">Gold / ذهبي</option>
                            <option value="Dewani / ديواني">Dewani / ديواني</option>
                            <option value="Pink / وردي">Pink / وردي</option>
                            <option value="Purple / بنفسجي">Purple / بنفسجي</option>
                            <option value="Light Green / أخضر فاتح">Light Green / أخضر فاتح</option>
                        </select>
                        @error('color') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="year" class="form-label mt-2">{{
                                        __("public.manufacturingYear")}}*</label>
                        <input wire:model.defer="year" type="number" class="form-control text-center isNumber" id="year"
                               oninput="validateNumberInput(this)">
                        @error('year') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="chassis" class="form-label mt-2">{{ __("public.chassisNo")}}*</label>
                        <input wire:model.defer="chassis" type="text"
                               class="chassis form-control text-center text-uppercase" id="chassis" required>
                        @error('chassis') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cylinders" class="form-label mt-2">{{
                                        __("public.cylindersNo")}}*</label>
                        <input wire:model.defer="cylinders" type="number" min="1" max="20"
                               class="form-control text-center" id="cylinders" required>
                        @error('cylinders') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control text-center" id="attach">
                        @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="other" class="form-label mt-2">{{ __("public.other")}}</label>
                        <input wire:model.defer="other" type="file" class="form-control text-center" id="other">
                        @error('other') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6" wire:loading wire:target="attach">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-6" wire:loading wire:target="other">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note")}}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control text-center" id="notes"
                                  required></textarea>
                        @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary"
                                wire:click="saveUpdate">{{__('public.save')}}</button>
                    </div>
                </div>
            </div>
        </x-modal>

    </div>
    <script>

        function validateNumberInput(input) {
            var inputValue = input.value;
            var numbers = /^\d{0,4}$/;

            if (!inputValue.match(numbers)) {
                input.value = inputValue.slice(0, 4);
            }
        }

        $(document).ready(function () {
            $('.chassis').keypress(function (event) {
                var char = String.fromCharCode(event.which);
                if (!(/[a-zA-Z0-9]/.test(char))) {
                    event.preventDefault();
                    return false;
                }
            });
        });
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
        window.addEventListener('show-create-model', event => {
            $('#createModal').modal('show');
        })
        window.addEventListener('hide-create-model', event => {
            $('#createModal').modal('hide');
        })
    </script>
</div>
