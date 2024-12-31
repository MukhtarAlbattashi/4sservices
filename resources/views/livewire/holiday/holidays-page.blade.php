<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.holidays") }} - {{$holidays->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_HOLIDAYS)
                            <a class="btn btn-dark m-2" href="{{route('holiday-create')}}">
                                {{ __('public.add') }} {{ __('public.holidays') }}
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
                            <td>{{ __("public.contractName") }}</td>
                            <td>{{ __("public.employeeName") }}</td>
                            <td>{{ __("public.sectionName") }}</td>
                            <td>{{ __("public.numberOfDays") }}</td>
                            <td>{{ __("public.fromDate") }}</td>
                            <td>{{ __("public.toDate") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($holidays as $holiday)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$holiday->name}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $holiday->employeeInfo->employeeNameAr : $holiday->employeeInfo->employeeNameEn}}
                                        <br>
                                        <a class="text-primary text-decoration-none"
                                           href="https://wa.me/{{$holiday->employeeInfo->phone}}">{{$holiday->employeeInfo->phone}}</a>
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $holiday->category->arName : $holiday->category->enName}}
                                    </td>
                                    <td>
                                        {{$holiday->amount}}
                                    </td>
                                    <td>
                                        {{$holiday->fromDate}}
                                    </td>
                                    <td>
                                        {{$holiday->toDate}}
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($holiday->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_HOLIDAYS)
                                            <a href="{{route('edit-holiday',$holiday)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_HOLIDAYS)
                                            <button
                                                wire:click="remove({{$holiday->id}})"
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
                {{ $holidays->links() }}
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
