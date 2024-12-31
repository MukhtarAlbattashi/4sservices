<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.discounts") }} - {{$discounts->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_DISCOUNTS)
                            <a class="btn btn-dark m-2" href="{{route('discount-create')}}">
                                {{ __('public.add') }} {{ __('public.discounts') }}
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
                            @foreach($discounts as $discount)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$discount->name}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $discount->employeeInfo->employeeNameAr : $discount->employeeInfo->employeeNameEn}}
                                        <br>
                                        <a class="text-primary text-decoration-none"
                                           href="https://wa.me/{{$discount->employeeInfo->phone}}">{{$discount->employeeInfo->phone}}</a>
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $discount->category->arName : $discount->category->enName}}
                                    </td>
                                    <td>
                                        {{number_format($discount->amount,3)}}
                                    </td>
                                    <td>
                                        {{$discount->date}}
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($discount->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_DISCOUNTS)
                                            <a href="{{route('edit-discount',$discount)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_DISCOUNTS)
                                            <button
                                                wire:click="remove({{$discount->id}})"
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
                {{ $discounts->links() }}
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
