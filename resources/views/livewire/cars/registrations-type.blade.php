<div>
    <div class="container-fluid px-5">

        <x-loading-component wireTarget="save"/>
        <x-loading-component wireTarget="updateCar"/>
        <x-loading-component wireTarget="delete"/>
        <x-loading-component wireTarget="search"/>
        <x-loading-component wireTarget="update"/>
        <x-loading-component wireTarget="remove"/>

        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.registration-type") }} - {{$cars->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_REGISTRATION_TYPES)
                            <button class="btn btn-dark m-2 m-2" wire:loading.attr="disabled" x-data
                                    @click="$wire.set('arName', ' ');$wire.set('enName', ' '); $dispatch('show-create-model');">
                                {{ __("public.add-registration-type") }}
                            </button>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
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
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_REGISTRATION_TYPES)
                                            <button
                                                wire:click="update({{$car->id}})" wire:loading.attr="disabled"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_REGISTRATION_TYPES)
                                            <button wire:loading.attr="disabled"
                                                x-data
                                                @click="$wire.set('registrationTypeId', {{$car->id}}, true); $dispatch('show-delete-model')"
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
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success" wire:click="save" wire:loading.attr="disabled"
                                wire:target="save"
                                id="saveButton">
                            {{__('public.save')}}
                        </button>
                    </div>
                </div>
            </div>
        </x-modal>

        <x-modal id="dangerModal" title="public.delete" background="bg-danger">
            <div class="text-center">
                {{__('public.sure')}}
                <br>
                <button class="btn btn-danger text-white" wire:click="delete" wire:loading.attr="disabled"
                        type="button">{{__('public.delete')}}</button>
            </div>
        </x-modal>

        <x-modal id="editModal" title="public.edit" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="earName" class="form-label mt-2">{{ __("public.arName")}}*</label>
                        <input wire:model.defer="arName" type="text" class="form-control" id="earName"
                               required>
                        @error('arName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="eenName" class="form-label mt-2">{{ __("public.enName")}}*</label>
                        <input wire:model.defer="enName" type="text" class="form-control" id="eenName"
                               required>
                        @error('enName') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary" wire:loading.attr="disabled"
                                wire:click="updateCar">{{__('public.save')}}
                        </button>
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
