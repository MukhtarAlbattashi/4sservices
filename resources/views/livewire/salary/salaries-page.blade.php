<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.salaries") }} - {{$salaries->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_SALARIES)
                            <a class="btn btn-dark m-2" href="{{route('salary-create')}}">
                                {{ __('public.add') }} {{ __('public.salaries') }}
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
                            <td>{{ __("public.amount") }}</td>
                            <td>{{ __("public.date") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            </thead>
                            @foreach($salaries as $salary)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$salary->name}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $salary->employee->employeeNameAr : $salary->employee->employeeNameEn}}
                                        <br>
                                        <a class="text-primary text-decoration-none"
                                           href="https://wa.me/{{$salary->employee->phone}}">{{$salary->employee->phone}}</a>
                                    </td>
                                    <td>
                                        {{number_format($salary->amount, 3)}}
                                    </td>
                                    <td>
                                        {{$salary->date}}
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($salary->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_SALARIES)
                                            <a href="{{route('edit-salary',$salary)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_SALARIES)
                                            <button
                                                wire:click="remove({{$salary->id}})"
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
                {{ $salaries->links() }}
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
