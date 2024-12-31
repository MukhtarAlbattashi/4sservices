<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    {{__('public.paymentsInvoices')}}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @livewire('invoices.car-info-page', ['car' => $invoicePayment->car])
                    </div>
                    <hr class="bg-danger border-2 border-top border-dark">
                    <div class="col-md-12">
                        <h5 class="text-center text-danger">{{__('public.addNewPayment')}}</h5>
                    </div>
                    <div class="col-md-2">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model="amount" min="0" max="{{$remin}}" type="number"
                               class="form-control text-center" id="amount" required>
                        @error('amount') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="restAmount" class="form-label mt-2">{{ __("public.restAmount")}}*</label>
                        <input wire:model="restAmount" value="{{$restAmount}}" type="number"
                               class="form-control text-center" id="restAmount" disabled readonly>
                        @error('restAmount') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="date" class="form-label mt-2">{{ __("public.expenseDate")}}*</label>
                        <input wire:model.defer="date" type="date" class="form-control text-center" id="date" required>
                        @error('date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="payment" class="form-label mt-2">{{ __("public.paymentMethods")}}*</label>
                        <select name="payment" wire:model.defer="payment" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getPayments() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('payment') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="check" class="form-label mt-2">{{ __("public.check")}}</label>
                        <input wire:model.defer="check" type="text" class="form-control" id="check" required>
                        @error('check') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="about" class="form-label mt-2">{{ __("public.about")}}</label>
                        <input wire:model.defer="about" type="text" class="form-control" id="about" required>
                        @error('about') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3 text-center">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mx-auto">
                                @can(\App\Enums\AppPermissions::CAN_CREATE_INVOICE_PAYMENTS)
                                    <button class="btn btn-success" wire:click="save">
                                        {{__('public.save')}}
                                        <div wire:loading wire:target="save">
                                            <div class="spinner-border text-white spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </button>
                                @endcan
                            </div>
                            @if(isset($jobCardId))
                                <a class="btn btn-info text-white"
                                   href="{{route('edit-jop-card',[$carInfo, $jobCardId])}}">
                                    {{__('public.view')}} {{__('public.jobCard')}}
                                </a>
                            @else
                                <a class="btn btn-info text-white disabled"
                                   href="#">
                                    {{__('public.noJobCardForThisInvoice')}}
                                </a>
                            @endif
                        </div>
                    </div>
                    <hr class="bg-danger border-2 border-top border-dark mt-2">
                    <div>
                        <h4 class="text-center">
                            <span class="text-primary">({{__('public.totalAmount')}} :
                                {{number_format($invoicePayment->total,3)}} ) - </span>
                            <span class="text-success">({{__('public.paid')}} : {{number_format($paid,3)}} ) = </span>
                            <span class="text-danger">({{__('public.restAmount')}} :
                                {{number_format($invoicePayment->total - $paid,3)}} )</span>
                        </h4>
                    </div>
                    <hr class="bg-danger border-2 border-top border-dark mt-2">
                    <div class="col-md-12">
                        <h5 class="text-center text-danger">{{__('public.details')}} {{__('public.paymentsInvoices')}}
                        </h5>
                    </div>
                    <div class="col-md-12">
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>{{ __("public.receiptNo") }}</td>
                            <td>{{ __("public.paid") }}</td>
                            <td>{{ __("public.restAmount") }}</td>
                            <td>{{ __("public.date") }}</td>
                            <td>{{ __("public.about") }}</td>
                            <td>{{ __("public.paymentMethods") }}</td>
                            <td>{{ __("public.check") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($invoicePayment->payments as $payment)
                                <tr class=" text-center align-middle" :wire:key="{{$payment->id}}">
                                    <td>{{$payment->id}}</td>
                                    <td>{{number_format($payment->amount,3)}}</td>
                                    <td>{{number_format($payment->remine,3)}}</td>
                                    <td>{{date('Y-m-d', strtotime($payment->date))}}</td>
                                    <td>{{$payment->about}}</td>
                                    <td>{{$payment->payment->arName}} / {{$payment->payment->enName}}</td>
                                    <td>{{$payment->check}}</td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_INVOICE_PAYMENTS)
                                            <a href="{{route('invoices-print-payment',$payment->id)}}"
                                               class="btn btn-outline-secondary btn-sm rounded-3">
                                                <span class="fas fa-print"></span>
                                                {{__('public.print')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_INVOICE_PAYMENTS)
                                            <button
                                                wire:click="remove({{$payment->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>{{$payment->user->name}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
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

    <script>
        window.addEventListener('show-delete-model', event => {
            $('#dangerModal').modal('show');
        })
        window.addEventListener('hide-delete-model', event => {
            $('#dangerModal').modal('hide');
        })
    </script>

</div>
