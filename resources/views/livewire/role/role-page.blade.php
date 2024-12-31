<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.roles") }} - {{$roles->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_ROLES)
                            <a class="btn btn-dark m-2" href="{{route('create-roles')}}">
                                {{ __('public.add') }} {{ __("public.roles") }}
                            </a>
                        @endcan
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.name") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($roles as $role)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        {{date('Y-m-d', strtotime($role->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_ROLES)
                                            <a href="{{route('update-roles', $role)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_ROLES)
                                            <button
                                                wire:click="remove({{$role->id}})"
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
                {{ $roles->links() }}
            </div>
        </div>

        <x-modal id="dangerModal" title="public.delete" background="bg-danger">
            <div class="text-center">
                {{__('public.sure')}}
                <br>
                <button class="btn btn-danger text-white" wire:click="delete"
                        type="button">{{__('public.delete')}}</button>
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
    </script>
</div>
