<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.expense") }}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_EXPENSES)
                            <button class="btn btn-dark m-2" wire:click="add"
                            >
                                {{ __('public.add') }} {{ __("public.expense") }}
                            </button>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="text-success">
                                {{__('public.monthlyExpenses')}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.expenseForHim") }}</td>
                            <td>{{ __("public.mainCategory") }}</td>
                            <td>{{ __("public.subCategory") }}</td>
                            <td>{{ __("public.amount") }} <br> OMR</td>
                            <td>{{ __("public.taxAmount") }} <br> %</td>
                            <td>{{ __("public.expenseAmountWithTax") }} <br> OMR</td>
                            <td>{{ __("public.expenseDate") }}</td>
                            <td>{{ __("public.monthly") }}</td>
                            <td>{{ __("public.attached") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @forelse($monthlyExpenses as $expense)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$expense->expense_him}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->category->arName : $expense->category->enName}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->subCategory->arName : $expense->subCategory->enName}}</td>
                                    <td>{{number_format($expense->amount,3)}}</td>
                                    <td>{{$expense->tax}}</td>
                                    <td>{{number_format($expense->amount_tax,3)}}</td>
                                    <td>{{$expense->date}}</td>
                                    <td>
                                        <span class="fas fa-check-circle text-success"></span>
                                    </td>
                                    <td>
                                        @if($expense->attach)
                                            <a href="{{asset($expense->attach)}}" target="_blank"
                                               class="btn text-info">
                                                <span class="fas fa-file"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($expense->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_EXPENSES)
                                            <button
                                                wire:click="update({{$expense->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_EXPENSES)
                                            <button
                                                wire:click="remove({{$expense->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$expense->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center">
                                        <span class="text-info-emphasis">{{__('public.noData')}}</span>
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="text-info">
                                {{__('public.currentMonthExpenses')}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.expenseForHim") }}</td>
                            <td>{{ __("public.mainCategory") }}</td>
                            <td>{{ __("public.subCategory") }}</td>
                            <td>{{ __("public.amount") }} <br> OMR</td>
                            <td>{{ __("public.taxAmount") }} <br> %</td>
                            <td>{{ __("public.expenseAmountWithTax") }} <br> OMR</td>
                            <td>{{ __("public.expenseDate") }}</td>
                            <td>{{ __("public.monthly") }}</td>
                            <td>{{ __("public.attached") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @forelse($currentMonth as $expense)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$expense->expense_him}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->category->arName : $expense->category->enName}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->subCategory->arName : $expense->subCategory->enName}}</td>
                                    <td>{{number_format($expense->amount,3)}}</td>
                                    <td>{{$expense->tax}}</td>
                                    <td>{{number_format($expense->amount_tax,3)}}</td>
                                    <td>{{$expense->date}}</td>
                                    <td>
                                        <span class="fas fa-times-circle text-danger"></span>
                                    </td>
                                    <td>
                                        @if($expense->attach)
                                            <a href="{{asset($expense->attach)}}" target="_blank"
                                               class="btn text-info">
                                                <span class="fas fa-file"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($expense->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_EXPENSES)
                                            <button
                                                wire:click="update({{$expense->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_EXPENSES)
                                            <button
                                                wire:click="remove({{$expense->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$expense->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center">
                                        <span class="text-info-emphasis">{{__('public.noData')}}</span>
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="text-danger">
                                {{__('public.oldExpenses')}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.expenseForHim") }}</td>
                            <td>{{ __("public.mainCategory") }}</td>
                            <td>{{ __("public.subCategory") }}</td>
                            <td>{{ __("public.amount") }} <br> OMR</td>
                            <td>{{ __("public.taxAmount") }} <br> %</td>
                            <td>{{ __("public.expenseAmountWithTax") }} <br> OMR</td>
                            <td>{{ __("public.expenseDate") }}</td>
                            <td>{{ __("public.monthly") }}</td>
                            <td>{{ __("public.attached") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($expenses as $expense)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$expense->expense_him}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->category->arName : $expense->category->enName}}</td>
                                    <td>{{app()->getLocale()=='ar' ? $expense->subCategory->arName : $expense->subCategory->enName}}</td>
                                    <td>{{number_format($expense->amount,3)}}</td>
                                    <td>{{$expense->tax}}</td>
                                    <td>{{number_format($expense->amount_tax,3)}}</td>
                                    <td>{{$expense->date}}</td>
                                    <td>
                                        <span class="fas fa-times-circle text-danger"></span>
                                    </td>
                                    <td>
                                        @if($expense->attach)
                                            <a href="{{asset($expense->attach)}}" target="_blank"
                                               class="btn text-info">
                                                <span class="fas fa-file"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($expense->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_EXPENSES)
                                            <button
                                                wire:click="update({{$expense->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_EXPENSES)
                                            <button
                                                wire:click="remove({{$expense->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$expense->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $expenses->links() }}
            </div>
        </div>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="category" class="form-label mt-2">{{ __("public.mainCategory")}}
                            *</label>
                        <select name="category" wire:model="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="subCategory" class="form-label mt-2">{{ __("public.subCategory")}}
                            *</label>
                        <select name="subCategory" wire:model.defer="subCategory" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getSubCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('subCategory') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="expense_him" class="form-label mt-2">{{ __("public.expenseForHim")}}
                            *</label>
                        <input wire:model.defer="expense_him" type="text" class="form-control"
                               id="expense_him" required>
                        @error('expense_him') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model.debounce.200ms="amount" type="number"
                               class="form-control text-center" id="amount" required>
                        @error('amount') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tax" class="form-label mt-2">{{ __("public.taxAmount")}}*</label>
                        <input wire:model.debounce.200ms="tax" type="number"
                               class="form-control text-center" id="tax" required>
                        @error('tax') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount_tax"
                               class="form-label mt-2">{{ __("public.expenseAmountWithTax")}}*
                            <div wire:loading wire:target="amount">
                                <span class="text-danger fs-6">{{__('public.calculation')}}</span>
                            </div>
                            <div wire:loading wire:target="tax">
                                <span class="text-danger fs-6">{{__('public.calculation')}}</span>
                            </div>
                        </label>
                        <input wire:model.defer="amount_tax" type="number"
                               class="form-control disabled text-center text-danger" id="amount_tax"
                               required disabled>
                        @error('amount_tax') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label mt-2">{{ __("public.expenseDate")}}*</label>
                        <input wire:model.defer="date" type="date" class="form-control text-center"
                               id="date" required>
                        @error('date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="payment" class="form-label mt-2">{{ __("public.paymentMethods")}}
                            *</label>
                        <select name="payment" wire:model.defer="payment" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getPayments() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('payment') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="check" class="form-label mt-2">{{ __("public.check")}}</label>
                        <input wire:model.defer="check" type="text" class="form-control" id="check"
                               required>
                        @error('check') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control" id="attach">
                        @error('attach') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2" wire:loading wire:target="attach">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch mt-5 d-flex justify-content-evenly">
                            <label class="form-check-label"
                                   for="flexSwitchCheckChecked">{{__('public.monthly')}}</label>
                            <input wire:model.defer="monthly" class="form-check-input" type="checkbox" role="switch"
                                   id="flexSwitchCheckChecked">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="about" class="form-label mt-2">{{ __("public.about")}}*</label>
                        <input wire:model.defer="about" type="text" class="form-control" id="about"
                               required>
                        @error('about') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
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

        <x-modal id="editModal" title="public.edit" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="category" class="form-label mt-2">{{ __("public.mainCategory")}}
                            *</label>
                        <select name="category" wire:model="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="subCategory" class="form-label mt-2">{{ __("public.subCategory")}}
                            *</label>
                        <select name="subCategory" wire:model.defer="subCategory" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getSubCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('subCategory') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="expense_him" class="form-label mt-2">{{ __("public.expenseForHim")}}
                            *</label>
                        <input wire:model.defer="expense_him" type="text" class="form-control"
                               id="expense_him" required>
                        @error('expense_him') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}*</label>
                        <input wire:model.debounce.200ms="amount" type="number"
                               class="form-control text-center" id="amount" required>
                        @error('amount') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tax" class="form-label mt-2">{{ __("public.taxAmount")}}*</label>
                        <input wire:model.debounce.200ms="tax" type="number"
                               class="form-control text-center" id="tax" required>
                        @error('tax') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount_tax"
                               class="form-label mt-2">{{ __("public.expenseAmountWithTax")}}*
                            <div wire:loading wire:target="amount">
                                <span class="text-danger fs-6">{{__('public.calculation')}}</span>
                            </div>
                            <div wire:loading wire:target="tax">
                                <span class="text-danger fs-6">{{__('public.calculation')}}</span>
                            </div>
                        </label>
                        <input wire:model.defer="amount_tax" type="number"
                               class="form-control disabled text-center text-danger" id="amount_tax"
                               required disabled>
                        @error('amount_tax') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label mt-2">{{ __("public.expenseDate")}}*</label>
                        <input wire:model.defer="date" type="date" class="form-control text-center"
                               id="date" required>
                        @error('date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="payment" class="form-label mt-2">{{ __("public.paymentMethods")}}
                            *</label>
                        <select name="payment" wire:model.defer="payment" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getPayments() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('payment') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="check" class="form-label mt-2">{{ __("public.check")}}</label>
                        <input wire:model.defer="check" type="text" class="form-control" id="check"
                               required>
                        @error('check') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="attach" class="form-label mt-2">{{ __("public.attached")}}</label>
                        <input wire:model.defer="attach" type="file" class="form-control" id="attach">
                        @error('attach') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2" wire:loading wire:target="image">
                        {{__('public.upload')}}
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch mt-5 d-flex justify-content-evenly">
                            <label class="form-check-label"
                                   for="flexSwitchCheckChecked">{{__('public.monthly')}}</label>
                            <input wire:model.defer="monthly" {{$monthly?'checked':''}} class="form-check-input"
                                   type="checkbox" role="switch" id="flexSwitchCheckChecked">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="about" class="form-label mt-2">{{ __("public.about")}}*</label>
                        <input wire:model.defer="about" type="text" class="form-control" id="about"
                               required>
                        @error('about') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
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
