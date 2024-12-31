<div>
    <div class="container-fluid px-5">
        <div wire:loading.flex wire:target="save">
            <div class="loader">
                <div class="spinner"></div>
            </div>
        </div>
        <h3 class="text-center text-primary">{{__('public.add')}} {{__('public.jopCards')}}</h3>
        <div class="row g-1">
            <h3 class="text-danger">{{__('public.customerCarData')}}</h3>
            <div class="col-md-12">
                @livewire('invoices.car-info-page', ['car' => $car])
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-danger">{{__('public.carEntryData')}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="category" class="form-label mt-2">{{ __("public.jobCardStatus")}}*</label>
                            <select name="category" wire:model="category" class="form-select">
                                @foreach($this->getCategories() as $id => $name)
                                <option value="{{ $id }}" {{$loop->index == 0 ? 'selected' : ''}}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('category') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="dateEntry" class="form-label mt-2">{{ __("public.dateEntry")}}*</label>
                            <input wire:model.defer="dateEntry" type="date" class="form-control text-center"
                                id="dateEntry" required>
                            @error('dateEntry') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="timeEntry" class="form-label mt-2">{{ __("public.timeEntry")}}*</label>
                            <input wire:model.defer="timeEntry" type="time" class="form-control text-center"
                                id="timeEntry" required>
                            @error('timeEntry') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="whereTheCarCame" class="form-label mt-2">{{
                                __("public.whereTheCarCame")}}*</label>
                            <select wire:model.defer="whereTheCarCame" id="whereTheCarCame" class="form-select"
                                aria-label="Car Colors">
                                <option value="خصوصي / private">خصوصي / private</option>
                                <option value="حكومي / government">حكومي / government</option>
                                <option value="شركة / company">شركة / company</option>
                                <option value="شركة تأمين / insurance Company">شركة تأمين / insurance Company</option>
                            </select>
                            @error('whereTheCarCame') <span class="error text-danger fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="carDriverWhereTheCarCame" class="form-label mt-2">{{
                                __("public.carDriverWhereTheCarCame")}}*</label>
                            <input wire:model.defer="carDriverWhereTheCarCame"
                                placeholder="{{ __('public.carDriverWhereTheCarCame')}}" type="text"
                                class="form-control text-center" id="carDriverWhereTheCarCame" required>
                            @error('carDriverWhereTheCarCame') <span class="error text-danger fs-6">{{ $message
                                }}</span> @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="entryCounterNumber" class="form-label mt-2">{{
                                __("public.entryCounterNumber")}}*</label>
                            <input wire:model.defer="entryCounterNumber"
                                placeholder="{{ __('public.entryCounterNumber')}}" type="text"
                                class="form-control text-center" id="entryCounterNumber" required>
                            @error('entryCounterNumber') <span class="error text-danger fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="carRepairPermission" class="form-label mt-2">{{
                                __("public.carRepairPermission")}}*</label>
                            <input wire:model.defer="carRepairPermission"
                                placeholder="{{ __('public.carRepairPermission')}}" type="file"
                                class="form-control text-center" id="carRepairPermission" required>
                            @error('carRepairPermission') <span class="error text-danger fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="entryImage" class="form-label mt-2">{{ __("public.entryImage")}}*</label>
                            <input wire:model="entryImage" placeholder="{{ __('public.entryImage')}}" type="file"
                                class="form-control text-center" id="entryImage" required multiple accept="image/*">
                            @error('entryImage.*') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 m-3 d-flex g-1">
                            @foreach($entryImage as $index => $img)
                            <div class="text-center m-1" wire:key="{{$index}}">
                                <div style="height: 80px; width: 80px; background-size: cover; background-repeat: no-repeat; background-image: url('{{ $img->temporaryUrl() }}');"
                                    class="img-thumbnail rounded text-center">
                                </div>
                                <a href="#0" class="text-danger" wire:click="removeEntryImage('{{$index}}')"><span
                                        class="fas fa-trash"></span></a>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="paintWorks" class="form-label mt-2">{{ __("public.paintWorks")}}*</label>
                                <textarea wire:model.defer="paintWorks" placeholder="{{ __('public.paintWorks')}}"
                                    type="text" class="form-control" id="paintWorks" rows="5" required></textarea>
                                @error('paintWorks') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="dentingWorks" class="form-label mt-2">{{
                                    __("public.dentingWorks")}}*</label>
                                <textarea wire:model.defer="dentingWorks" placeholder="{{ __('public.dentingWorks')}}"
                                    type="text" class="form-control" id="dentingWorks" rows="5" required></textarea>
                                @error('dentingWorks') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="electricalWorks" class="form-label mt-2">{{
                                    __("public.electricalWorks")}}*</label>
                                <textarea wire:model.defer="electricalWorks"
                                    placeholder="{{ __('public.electricalWorks')}}" type="text" class="form-control"
                                    id="electricalWorks" rows="5" required></textarea>
                                @error('electricalWorks') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="mechanicWorks" class="form-label mt-2">{{
                                    __("public.mechanicWorks")}}*</label>
                                <textarea wire:model.defer="mechanicWorks" placeholder="{{ __('public.mechanicWorks')}}"
                                    type="text" class="form-control" id="mechanicWorks" rows="5" required></textarea>
                                @error('mechanicWorks') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="StatusCarOfEntry" class="form-label mt-2">{{
                                    __("public.StatusCarOfEntry")}}*</label>
                                <textarea wire:model.defer="StatusCarOfEntry"
                                    placeholder="{{ __('public.StatusCarOfEntry')}}" type="text" class="form-control"
                                    id="StatusCarOfEntry" rows="5" required></textarea>
                                @error('StatusCarOfEntry') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="StatusCarOfExit" class="form-label mt-2">{{
                                    __("public.StatusCarOfExit")}}*</label>
                                <textarea wire:model.defer="StatusCarOfExit"
                                    placeholder="{{ __('public.StatusCarOfExit')}}" type="text" class="form-control"
                                    id="StatusCarOfExit" rows="5" required></textarea>
                                @error('StatusCarOfExit') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <h3 class="text-danger">{{__('public.carExitData')}}</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="dateExit" class="form-label mt-2">{{ __("public.dateExit")}}*</label>
                                <input wire:model.defer="dateExit" type="date" class="form-control text-center"
                                    id="dateExit" required>
                                @error('dateExit') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="timeExit" class="form-label mt-2">{{ __("public.timeExit")}}*</label>
                                <input wire:model.defer="timeExit" type="time" class="form-control text-center"
                                    id="timeExit" required>
                                @error('timeExit') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="departureDestination" class="form-label mt-2">{{
                                    __("public.departureDestination")}}*</label>
                                <input wire:model.defer="departureDestination"
                                    placeholder="{{ __('public.departureDestination')}}" type="text"
                                    class="form-control text-center" id="departureDestination" required>
                                @error('departureDestination') <span class="error text-danger fs-6">{{ $message
                                    }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="carDriverDeparture" class="form-label mt-2">{{
                                    __("public.carDriverDeparture")}}*</label>
                                <input wire:model.defer="carDriverDeparture"
                                    placeholder="{{ __('public.carDriverDeparture')}}" type="text"
                                    class="form-control text-center" id="carDriverDeparture" required>
                                @error('carDriverDeparture') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="exitCounterNumber" class="form-label mt-2">{{
                                    __("public.exitCounterNumber")}}*</label>
                                <input wire:model.defer="exitCounterNumber"
                                    placeholder="{{ __('public.exitCounterNumber')}}" type="text"
                                    class="form-control text-center" id="exitCounterNumber" required>
                                @error('exitCounterNumber') <span class="error text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="exitImage" class="form-label mt-2">{{ __("public.exitImage")}}*</label>
                                <input wire:model="exitImage" placeholder="{{ __('public.exitImage')}}" type="file"
                                    class="form-control text-center" id="exitImage" required multiple accept="image/*">
                                @error('exitImage') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12 m-3 d-flex g-1">
                                @foreach($exitImage as $index => $img)
                                <div class="text-center m-1" wire:key="exit-{{$index}}">
                                    <div style="height: 80px; width: 80px; background-size: cover; background-repeat: no-repeat; background-image: url('{{ $img->temporaryUrl() }}');"
                                        class="img-thumbnail rounded text-center">
                                    </div>
                                    <a href="#0" class="text-danger" wire:click="removeExitImage('{{$index}}')"><span
                                            class="fas fa-trash"></span></a>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-12 mt-5 text-center">
                                @can(\App\Enums\AppPermissions::CAN_CREATE_JOB_CARDS)
                                <button wire:click="save" class="btn btn-success text-white {{ $active ? 'disabled':'' }}">
                                    {{ __("public.save") }}
                                </button>
                                @endcan
                                @can(\App\Enums\AppPermissions::CAN_CREATE_INVOICES)
                                <a href="{{route('add-invoice',[$car, $cardId])}}"
                                    class="btn btn-dark m-2 text-white {{ !$active ? 'disabled':'' }}">
                                    {{__('public.addNewInvoice')}}
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
