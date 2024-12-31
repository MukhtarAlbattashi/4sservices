<div>
    <div class="container-fluid px-5">
        <h3 class="text-center text-primary">{{__('public.view')}} {{__('public.jopCards')}}</h3>
        <div class="row g-1">
            <h3 class="text-danger">{{__('public.customerCarData')}}</h3>
            <div class="col-md-12">
                @livewire('invoices.car-info-page', ['car' => $car])
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">{{__('public.carEntryData')}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-bordered text-center">
                        <thead>
                        <tr class="text-success bg-light">
                            <th class="text-primary bg-body-tertiary">{{ __("public.dateEntry") }}</th>
                            <th class="text-primary bg-body-tertiary">{{ __("public.timeEntry") }}</th>
                            <th class="text-primary bg-body-tertiary">{{ __("public.whereTheCarCame") }}</th>
                            <th class="text-primary bg-body-tertiary">{{ __("public.carDriverWhereTheCarCame") }}</th>
                            <th class="text-primary bg-body-tertiary">{{ __("public.entryCounterNumber") }}</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>{{$job->dateEntry}}</td>
                            <td>{{$job->timeEntry}}</td>
                            <td>{{$job->whereTheCarCame}}</td>
                            <td>{{$job->carDriverWhereTheCarCame}}</td>
                            <td>{{$job->entryCounterNumber}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">{{__("public.carRepairPermission")}}</h3>
                    @if($job->carRepairPermission)
                        <a href="{{asset($job->carRepairPermission)}}" target="_blank"
                           class="badge rounded-3 bg-info text-decoration-none text-white">
                            {{__('public.preview')}}
                        </a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">{{__("public.entryImage")}}</h3>
                    <div class="d-flex">
                        @forelse (explode(',', $job->entryImage) as $img)
                            <a href="{{asset($img)}}" target="_blank" class="text-decoration-none text-white m-3">
                                <div
                                    style="height: 80px; width: 80px; background-size: cover; background-repeat: no-repeat; background-image: url('{{ asset($img) }}');"
                                    class="img-thumbnail rounded text-center">
                                </div>
                            </a>
                        @empty
                            <p>dklj</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4 class="text-primary">{{ __('public.paintWorks')}}</h4>
                    <p>
                        {!! nl2br(e($job->paintWorks))!!}
                    </p>
                </div>
                <div class="col-md-2">
                    <h4 class="text-primary">{{ __('public.dentingWorks')}}</h4>
                    <p>
                        {!! nl2br(e($job->dentingWorks))!!}
                    </p>
                </div>
                <div class="col-md-2">
                    <h4 class="text-primary">{{ __('public.electricalWorks')}}</h4>
                    <p>
                        {!! nl2br(e($job->electricalWorks))!!}
                    </p>
                </div>
                <div class="col-md-2">
                    <h4 class="text-primary">{{ __('public.mechanicWorks')}}</h4>
                    <p>
                        {!! nl2br(e($job->mechanicWorks))!!}
                    </p>
                </div>
                <div class="col-md-2">
                    <h4 class="text-primary">{{ __('public.StatusCarOfEntry')}}</h4>
                    <p>
                        {!! nl2br(e($job->StatusCarOfEntry))!!}
                    </p>
                </div>
                <div class="col-md-2">
                    <h4 class="text-primary">{{ __('public.StatusCarOfExit')}}</h4>
                    <p>
                        {!! nl2br(e($job->StatusCarOfExit))!!}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">{{__('public.carExitData')}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-responsive table-bordered text-center">
                        <tr class=" text-success bg-light">
                            <td>{{ __("public.dateExit") }}</td>
                            <td>{{ __("public.timeExit") }}</td>
                            <td>{{ __("public.departureDestination") }}</td>
                            <td>{{ __("public.carDriverDeparture") }}</td>
                            <td>{{ __("public.exitCounterNumber") }}</td>
                        </tr>
                        <tr>
                            <td>{{$job->dateExit}}</td>
                            <td>{{$job->timeExit}}</td>
                            <td>{{$job->departureDestination}}</td>
                            <td>{{$job->carDriverDeparture}}</td>
                            <td>{{$job->exitCounterNumber}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">{{__("public.carExitData")}}</h3>
                    <div class="d-flex">
                        @forelse (explode(',', $job->exitImage) as $img)
                            <a href="{{asset($img)}}" target="_blank" class="text-decoration-none text-white m-3">
                                <div
                                    style="height: 80px; width: 80px; background-size: cover; background-repeat: no-repeat; background-image: url('{{ asset($img) }}');"
                                    class="img-thumbnail rounded text-center">
                                </div>
                            </a>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
