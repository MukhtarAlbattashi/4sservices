<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.allowances") }} - {{$allowances->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_ALLOWANCES)
                            <a class="btn btn-dark m-2 m-2" href="{{route('allowance-create')}}">
                                {{ __('public.add') }} {{ __('public.allowances') }}
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
                            <td>{{ __("public.employeeName") }}</td>
                            <td>{{ __("public.sectionName") }}</td>
                            <td>{{ __("public.amount") }}</td>
                            <td>{{ __("public.date") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($allowances as $allowance)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$allowance->name}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $allowance->employeeInfo->employeeNameAr : $allowance->employeeInfo->employeeNameEn}}
                                        <br>
                                        <a class="text-primary text-decoration-none"
                                           href="https://wa.me/{{$allowance->employeeInfo->phone}}">{{$allowance->employeeInfo->phone}}</a>
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $allowance->category->arName : $allowance->category->enName}}
                                    </td>
                                    <td>
                                        {{number_format($allowance->amount, 3)}}
                                    </td>
                                    <td>
                                        {{$allowance->date}}
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($allowance->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_ALLOWANCES)
                                            <a href="{{route('edit-allowance',$allowance)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_ALLOWANCES)
                                            <button
                                                wire:click="remove({{$allowance->id}})"
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
                {{ $allowances->links() }}
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
