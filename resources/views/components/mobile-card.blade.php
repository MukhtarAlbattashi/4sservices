<div {{ $attributes->class(['col-sm-12 col-md-6']) }}>
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4>
                 {{$customer->name}}
            </h4>
        </div>
        <div class="card-body text-secondary">
            <div class="card-text d-flex flex-wrap gap-4">
                <div class="container p-0 m-0">
                    <div
                        class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 d-flex justify-content-between m-0">
                                                            <span class="dark-card">
                                                                {{$customer->phone}}
                                                            </span>
                            <span class="info-card">
                                                                {{$customer->created_at->diffForHumans()}}
                                                            </span>
                        </div>
                        <div class="col-12 text-center">
                                                                <span class="fas fa-user-circle"
                                                                      style="font-size: 50pt;"></span>
                        </div>
                        <div class="col-12 text-center my-2">
                            @if($customer->phone)
                                <a class="btn btn-success btn-sm"
                                   href="https://wa.me/{{$customer->phone}}">
                                                                <span
                                                                    class="fab fa-whatsapp"></span> whatsapp
                                </a>
                            @endif
                            @if($customer->email)
                                <a class="btn btn-dark rounded-3 btn-sm"
                                   href="mailto:{{$customer->email}}">
                                                                <span
                                                                    class="fab fa-at"></span> Email
                                </a>
                            @endif

                        </div>
                        <div class="col-6 text-center">
                                                        <span class="dark-card">
                                                            {{ $customer->cars_count }}
                                                            {{ __("public.cars") }}
                                                        </span>
                        </div>
                        <div class="col-6 text-center">

                                                        <span class="dark-card">
                                                            {{ $customer->invoices_count }}
                                                            {{ __("public.invoice") }}
                                                        </span>

                        </div>
                    </div>
                </div>
                <div
                    class="d-flex justify-content-around w-100 flex-wrap gap-1">
                                                    <span @class([
                                                            'warning-card' => ($customer->invoices_sum_total ) > 0,
                                                            'dark-card' => ($customer->invoices_sum_total ) == 0,
                                                            'danger-card' => ($customer->invoices_sum_total ) < 0,
                                                            ])>
                                                            {{number_format($customer->invoices_sum_total,3)}}
                                                        {{ __("public.totalAmount") }}
                                                </span>
                    <span @class([
                                                            'success-card' => ($customer->payments_sum_amount ) > 0,
                                                            'dark-card' => ($customer->payments_sum_amount ) == 0,
                                                            'danger-card' => ($customer->payments_sum_amount ) < 0,
                                                            ])>
                                                            {{number_format($customer->payments_sum_amount,3)}}
                        {{ __("public.paid") }}
                                                </span>
                    <span @class([
                                                            'success-card' => ($customer->remaining_payments ) < 0,
                                                            'dark-card' => ($customer->remaining_payments ) == 0,
                                                            'danger-card' => ($customer->remaining_payments ) > 0,
                                                            ])>
                                                             {{number_format(($customer->remaining_payments),3)}}
                        {{ __("public.restAmount") }}
                                                </span>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            @can(\App\Enums\AppPermissions::CAN_CREATE_CARS)
                                                <button
                                                    wire:click="createNewCarForCustomer({{$customer->id}})"
                                                    class="btn btn-outline-dark btn-sm rounded-3">
                                                    <span class="fas fa-car"></span>
                                                    {{__('public.addNewCar')}}
                                                </button>
                                            @endcan
            @can(\App\Enums\AppPermissions::CAN_EDIT_CUSTOMERS)
                <button
                    wire:click="update({{$customer->id}})"
                    class="btn btn-outline-primary btn-sm rounded-3 fs-6">
                    <span class="fas fa-edit"></span>
                    {{__('public.edit')}}
                </button>
            @endcan
            @can(\App\Enums\AppPermissions::CAN_DELETE_CUSTOMERS)
                <button
                    x-data
                    @click="$wire.set('customerId', {{$customer->id}}, true); $dispatch('show-delete-model')"
                    class="btn btn-outline-danger btn-sm rounded-3 fs-6">
                    <span class="fas fa-trash"></span>
                    {{__('public.delete')}}
                </button>
            @endcan
        </div>
    </div>
</div>
