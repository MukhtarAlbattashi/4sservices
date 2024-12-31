<?php

namespace App\Http\Livewire\Asset;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AssetPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $category;

    public $subCategory;

    public $assetId;

    public $name;

    public $amount;

    public $date;

    public $supplier;

    public $attach;

    public $rate;

    public $notes;

    protected $paginationTheme = 'bootstrap';

    protected $categories;

    protected $subCategories;

    protected $rules = [
        'supplier' => 'required',
        'category' => 'required',
        'subCategory' => 'required',
        'name' => 'required',
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date',
        'rate' => 'required|numeric|min:0|max:100',
    ];

    public function getCategories()
    {
        if ($this->categories == null) {
            if (app()->getLocale() == 'ar') {
                $this->categories = AssetCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->categories = AssetCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->categories;
    }

    public function updatedCategory()
    {
        $this->getSubCategories();
    }

    public function getSubCategories()
    {
        if ($this->category != null) {
            if (app()->getLocale() == 'ar') {
                $this->subCategories = AssetSubCategory::where('asset_category_id', $this->category)->orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->subCategories = AssetSubCategory::where('asset_category_id', $this->category)->orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        } else {
            $this->subCategories = [];
        }

        return $this->subCategories;
    }

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.asset.asset-page', [
            'incomes' => Asset::query()->with('category', 'subCategory', 'user')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->assetId = $id;
        $item = Asset::query()->findOrFail($this->assetId);
        $this->name = $item->name;
        $this->amount = $item->amount;
        $this->date = $item->date;
        $this->supplier = $item->supplier;
        $this->attach = $item->attach;
        $this->rate = $item->rate;
        $this->notes = $item->notes;
        $this->category = $item->asset_category_id;
        $this->subCategory = $item->asset_sub_category_id;
        $this->attach = $item->attach;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->assetId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        if ($new) {
            $item = new Asset();
            $item->name = $this->name;
            $item->amount = $this->amount;
            $item->date = $this->date;
            $item->supplier = $this->supplier;
            $item->attach = $this->attach;
            $item->rate = $this->rate;
            $item->notes = $this->notes;
            $item->asset_category_id = $this->category;
            $item->asset_sub_category_id = $this->subCategory;
            $item->user_id = Auth::id();
            if ($this->attach) {
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/'.$path;
            }
            $item->save();
        } else {
            $item = Asset::query()->findOrFail($id);
            $item->name = $this->name;
            $item->amount = $this->amount;
            $item->date = $this->date;
            $item->supplier = $this->supplier;
            $item->rate = $this->rate;
            $item->notes = $this->notes;
            $item->asset_category_id = $this->category;
            $item->asset_sub_category_id = $this->subCategory;
            $item->user_id = Auth::id();
            if ($this->attach != $item->attach) {
                if ($item->attach) {
                    unlink($item->attach);
                }
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/'.$path;
            }
            $item->save();
        }
    }

    public function save()
    {
        $this->validate();
        $this->item(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id)
    {
        $this->assetId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        $item = Asset::query()->findOrFail($this->assetId);
        if ($item->attach) {
            unlink($item->attach);
        }
        $item->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->assetId = null;
        $this->reset();
    }
}
