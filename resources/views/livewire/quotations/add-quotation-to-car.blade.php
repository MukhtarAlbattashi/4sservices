<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.addQuotation") }}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.customerName") }} <br>{{__('public.customerPhone')}}</td>
                            <td>{{ __("public.carType") }} <br>{{__('public.carModel')}}
                                <br>{{__('public.registration-type')}}
                            </td>
                            <td>
                                {{ __("public.owner") }} <br>
                                {{ __("public.ownerID") }}
                            </td>
                            <td>{{ __("public.vehicleNumber") }} <br>{{ __("public.carColor") }} <br>{{
                                    __("public.manufacturingYear") }}</td>
                            <td>{{ __("public.chassisNo") }}</td>
                            <td>{{ __("public.cylindersNo") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.numberInvoices") }}</td>
                            <td>{{ __("public.totalAmount") }} <br> OMR</td>
                            <td>{{ __("public.paid") }} <br> OMR</td>
                            <td>{{ __("public.restAmount") }} <br> OMR</td>
                            <td>{{ __("public.attached") }} 1</td>
                            <td>{{ __("public.attached") }} 2</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.user") }}</td>
                            <td>{{ __("public.note") }}</td>
                            </thead>
                            @foreach($cars as $car)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$car->customer->name}} <br>{{$car->customer->phone}}</td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $car->brand->arName : $car->brand->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $car->model->arName : $car->model->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $car->type->arName : $car->type->enName}}
                                    </td>
                                    <td>{{$car->owner}} <br>{{$car->owner_id}}</td>
                                    <td>{{$car->number}} {{$car->letter}} <br>{{$car->color}} <br>{{$car->year}}</td>
                                    <td class="text-uppercase">{{$car->chassis}}</td>
                                    <td>{{$car->cylinders}}</td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_CREATE_QUOTATIONS)
                                            <a href="{{route('add-quotation',$car)}}"
                                               class="btn btn-primary btn-sm text-white m-1">{{__('public.newQuotation')}}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        {{$car->invoices_count}}
                                    </td>
                                    <td>
                                        {{number_format($car->invoices_sum_total,3)}}
                                    </td>
                                    <td>
                                        {{number_format($car->payments_sum_amount,3)}}
                                    </td>
                                    <td>
                                        {{number_format(($car->invoices_sum_total-$car->payments_sum_amount),3)}}
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
                                        {{$car->notes}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $cars->links() }}
            </div>
        </div>

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
                    <div class="col-md-3">
                        <label for="number" class="form-label mt-2">{{ __("public.vehicleNumber")}}*</label>
                        <input wire:model.defer="number" type="text" class="form-control" id="number"
                               required>
                        @error('number') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="letter" class="form-label mt-2">{{ __("public.letter")}}*</label>
                        <input wire:model.defer="letter" type="text" class="form-control" id="letter"
                               required>
                        @error('letter') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="owner" class="form-label mt-2">{{ __("public.owner")}}*</label>
                        <input wire:model.defer="owner" type="text" class="form-control" id="owner"
                               required>
                        @error('owner') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="owner_id" class="form-label mt-2">{{ __("public.owner_id")}}</label>
                        <input wire:model.defer="owner_id" type="text" class="form-control" id="owner_id"
                               required>
                        @error('owner_id') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="color" class="form-label mt-2">{{ __("public.carColor")}}*</label>
                        <select wire:model.defer="color" id="color" class="form-select"
                                aria-label="Car Colors">
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
                        </select>
                        @error('color') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="year" class="form-label mt-2">{{
                                        __("public.manufacturingYear")}}*</label>
                        <input wire:model.defer="year" type="text" class="form-control isNumber" id="year"
                               oninput="validateNumberInput(this)">
                        @error('year') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="chassis" class="form-label mt-2">{{ __("public.chassisNo")}}*</label>
                        <input wire:model.defer="chassis" type="text" class="chassis form-control text-uppercase"
                               id="chassis" required>
                        @error('chassis') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="cylinders" class="form-label mt-2">{{
                                        __("public.cylindersNo")}}*</label>
                        <input wire:model.defer="cylinders" type="number" min="1" max="20"
                               class="form-control" id="cylinders"
                               required>
                        @error('cylinders') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control" id="attach">
                        @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2" wire:loading wire:target="attach">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-4">
                        <label for="other" class="form-label mt-2">{{ __("public.other")}}</label>
                        <input wire:model.defer="other" type="file" class="form-control" id="other">
                        @error('other') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2" wire:loading wire:target="other">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note")}}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control" id="notes"
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

        <x-modal id="editModal" title="public.add" background="bg-primary">
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
                                <div class="col-md-3">
                                    <label for="number" class="form-label mt-2">{{ __("public.vehicleNumber")}}*</label>
                                    <input wire:model.defer="number" type="text" class="form-control" id="number"
                                           required>
                                    @error('number') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="letter" class="form-label mt-2">{{ __("public.letter")}}*</label>
                                    <input wire:model.defer="letter" type="text" class="form-control" id="letter"
                                           required>
                                    @error('letter') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="owner" class="form-label mt-2">{{ __("public.owner")}}*</label>
                                    <input wire:model.defer="owner" type="text" class="form-control" id="owner"
                                           required>
                                    @error('owner') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="owner_id" class="form-label mt-2">{{ __("public.owner_id")}}</label>
                                    <input wire:model.defer="owner_id" type="text" class="form-control" id="owner_id"
                                           required>
                                    @error('owner_id') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="color" class="form-label mt-2">{{ __("public.carColor")}}*</label>
                                    <select wire:model.defer="color" id="color" class="form-select"
                                            aria-label="Car Colors">
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
                                    </select>
                                    @error('color') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="year" class="form-label mt-2">{{
                                        __("public.manufacturingYear")}}*</label>
                                    <input wire:model.defer="year" type="text" class="form-control isNumber" id="year"
                                           oninput="validateNumberInput(this)">
                                    @error('year') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="chassis" class="form-label mt-2">{{ __("public.chassisNo")}}*</label>
                                    <input wire:model.defer="chassis" type="text"
                                           class="chassis form-control text-uppercase"
                                           id="chassis" required>
                                    @error('chassis') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="cylinders" class="form-label mt-2">{{
                                        __("public.cylindersNo")}}*</label>
                                    <input wire:model.defer="cylinders" type="number" min="1" max="20"
                                           class="form-control" id="cylinders"
                                           required>
                                    @error('cylinders') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                                    <input wire:model.defer="attach" type="file" class="form-control" id="attach">
                                    @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2" wire:loading wire:target="attach">
                                    {{__('public.upload')}}
                                </div>
                                <div class="col-md-4">
                                    <label for="other" class="form-label mt-2">{{ __("public.other")}}</label>
                                    <input wire:model.defer="other" type="file" class="form-control" id="other">
                                    @error('other') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2" wire:loading wire:target="other">
                                    {{__('public.upload')}}
                                </div>
                                <div class="col-md-12">
                                    <label for="notes" class="form-label mt-2">{{ __("public.note")}}</label>
                                    <textarea wire:model.defer="notes" type="text" class="form-control" id="notes"
                                              required></textarea>
                                    @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-success"
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
