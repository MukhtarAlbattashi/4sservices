<div>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __("public.roles") }}</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="fs-4 m-1">{{__('roles.roleName')}}</label>
                            <input type="text" class="form-control" wire:model.defer="name" id="name">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="permissions" class="fs-4 my-4">{{__('roles.permissions')}}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="select_all" wire:model="selectAll"
                                       wire:loading.attr="disabled">
                                <label class="form-check-label" for="select_all">{{__('roles.select_all')}}</label>
                                <div class="spinner-border text-primary spinner-border-sm" role="status" wire:loading
                                     wire:target="selectAll">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
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
                                                                       value="{{ $permission->name }}"
                                                                       wire:model="permissions">
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
                                @can(\App\Enums\AppPermissions::CAN_CREATE_ROLES)
                                    <button wire:click="createRole" class="btn btn-success text-center btn-sm"
                                            wire:loading.attr="disabled">
                                        {{__('public.save')}}
                                        <div class="spinner-border text-white spinner-border-sm" role="status"
                                             wire:loading wire:target="createRole">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
