<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{__('public.add')}} {{__('public.jopCards')}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search" />
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.customerName") }} <br>{{__('public.customerPhone')}}</td>
                            <td>{{ __("public.carType") }} <br>{{__('public.carModel')}}
                                <br>{{__('public.registration-type')}}
                            </td>
                            <td>
                                {{ __("public.owner") }} <br>
                                {{ __("public.ownerID") }}
                            </td>
                            <td>{{ __("public.vehicleNumber") }} <br>{{ __("public.carColor") }} <br>{{
                                    __("public.manufacturingYear") }}</td>
                            <td>{{ __("public.chassisNo") }}</td>
                            <td>{{ __("public.cylindersNo") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.numberInvoices") }}</td>
                            <td>{{ __("public.totalAmount") }} <br> OMR</td>
                            <td>{{ __("public.paid") }} <br> OMR</td>
                            <td>{{ __("public.restAmount") }} <br> OMR</td>
                            <td>{{ __("public.attached") }} 1</td>
                            <td>{{ __("public.attached") }} 2</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.user") }}</td>
                            <td>{{ __("public.note") }}</td>
                            </thead>
                            @foreach($cars as $car)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$car->customer->name}} <br>{{$car->customer->phone}}</td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $car->brand->arName : $car->brand->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $car->model->arName : $car->model->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $car->type->arName : $car->type->enName}}
                                    </td>
                                    <td>{{$car->owner}} <br>{{$car->owner_id}}</td>
                                    <td>{{$car->number}} {{$car->letter}} <br>{{$car->color}} <br>{{$car->year}}</td>
                                    <td class="text-uppercase">{{$car->chassis}}</td>
                                    <td>{{$car->cylinders}}</td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_CREATE_JOB_CARDS)
                                            <a href="{{route('add-jop-card',$car)}}"
                                               class="btn btn-dark m-2 btn-sm text-white m-1 px-4">{{__('public.jopCardNo')}}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        {{$car->invoices_count}}
                                    </td>
                                    <td>
                                        {{number_format($car->invoices_sum_total,3)}}
                                    </td>
                                    <td>
                                        {{number_format($car->payments_sum_amount,3)}}
                                    </td>
                                    <td>
                                        {{number_format(($car->invoices_sum_total-$car->payments_sum_amount),3)}}
                                    </td>
                                    <td>
                                        @if($car->attach)
                                            <a href="{{asset($car->attach)}}" target="_blank"
                                               class="btn text-info">
                                        <span class="fas fa-file"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($car->other)
                                            <a href="{{asset($car->other)}}" target="_blank"
                                               class="btn text-info">
                                        <span class="fas fa-file"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($car->created_at))}}
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$car->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                    <td>
                                        {{$car->notes}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $cars->links() }}
            </div>
        </div>

    </div>
    <script>
        function validateNumberInput(input) {
            var inputValue = input.value;
            var numbers = /^\d{0,4}$/;

            if (!inputValue.match(numbers)) {
                input.value = inputValue.slice(0, 4);
            }
        }

        $(document).ready(function () {
            $('.chassis').keypress(function (event) {
                var char = String.fromCharCode(event.which);
                if (!(/[a-zA-Z0-9]/.test(char))) {
                    event.preventDefault();
                    return false;
                }
            });
        });
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
