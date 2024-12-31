<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.settings") }}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <img src="{{asset($setting->logo ?? 'images/no_image.png')}}" alt="" height="80">
                        <br>
                        <label for="logo" class="form-label mt-2">{{ __("public.logo")}}</label>
                        <input wire:model.defer="logo" type="file" class="form-control text-center" id="logo"
                               accept=".jpg, .png">
                        @error('logo') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        <span wire:loading wire:target="logo">{{__('public.upload')}}</span>
                    </div>
                    <div class="col-md-3">
                        <img src="{{asset($setting->stamp ?? 'images/no_image.png')}}" alt="" height="80">
                        <br>
                        <label for="stamp" class="form-label mt-2">{{ __("public.stamp")}}</label>
                        <input wire:model.defer="stamp" type="file" class="form-control text-center" id="stamp"
                               accept=".jpg, .png">
                        @error('stamp') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        <span wire:loading wire:target="stamp">{{__('public.upload')}}</span>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset($setting->header ?? 'images/no_image.png')}}" height="80" width="100%" alt="">
                        <br>
                        <label for="header" class="form-label mt-2">{{ __("public.header")}}</label>
                        <input wire:model.defer="header" type="file" class="form-control text-center" id="header"
                               accept=".jpg, .png">
                        @error('header') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        <span wire:loading wire:target="header">{{__('public.upload')}}</span>
                    </div>
                    <div class="col-md-3">
                        <label for="companyNameAr" class="form-label mt-2">{{ __("public.companyNameAr")}}</label>
                        <input wire:model.defer="setting.companyNameAr" type="text" class="form-control text-center"
                               id="companyNameAr" required>
                        @error('setting.companyNameAr') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="companyNameEn" class="form-label mt-2">{{ __("public.companyNameEn")}}</label>
                        <input wire:model.defer="setting.companyNameEn" type="text" class="form-control text-center"
                               id="companyNameEn" required>
                        @error('setting.companyNameEn') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="CRNo" class="form-label mt-2">{{ __("public.CRNo")}}</label>
                        <input wire:model.defer="setting.CRNo" type="text" class="form-control text-center" id="CRNo"
                               required>
                        @error('setting.CRNo') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="addressAr" class="form-label mt-2">{{ __("public.addressAr")}}</label>
                        <input wire:model.defer="setting.addressAr" type="text" class="form-control text-center"
                               id="addressAr" required>
                        @error('setting.addressAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="addressEn" class="form-label mt-2">{{ __("public.addressEn")}}</label>
                        <input wire:model.defer="setting.addressEn" type="text" class="form-control text-center"
                               id="addressEn" required>
                        @error('setting.addressEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="governorateAr" class="form-label mt-2">{{ __("public.governorateAr")}}</label>
                        <input wire:model.defer="setting.governorateAr" type="text" class="form-control text-center"
                               id="governorateAr" required>
                        @error('setting.governorateAr') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="governorateEn" class="form-label mt-2">{{ __("public.governorateEn")}}</label>
                        <input wire:model.defer="setting.governorateEn" type="text" class="form-control text-center"
                               id="governorateEn" required>
                        @error('setting.governorateEn') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="wilayatAr" class="form-label mt-2">{{ __("public.wilayatAr")}}</label>
                        <input wire:model.defer="setting.wilayatAr" type="text" class="form-control text-center"
                               id="wilayatAr" required>
                        @error('setting.wilayatAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="wilayatEn" class="form-label mt-2">{{ __("public.wilayatEn")}}</label>
                        <input wire:model.defer="setting.wilayatEn" type="text" class="form-control text-center"
                               id="wilayatEn" required>
                        @error('setting.wilayatEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="buildingNo" class="form-label mt-2">{{ __("public.buildingNo")}}</label>
                        <input wire:model.defer="setting.buildingNo" type="text" class="form-control text-center"
                               id="buildingNo" required>
                        @error('setting.buildingNo') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="POBox" class="form-label mt-2">{{ __("public.POBox")}}</label>
                        <input wire:model.defer="setting.POBox" type="text" class="form-control text-center" id="POBox"
                               required>
                        @error('setting.POBox') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="pc" class="form-label mt-2">{{ __("public.pc")}}</label>
                        <input wire:model.defer="setting.pc" type="text" class="form-control text-center" id="pc"
                               required>
                        @error('setting.pc') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label mt-2">{{ __("public.email")}}</label>
                        <input wire:model.defer="setting.email" type="text" class="form-control text-center" id="email"
                               required>
                        @error('setting.email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="phone" class="form-label mt-2">{{ __("public.phone")}}</label>
                        <input wire:model.defer="setting.phone" type="text" class="form-control text-center" id="phone"
                               required>
                        @error('setting.phone') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="tax" class="form-label mt-2">{{ __("public.tax")}}</label>
                        <input wire:model.defer="setting.tax" type="text" class="form-control text-center" id="tax"
                               required>
                        @error('setting.tax') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="taxNumber" class="form-label mt-2">{{ __("public.taxNumber")}}</label>
                        <input wire:model.defer="setting.taxNumber" type="text" class="form-control text-center"
                               id="taxNumber" required>
                        @error('setting.taxNumber') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="termsAr" class="form-label mt-2">{{ __("public.termsAr")}}</label>
                        <textarea wire:model.defer="setting.termsAr" type="text" class="form-control text-center"
                                  id="termsAr" required></textarea>
                        @error('setting.termsAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="termsEn" class="form-label mt-2">{{ __("public.termsEn")}}</label>
                        <textarea wire:model.defer="setting.termsEn" type="text" class="form-control text-center"
                                  id="termsEn" required></textarea>
                        @error('setting.termsEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                @canany([\App\Enums\AppPermissions::CAN_CREATE_SETTINGS, \App\Enums\AppPermissions::CAN_EDIT_SETTINGS])
                    <button class="btn btn-success" wire:click="save">
                        {{ __('public.save') }} {{ __('public.settings') }}
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>
