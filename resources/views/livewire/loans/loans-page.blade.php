<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.loans") }} - {{$loans->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_LOANS)
                            <button class="btn btn-dark m-2" wire:click="add"
                            >
                                {{ __('public.add') }} {{ __("public.loans") }}
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
                            <td>{{ __("public.fromDate") }}</td>
                            <td>{{ __("public.toDate") }}</td>
                            <td>{{ __("public.amount") }}</td>
                            <td>{{ __("public.state") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($loans as $loan)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$loan->name}}</td>
                                    <td>{{$loan->from}}</td>
                                    <td>{{$loan->to}}</td>
                                    <td>{{$loan->amount}}</td>
                                    <td>
                                        @if($loan->active)
                                            <span
                                                class="badge text-bg-success fs-6 rounded-3">{{__('public.con')}}
                                            </span>
                                        @else
                                            <span
                                                class="badge text-bg-danger fs-6 rounded-3">{{__('public.notCon')}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($loan->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_LOANS)
                                            <button
                                                wire:click="update({{$loan->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_LOANS)
                                            <button
                                                wire:click="remove({{$loan->id}})"
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
                {{ $loans->links() }}
            </div>
        </div>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label mt-2">{{ __("public.name")}}*</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name"
                               required>
                        @error('name') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model.defer="amount" type="number" class="form-control" id="amount"
                               required>
                        @error('amount') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="from" class="form-label mt-2">{{ __("public.fromDate")}}*</label>
                        <input wire:model.defer="from" type="date" class="form-control" id="from"
                               required>
                        @error('from') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="to" class="form-label mt-2">{{ __("public.toDate")}}*</label>
                        <input wire:model.defer="to" type="date" class="form-control" id="to"
                               required>
                        @error('to') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-check">
                            <label for="active" class="form-label">{{ __("public.active")}}*</label>
                            <input wire:model.defer="active" class="form-check-input" type="checkbox"
                                   value="" id="active" checked>
                        </div>
                        @error('active') <span
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
                        <label for="name" class="form-label mt-2">{{ __("public.name")}}*</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name"
                               required>
                        @error('name') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model.defer="amount" type="number" class="form-control" id="amount"
                               required>
                        @error('amount') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="from" class="form-label mt-2">{{ __("public.fromDate")}}*</label>
                        <input wire:model.defer="from" type="date" class="form-control" id="from"
                               required>
                        @error('from') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="to" class="form-label mt-2">{{ __("public.toDate")}}*</label>
                        <input wire:model.defer="to" type="date" class="form-control" id="to"
                               required>
                        @error('to') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-check">
                            <label for="active" class="form-label">{{ __("public.active")}}*</label>
                            <input wire:model.defer="active" class="form-check-input" type="checkbox"
                                   value="" id="active" checked>
                        </div>
                        @error('active') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
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
