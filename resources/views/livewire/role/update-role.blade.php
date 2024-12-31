<div>
    <div class="container">
        <div class="form-group">
            <label for="name" class="fs-4 m-1 text-danger">{{__('roles.roleName')}}</label>
            <input type="text" class="form-control" wire:model.defer="name" id="name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="permissions" class="fs-4 my-4 text-danger">{{__('roles.permissions')}}</label>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered ">
                            @foreach($all_permissions as $permission)
                                @if($loop->index % 4 == 0)
                                    <tr>
                                        @endif
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       value="{{ $permission->id }}" id="{{ $permission->name }}"
                                                       wire:model="selectedPermissions.{{ $permission->id }}">
                                                <label class="form-check-label"
                                                       for="permission_{{ $permission->name }}">
                                                    {{ trans('roles.'.$permission->name) }}
                                                </label>
                                            </div>
                                        </td>
                                        @if(($loop->index + 1) % 4 == 0)
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @error('permissions') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="row my-4">
            <div class="col-md-12 text-center">
                @can(\App\Enums\AppPermissions::CAN_EDIT_ROLES)
                    <button wire:click="createRole" class="btn btn-success text-center btn-sm"
                            wire:loading.attr="disabled">
                        {{__('public.save')}}
                        <div class="spinner-border text-white spinner-border-sm" role="status" wire:loading
                             wire:target="createRole">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>
