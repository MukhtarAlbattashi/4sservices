<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.users") }} - {{$users->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_USERS)
                            <button
                                class="btn btn-dark m-2"
                                wire:click="add">
                                {{ __('public.addNewUser') }}
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
                            <td>{{ __("public.email") }}</td>
                            <td>{{ __("public.role") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($users as $user)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="mailto:{{$user->email}}">{{$user->email}}</a>
                                    </td>
                                    <!-- <td>
                                        $user->roles[0]->name
                                    </td> -->
                                    <td>
                                        @forelse($user->getRoleNames() as $role)
                                            <span class="badge bg-green text-white text-dark rounded-3">
                                        {{$role}}
                                    </span>
                                        @empty
                                            <span>No Role</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($user->created_at))}}
                                    </td>
                                    @if($user->email == "super@super.com")
                                        <td>
                                            <button
                                                wire:click="update({{$user->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            @if(Auth::user()->email == $user->email)
                                                <span class="badge rounded-3 bg-warning text-dark">me</span>
                                            @else
                                                @can(\App\Enums\AppPermissions::CAN_EDIT_USERS)
                                                    <button
                                                        wire:click="update({{$user->id}})"
                                                        class="btn btn-outline-primary btn-sm rounded-3">
                                                        <span class="fas fa-edit"></span>
                                                        {{__('public.edit')}}
                                                    </button>
                                                @endcan
                                                @can(\App\Enums\AppPermissions::CAN_DELETE_USERS)
                                                    <button
                                                        wire:click="remove({{$user->id}})"
                                                        class="btn btn-outline-danger btn-sm rounded-3">
                                                        <span class="fas fa-trash"></span>
                                                        {{__('public.delete')}}
                                                    </button>
                                                @endcan
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-12">
                        <label for="role" class="form-label mt-2">{{ __("public.role")}}*</label>
                        <select name="role" wire:model.defer="role" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getOptions() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('role') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerName" class="form-label mt-2">{{ __("public.name") }}*</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="customerName"
                               required>
                        @error('name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label mt-2">{{ __("public.email") }}*</label>
                        <input wire:model.defer="email" type="text" class="form-control" id="email">
                        @error('email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label mt-2">{{ __("public.password") }}*</label>
                        <input wire:model.defer="password" type="password" class="form-control"
                               id="password" required>
                        @error('password') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation"
                               class="form-label mt-2">{{ __("public.password_confirmation") }}*</label>
                        <input wire:model.defer="password_confirmation" type="password" class="form-control"
                               id="password_confirmation" required>
                        @error('password_confirmation') <span
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
                    <div class="col-md-12">
                        <label for="role" class="form-label mt-2">{{ __("public.role")}}*</label>
                        <select {{auth()->user()->email == 'super@super.com'? 'disabled' :''}} name="role" wire:model.defer="role" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getOptions() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('role') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerName" class="form-label mt-2">{{ __("public.name") }}*</label>
                        <input {{auth()->user()->email == 'super@super.com'? 'disabled' :''}} wire:model.defer="name" type="text" class="form-control" id="customerName"
                               required>
                        @error('name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label mt-2">{{ __("public.email") }}*</label>
                        <input {{auth()->user()->email == 'super@super.com'? 'disabled' :''}} wire:model.defer="email" type="text" class="form-control" id="email">
                        @error('email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label mt-2">{{ __("public.password") }}*</label>
                        <input wire:model.defer="password" type="password" class="form-control"
                               id="password" required>
                        @error('password') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary"
                                wire:click="updateUser">{{__('public.save')}}</button>
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
