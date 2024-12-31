<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.assets") }} - {{$incomes->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_ASSETS)
                            <button class="btn btn-dark m-2 m-2" wire:click="add"
                            >
                                {{ __('public.add') }} {{ __("public.assets") }}
                            </button>
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
                            <td>{{ __("public.code") }}</td>
                            <td>{{ __("public.mainCategory") }}</td>
                            <td>{{ __("public.subCategory") }}</td>
                            <td>{{ __("public.amount") }} <br> OMR</td>
                            <td>{{ __("public.rate") }}</td>
                            <td>{{ __("public.date") }}</td>
                            <td>{{ __("public.attached") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($incomes as $income)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$income->name}}</td>
                                    <td>{{$income->code}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $income->category->arName : $income->category->enName}}
                                    </td>
                                    <td>{{app()->getLocale()=='ar' ? $income->subCategory->arName :
                                    $income->subCategory->enName}}</td>
                                    <td>{{number_format($income->amount,3)}}</td>
                                    <td>{{$income->rate}}</td>
                                    <td>{{$income->date}}</td>
                                    <td>
                                        @if($income->attach)
                                            <a href="{{asset($income->attach)}}" target="_blank"
                                               class="btn text-info">
                                        <span class="fas fa-file"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($income->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_ASSETS)
                                            <button
                                                wire:click="update({{$income->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_ASSETS)
                                            <button
                                                wire:click="remove({{$income->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$income->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $incomes->links() }}
            </div>
        </div>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="category" class="form-label mt-2">{{
                                        __("public.mainCategory")}}*</label>
                        <select name="category" wire:model="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="subCategory" class="form-label mt-2">{{
                                        __("public.subCategory")}}*</label>
                        <select name="subCategory" wire:model.defer="subCategory" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getSubCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('subCategory') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label mt-2">{{ __("public.name")}}*</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name" required>
                        @error('name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="supplier" class="form-label mt-2">{{ __("public.supplier")}}</label>
                        <input wire:model.defer="supplier" type="text" class="form-control" id="supplier"
                               required>
                        @error('supplier') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model.defer="amount" type="number" class="form-control text-center"
                               id="amount" required>
                        @error('amount') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label mt-2">{{ __("public.date")}}*</label>
                        <input wire:model.defer="date" type="date" class="form-control text-center"
                               id="date" required>
                        @error('date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control" id="attach">
                        @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2" wire:loading wire:target="attach">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12">
                        <label for="rate" class="form-label mt-2">{{ __("public.rate")}}*</label>
                        <input wire:model.defer="rate" type="text" class="form-control" id="rate" required>
                        @error('rate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note")}}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control" id="notes"
                                  required></textarea>
                        @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
                    </div>
                </div>
            </div>
        </x-modal>

        <x-modal id="dangerModal" title="public.delete" background="bg-danger">
            <div class="text-center">
                {{__('public.sure')}}
                <br>
                <button class="btn btn-danger text-white" wire:click="delete"
                        type="button">{{__('public.delete')}}</button>
            </div>
        </x-modal>

        <x-modal id="editModal" title="public.add" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="category" class="form-label mt-2">{{
                                        __("public.mainCategory")}}*</label>
                        <select name="category" wire:model="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="subCategory" class="form-label mt-2">{{
                                        __("public.subCategory")}}*</label>
                        <select name="subCategory" wire:model.defer="subCategory" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getSubCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('subCategory') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label mt-2">{{ __("public.name")}}*</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name" required>
                        @error('name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="supplier" class="form-label mt-2">{{ __("public.supplier")}}</label>
                        <input wire:model.defer="supplier" type="text" class="form-control" id="supplier"
                               required>
                        @error('supplier') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model.defer="amount" type="number" class="form-control text-center"
                               id="amount" required>
                        @error('amount') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label mt-2">{{ __("public.date")}}*</label>
                        <input wire:model.defer="date" type="date" class="form-control text-center"
                               id="date" required>
                        @error('date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control" id="attach">
                        @error('attach') <span class="error text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2" wire:loading wire:target="attach">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-12">
                        <label for="rate" class="form-label mt-2">{{ __("public.rate")}}*</label>
                        <input wire:model.defer="rate" type="text" class="form-control" id="rate" required>
                        @error('rate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note")}}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control" id="notes"
                                  required></textarea>
                        @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success"
                                wire:click="saveUpdate">{{__('public.save')}}</button>
                    </div>
                </div>
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
