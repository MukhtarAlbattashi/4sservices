<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.jopCards") }} - {{$jobs->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_SHOW_CARS)
                            <a href="{{route('add-job-card-to-car')}}" class="btn btn-dark m-2 m-2">
                                {{ __('public.add') }} {{ __('public.jobCard') }}
                            </a>
                        @endcan
                    </div>
                    <div class="col-md-6 d-flex justify-content-between">
                        <div class="row">
                            <div class="col-sm-12">
                                <button wire:key="all"
                                        class="btn btn-dark m-2 m-2 text-white" onclick="window.location.reload()">
                                    {{__('public.all')}}
                                    - {{$total}}
                                </button>
                                @foreach($jobStatus as $status)
                                    <button wire:key="{{$status->id}}" wire:click="filterJobCards({{$status->id}})"
                                            class="btn text-white"
                                            style="background-color: {{$status->color}}">
                                        {{app()->getLocale() == 'ar' ? $status->arName : $status->enName}}
                                        - {{$status->cards_count}}
                                    </button>
                                @endforeach
                                <button wire:key="late"
                                        class="btn btn-outline-danger" wire:click="filterLateJobCards">
                                    {{__('public.late')}}
                                    - {{$late}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table table-bordered table-sm">
                            <thead class="text-center align-middle">
                            <tr>
                                <th class="text-primary bg-body-tertiary">#</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.number") }} {{ __("public.jopCards") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.customerName") }} <br>{{__('public.customerPhone')}}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.carType") }} <br>{{__('public.carModel')}}
                                    <br>{{__('public.registration-type')}}
                                </th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.dateEntry") }} <br>{{ __("public.timeEntry") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.vehicleNumber") }} <br>{{ __("public.carColor") }} <br>{{
                                    __("public.manufacturingYear") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.entryCounterNumber") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.dateExit") }} <br>{{ __("public.timeExit") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.exitCounterNumber") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.jopCardsStatus") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.createdAt") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.user") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.action") }}</th>
                            </tr>
                            </thead>
                            @foreach($jobs as $job)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$job->id}}
                                    </td>
                                    <td>{{$job->customer->name}} <br>{{$job->customer->phone}}</td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $job->car->brand->arName : $job->car->brand->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $job->car->model->arName : $job->car->model->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $job->car->type->arName : $job->car->type->enName}}
                                    </td>
                                    <td>{{$job->dateEntry}} <br>{{$job->timeEntry}}</td>
                                    <td>{{$job->car->number}} <br>{{$job->car->color}} <br>{{$job->car->year}}</td>
                                    <td>{{$job->entryCounterNumber}}</td>
                                    <td>{{$job->dateExit}} <br>{{$job->timeExit}}</td>
                                    <td>{{$job->exitCounterNumber}}</td>
                                    <td>
                                        <span class="badge rounded-3 fs-6"
                                              style="background-color: {{$job->status->color}}">
                                            {{app()->getLocale()=='ar' ? $job->status->arName : $job->status->enName}}
                                        </span>
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($job->created_at))}}
                                        <br>
                                        @if($job->dateEntry <= now()->subDays(7) && !($job->status->arName === 'تم الانتهاء' || $job->status->arName === 'Done'))
                                            <span class="badge rounded-3 fs-6 badge-danger">
                                                {{__('public.late')}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="dark-card">
                                        {{$job->user->name ?? trans('public.not-available')}}
                                        </span>
                                    </td>
                                    @if($job->trashed())
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <span class="danger-card">
                                               {{__('public.deletedBy')}} {{$job->user->name ?? trans('public.not-available')}}
                                            </span>
                                                <button class="btn btn-success btn-sm rounded-3" wire:click="restore({{$job->id}})">
                                                    {{__('public.restore')}}
                                                </button>
                                                <button class="btn btn-danger btn-sm rounded-3" wire:click="forceDelete({{$job->id}})">
                                                    {{__('public.delete')}}
                                                </button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            @can(\App\Enums\AppPermissions::CAN_CREATE_INVOICES)
                                                <x-button-component
                                                    wireClick="viewInvoice({{$job->id}})"
                                                    classes="btn btn-outline-success btn-sm rounded-3 mb-2"
                                                    icon="file-invoice-dollar"
                                                    text="public.theInvoice"
                                                />
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_SHOW_JOB_CARDS)
                                                <x-link-component
                                                    route="view-jop-card"
                                                    :params="[$job->car,$job]"
                                                    classes="btn btn-outline-dark btn-sm rounded-3 mb-2"
                                                    icon="eye" text="public.view"/>
                                            @endcan
                                            <br>
                                            @can(\App\Enums\AppPermissions::CAN_SHOW_JOB_CARDS)
                                                <x-link-component
                                                    route="print-jop-card"
                                                    :params="[$job->car,$job]"
                                                    classes="btn btn-outline-secondary btn-sm rounded-3 mb-2"
                                                    icon="print"
                                                    text="public.print"
                                                />
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_EDIT_JOB_CARDS)
                                                <x-link-component
                                                    route="edit-jop-card"
                                                    :params="[$job->car,$job]"
                                                    classes="btn btn-outline-primary btn-sm rounded-3 mb-2"
                                                    icon="edit"
                                                    text="public.edit"
                                                />
                                            @endcan
                                            <br>
                                            @can(\App\Enums\AppPermissions::CAN_DELETE_JOB_CARDS)
                                                <x-button-component
                                                    wireClick="remove({{$job->id}})"
                                                    classes="btn btn-outline-danger btn-sm rounded-3"
                                                    icon="trash"
                                                    text="public.delete"
                                                    dataBsToggle="modal"
                                                    dataBsTarget="#dangerModal"
                                                />
                                            @endcan
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $jobs->links() }}
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
