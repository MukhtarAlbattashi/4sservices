<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.categoriesHolidays") }} - {{$expenses->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_HOLIDAY_CATEGORIES)
                            <button class="btn btn-dark m-2" wire:click="add"
                            >
                                {{ __('public.add') }} {{ __("public.categoriesHolidays") }}
                            </button>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.name") }}</td>
                            <td>{{ __("public.employeeCount") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($expenses as $expense)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->arName : $expense->enName}}</td>
                                    <td>
                                        {{$expense->holidays_count}}
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($expense->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_HOLIDAY_CATEGORIES)
                                            <button
                                                wire:click="update({{$expense->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_HOLIDAY_CATEGORIES)
                                            <button
                                                wire:click="remove({{$expense->id}})"
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
                {{ $expenses->links() }}
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
                        <button class="btn btn-primary"
                                wire:click="saveUpdate">{{__('public.save')}}</button>
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
