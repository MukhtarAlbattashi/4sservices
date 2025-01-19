<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingPage extends Component
{
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public Setting $setting;
    public $stamp;
    public $logo;
    public $header;

    protected $rules = [
        'setting.companyNameAr' => 'max:200',
        'setting.companyNameEn' => 'max:200',
        'setting.CRNo' => 'max:200',
        'setting.addressAr' => 'max:200',
        'setting.addressEn' => 'max:200',
        'setting.governorateAr' => 'max:200',
        'setting.governorateEn' => 'max:200',
        'setting.wilayatAr' => 'max:200',
        'setting.wilayatEn' => 'max:200',
        'setting.buildingNo' => 'max:200',
        'setting.POBox' => 'max:200',
        'setting.pc' => 'max:200',
        'setting.email' => 'max:200',
        'setting.phone' => 'max:200',
        'setting.tax' => 'max:200',
        'setting.taxNumber' => 'max:200',
        'setting.termsAr' => 'max:200',
        'setting.termsEn' => 'max:200',
    ];

    public function mount()
    {
        $this->setting = Setting::query()->first() ?? new Setting();
    }

    public function render()
    {
        return view('livewire.settings.setting-page');
    }

    public function save()
    {
        $this->validate();
        if ($this->stamp) {
            if ($this->setting->stamp) {
                try {
                    unlink($this->setting->stamp);
                } catch (\Exception $e) {
                    Log::alert($e->getMessage());
                }
            }
            $path = $this->stamp->store('photo', 'public');
            $this->setting->stamp = 'storage/' . $path;
        }
        if ($this->logo) {
            if ($this->setting->logo) {
                try {
                    unlink($this->setting->logo);
                } catch (\Exception $e) {
                    Log::alert($e->getMessage());
                }
            }
            $path = $this->logo->store('photo', 'public');
            $this->setting->logo = 'storage/' . $path;
        }
        if ($this->header) {
            if ($this->setting->header) {
                try {
                    unlink($this->setting->header);
                } catch (\Exception $e) {
                    Log::alert($e->getMessage());

                }
                $path = $this->header->store('photo', 'public');
                $this->setting->header = 'storage/' . $path;
            }
        }
        $this->setting->save();
        $this->notify('success', trans('public.success'));
        //clear cache
        cache()->forget('settings');
        to_route('settings');
    }
}
