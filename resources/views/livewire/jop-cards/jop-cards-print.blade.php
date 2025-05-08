<div>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{asset("images/banner.png")}}" alt="banner" width="100%">
                <h3 class="text-center">{{$job->id}}</h3>
            </div>
            <h3 class="text-danger">{{__('public.customerCarData')}}</h3>
            <div class="col-md-12">
                @livewire('invoices.car-info-page', ['car' => $car])
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-danger">{{__('public.carEntryData')}}</h3>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-responsive table-bordered text-center">
                    <tr class=" text-success bg-light">
                        <td>{{ __("public.dateEntry") }}</td>
                        <td>{{ __("public.timeEntry") }}</td>
                        <td>{{ __("public.whereTheCarCame") }}</td>
                        <td>{{ __("public.carDriverWhereTheCarCame") }}</td>
                        <td>{{ __("public.entryCounterNumber") }}</td>
                    </tr>
                    <tr>
                        <td>{{$job->dateEntry}}</td>
                        <td>{{$job->timeEntry}}</td>
                        <td>{{$job->whereTheCarCame}}</td>
                        <td>{{$job->carDriverWhereTheCarCame}}</td>
                        <td>{{$job->entryCounterNumber}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-10">
                <div class="d-flex">
                    <img src="{{asset('images/car.jpg')}}" alt="" class="img-fluid" width="150">
                    <table class="table table-bordered text-center">
                        <tr class=" text-success bg-light">
                            <td>
                                <h5 class="text-primary ">{{ __('public.paintWorks')}}</h5>
                            </td>
                            <td>
                                <h5 class="text-primary ">{{ __('public.dentingWorks')}}</h5>
                            </td>
                            <td>
                                <h5 class="text-primary ">{{ __('public.electricalWorks')}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>
                                    {!! nl2br(e($job->paintWorks))!!}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {!! nl2br(e($job->dentingWorks))!!}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {!! nl2br(e($job->electricalWorks))!!}
                                </span>
                            </td>
                        </tr>
                        <tr class=" text-success bg-light">
                            <td>
                                <h5 class="text-primary ">{{ __('public.mechanicWorks')}}</h5>
                            </td>
                            <td>
                                <h5 class="text-primary ">{{ __('public.StatusCarOfEntry')}}</h5>
                            </td>
                            <td>
                                <h5 class="text-primary ">{{ __('public.StatusCarOfExit')}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>
                                    {!! nl2br(e($job->mechanicWorks))!!}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {!! nl2br(e($job->StatusCarOfEntry))!!}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {!! nl2br(e($job->StatusCarOfExit))!!}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <h3 class="text-danger">{{__('public.carExitData')}}</h3>
            </div>
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
            <div class="col-md-12">
                <div class="float-right m-1">
                    <a id="printPageButton" href="javascript:window.print()" class="btn btn-dark m-2 waves-effect waves-light"><i class="fa fa-print"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
