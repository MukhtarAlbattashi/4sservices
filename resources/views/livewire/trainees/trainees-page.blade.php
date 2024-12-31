<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.trainees") }} - {{$users->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_TRAINEES)
                            <a class="btn btn-dark m-2" href="{{route('add-trianees')}}">
                                {{ __('public.add') }} {{ __('public.trainees') }}
                            </a>
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
                            <td>{{ __("public.phone") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($users as $user)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $user->traineeAr : $user->traineeEn}}
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="mailto:{{$user->email}}">{{$user->email}}</a>
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="https://wa.me/{{$user->phone}}">{{$user->phone}}</a>
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($user->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_TRAINEES)
                                            <a href="{{route('view-trianees',$user)}}"
                                               class="btn btn-outline-dark btn-sm rounded-3">
                                                <span class="fas fa-eye"></span>
                                                {{__('public.view')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_TRAINEES)
                                            <a href="{{route('edit-trianees',$user)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_TRAINEES)
                                            <button
                                                wire:click="remove({{$user->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                            {{__('public.delete')}}
                                        @endcan
                                    </td>
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
