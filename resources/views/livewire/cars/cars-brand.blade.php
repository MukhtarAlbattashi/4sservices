<div>
    <div class="container-fluid px-5">

        <x-loading-component wireTarget="save"/>
        <x-loading-component wireTarget="updateCar"/>
        <x-loading-component wireTarget="delete"/>
        <x-loading-component wireTarget="search"/>
        <x-loading-component wireTarget="add"/>
        <x-loading-component wireTarget="update"/>
        <x-loading-component wireTarget="remove"/>

        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.vehiclesBrand") }} - {{$cars->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_CAR_BRANDS)
                            <button class="btn btn-dark m-2 m-2" x-data
                                    @click="$wire.resting(); $dispatch('show-create-model');"
                                    wire:loading.attr="disabled">
                                {{ __('public.newVehicleBrand') }}
                            </button>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>

                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table  table-bordered table-sm table-responsive">
                            <thead class=" text-center text-danger align-middle bg-light">
                            <td>#</td>
                            <td>{{ __("public.image") }}</td>
                            <td>{{ __("public.carType") }}</td>
                            <td>{{ __("public.numberOfCars") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.user") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($cars as $car)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <img src="{{asset($car->image ?? 'images/no_image.png')}}" alt="" height="30">
                                    </td>
                                    <td>{{app()->getLocale()=='ar' ? $car->arName : $car->enName}}</td>
                                    <td>
                                        <span class="dark-card">
                                            {{ $car->cars_count }}
                                            {{__('public.car')}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="dark-card">
                                            {{$car->created_at->diffForHumans()}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="dark-card">
                                            {{$car->user->name ?? trans('public.not-available')}}
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-center gap-3">
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_CAR_BRANDS)
                                            <button
                                                wire:click="update({{$car->id}})"
                                                wire:loading.attr="disabled"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_CAR_BRANDS)
                                            <button
                                                x-data
                                                @click="$wire.set('carBrandId', {{$car->id}}, true); $dispatch('show-delete-model')"
                                                wire:loading.attr="disabled"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
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
                        <label for="arName" class="form-label mt-2">{{ __("public.arName")}}*</label>
                        <input wire:model.defer="arName" type="text" class="form-control" id="arName"
                               required>
                        @error('arName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="enName" class="form-label mt-2">{{ __("public.enName")}}*</label>
                        <input wire:model.defer="enName" type="text" class="form-control" id="enName"
                               required>
                        @error('enName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="image" class="form-label mt-2">{{ __("public.image")}}</label>
                        <input wire:model.defer="image" type="file" class="form-control" id="image"
                               accept=".jpg, .png">
                        @error('image') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6" wire:loading wire:target="image">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success" wire:click="save"
                                wire:loading.attr="disabled">{{__('public.save')}}</button>
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
                        <label for="arName" class="form-label mt-2">{{ __("public.arName")}}*</label>
                        <input wire:model.defer="arName" type="text" class="form-control" id="arName"
                               required>
                        @error('arName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="enName" class="form-label mt-2">{{ __("public.enName")}}*</label>
                        <input wire:model.defer="enName" type="text" class="form-control" id="enName"
                               required>
                        @error('enName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="image" class="form-label mt-2">{{ __("public.image")}}</label>
                        <input wire:model.defer="image" type="file" class="form-control" id="image"
                               accept=".jpg, .png">
                        @error('image') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6" wire:loading wire:target="image">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary"
                                wire:click="updateCar" wire:loading.attr="disabled">{{__('public.save')}}</button>
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
        window.addEventListener('show-create-model', event => {
            $('#createModal').modal('show');
        })
        window.addEventListener('hide-create-model', event => {
            $('#createModal').modal('hide');
        })
    </script>
</div>
