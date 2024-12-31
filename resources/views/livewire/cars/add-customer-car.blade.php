<div>
    <div class="container my-3">
        <h5 class="text-center text-danger">
            {{__('public.addCustomerCar')}}
        </h5>
        <div class="row">
            <div class="col-md-4">
                <label for="customer" class="form-label mt-2">{{
                                        __("public.customerName")}}*</label>
                <input id="customer" name="customer" value="{{$customer->name}}" class="form-control" disabled>
                @error('customer') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="brand" class="form-label mt-2">{{ __("public.carBrand")}}*</label>
                <select name="brand" wire:model="brand" class="form-select">
                    <option value="">{{__('public.choose')}}</option>
                    @foreach($this->getBrands() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('brand') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="model" class="form-label mt-2">{{ __("public.carModel")}}*</label>
                <select name="model" wire:model="model" class="form-select">
                    <option value="">{{__('public.choose')}}</option>
                    @foreach($this->getModels() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('model') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="type" class="form-label mt-2">{{ __("public.carType")}}*</label>
                <select name="type" wire:model.defer="type" class="form-select">
                    <option value="">{{__('public.choose')}}</option>
                    @foreach($this->getTypes() as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('type') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="car.number" class="form-label mt-2">{{ __("public.vehicleNumber")}}*</label>
                <input wire:model.defer="car.number" type="text" class="form-control text-center" id="car.number"
                       required>
                @error('car.number') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="car.letter" class="form-label mt-2">{{ __("public.letter")}}*</label>
                <input wire:model.defer="car.letter" type="text" class="form-control text-uppercase text-center" id="car.letter"
                       required>
                @error('car.letter') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="car.owner" class="form-label mt-2">{{ __("public.owner")}}*</label>
                <input wire:model.defer="car.owner" type="text" class="form-control text-center" id="car.owner"
                       required>
                @error('car.owner') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="car.owner_id" class="form-label mt-2">{{ __("public.owner_id")}}</label>
                <input wire:model.defer="car.owner_id" type="text" class="form-control text-center" id="car.owner_id"
                       required>
                @error('car.owner_id') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="car.color" class="form-label mt-2">{{ __("public.carColor")}}*</label>
                <select wire:model.defer="car.color" id="car.color" class="form-select"
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
                @error('car.color') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="car.year" class="form-label mt-2">{{
                                        __("public.manufacturingYear")}}*</label>
                <input wire:model.defer="car.year" type="car.number" class="form-control text-center isNumber"
                       id="car.year"
                       oninput="validateNumberInput(this)">
                @error('car.year') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label for="car.chassis" class="form-label mt-2">{{ __("public.chassisNo")}}*</label>
                <input wire:model.defer="car.chassis" type="text"
                       class="chassis form-control text-center text-uppercase" id="car.chassis" required>
                @error('car.chassis') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="car.cylinders" class="form-label mt-2">{{
                                        __("public.cylindersNo")}}*</label>
                <input wire:model.defer="car.cylinders" type="number" min="1" max="20"
                       class="form-control text-center" id="car.cylinders" required>
                @error('car.cylinders') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                <input wire:model.defer="attach" type="file" class="form-control text-center" id="attach">
                @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="other" class="form-label mt-2">{{ __("public.other")}}</label>
                <input wire:model.defer="other" type="file" class="form-control text-center" id="other">
                @error('other') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4" wire:loading wire:target="car.attach">
                {{__('public.upload')}}
            </div>
            <div class="col-md-4" wire:loading wire:target="car.other">
                {{__('public.upload')}}
            </div>
            <div class="col-md-12">
                <label for="car.notes" class="form-label mt-2">{{ __("public.note")}}</label>
                <textarea wire:model.defer="car.notes" type="text" class="form-control text-center" id="car.notes"
                          required></textarea>
                @error('car.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12 mt-3">
                <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
            </div>
        </div>
    </div>
</div>
