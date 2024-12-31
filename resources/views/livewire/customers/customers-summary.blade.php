<div>
    <div class="container-fluid px-5">
        <a href="{{route('customers')}}" class="btn btn-dark mb-4">
            {{__("public.customers")}}
            <span class="fas fa-arrow-rotate-back"></span>
        </a>
        <div class="row mb-3 g-3">
            <div class="col-md-6">
                <x-link-card backColor="rgba(106, 176, 76,0.5)"
                             title="{{__('public.customersWithFullPayments')}}"
                             subtitle="{{$customersWithFullPaymentsCount}}">
                    <button wire:click="showCustomersWithFullPayments"
                            class="w-50 text-center btn btn-sm"
                            style="background-color: rgba(106, 176, 76,0.5);">
                        {{__('public.view')}}
                    </button>
                </x-link-card>
            </div>
            <div class="col-md-6">
                <x-link-card backColor="rgba(235, 77, 75,0.5)"
                             title="{{__('public.customersWithRemainingPayments')}}"
                             subtitle="{{$customersWithRemainingPaymentsCount}}">
                    <button wire:click="showCustomersWithRemainingPayments"
                            class="w-50 text-center btn btn-sm"
                            style="background-color: rgba(235, 77, 75,0.5);">
                        {{__('public.view')}}
                    </button>
                </x-link-card>
            </div>
        </div>
        <div class="row mb-3 g-3">
            <div class="col-md-12">
                @if($customers->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="d-none d-lg-table">
                                    <div class="table-responsive">
                                        <table class="table  table-bordered table-sm">
                                            <thead class="text-center text-danger align-middle bg-light">
                                            <tr>
                                                @foreach(['#', 'public.customerName', 'public.customerPhone', 'public.customerEmail', 'public.numberOfCars', 'public.numberInvoices', 'public.totalAmount', 'public.paid', 'public.restAmount', 'public.createdAt', 'public.action'] as $string)
                                                    <th>{{__($string)}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($customers as $customer)
                                                <tr class="text-center table-font align-middle">
                                                    <td>
                                                        {{$customers->firstItem()+$loop->index}}
                                                    </td>
                                                    <td>
                                                        {{$customer->name}}
                                                    </td>
                                                    <td>
                                                        <a class="text-decoration-none text-primary"
                                                           href="https://wa.me/{{$customer->phone}}">
                                                            {{$customer->phone}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="text-decoration-none text-primary"
                                                           href="mailto:{{$customer->email}}">{{$customer->email}}
                                                        </a>
                                                    </td>
                                                    <td>
                                            <span class="dark-card">
                                                {{ $customer->cars_count }}
                                                {{ __("public.cars") }}
                                            </span>
                                                    </td>
                                                    <td>
                                            <span class="dark-card">
                                                {{ $customer->invoices_count }}
                                                {{ __("public.invoice") }}
                                            </span>
                                                    </td>
                                                    <td>
                                                        <x-text-with-background
                                                            :number="$customer->invoices_sum_total"
                                                            state="invoices_sum_total"/>
                                                    </td>
                                                    <td>
                                                        <x-text-with-background
                                                            :number="$customer->payments_sum_amount"
                                                            state="payments_sum_amount"/>
                                                    </td>
                                                    <td>
                                                        <x-text-with-background
                                                            :number="$customer->remaining_payments"
                                                            state="remaining_payments"/>
                                                    </td>
                                                    <td>
                                            <span class="dark-card">
                                                {{$customer->created_at->diffForHumans()}}
                                            </span>
                                                    </td>
                                                    <td class="d-flex justify-content-center gap-3">
                                                        @can(\App\Enums\AppPermissions::CAN_EDIT_CUSTOMERS)
                                                            <button
                                                                wire:click="update({{$customer->id}})"
                                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                                <span class="fas fa-edit"></span>
                                                                {{__('public.edit')}}
                                                            </button>
                                                        @endcan
                                                        @can(\App\Enums\AppPermissions::CAN_DELETE_CUSTOMERS)
                                                            <button
                                                                x-data
                                                                @click="$wire.set('customerId', {{$customer->id}}, true); $dispatch('show-delete-model')"
                                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                                <span class="fas fa-trash"></span>
                                                                {{__('public.delete')}}
                                                            </button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="11">
                                                        <h6 class="text-center text-danger">{{__('public.noData')}}</h6>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="d-lg-none">
                                    <div class="container-fluid mt-3 p-0 m-0">
                                        <div class="row">
                                            @foreach($customers as $customer)
                                                <x-mobile-card :customer="$customer"/>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            {{ $customers->links() }}
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">{{__('public.noData')}}</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
