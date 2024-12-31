<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.contracts") }} - {{$contracts->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_CONTRACTS)
                            <a class="btn btn-dark m-2 m-2" href="{{route('contract-create')}}">
                                {{ __('public.add') }} {{ __('public.contracts') }}
                            </a>
                        @endcan
                        <div class="form-check mt-2">
                            <input wire:model="validOnly" class="form-check-input" type="checkbox" value=""
                                   id="validOnly">
                            <label class="form-check-label" for="validOnly">
                                {{__('public.validOnly')}}
                            </label>
                        </div>
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
                            <td>{{ __("public.startDateContract") }}</td>
                            <td>{{ __("public.endDateContract") }}</td>
                            <td>{{ __("public.jobName") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($contracts as $contract)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$contract->contractName}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $contract->employee->employeeNameAr : $contract->employee->employeeNameEn}}
                                        <br>
                                        <a class="text-primary text-decoration-none"
                                           href="https://wa.me/{{$contract->employee->phone}}">{{$contract->employee->phone}}</a>
                                    </td>
                                    <td>
                                        {{$contract->startDateContract}}
                                    </td>
                                    <td>
                                        {{$contract->endDateContract}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $contract->jobNameAr : $contract->jobNameAr}}
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($contract->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_CONTRACTS)
                                            <a href="{{route('view-contract',$contract)}}"
                                               class="btn btn-outline-dark btn-sm rounded-3">
                                                <span class="fas fa-eye"></span>
                                                {{__('public.view')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_CONTRACTS)
                                            <a href="{{route('edit-contract',$contract)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_CONTRACTS)
                                            <button
                                                wire:click="remove({{$contract->id}})"
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
                {{ $contracts->links() }}
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
