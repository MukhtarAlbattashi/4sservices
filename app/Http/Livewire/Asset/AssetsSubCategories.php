<?php

namespace App\Http\Livewire\Asset;

use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AssetsSubCategories extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $search;

    public $category;

    public $assetId;

    protected $paginationTheme = 'bootstrap';

    protected $items;

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
        'category' => 'required',
    ];

    public function getOptions()
    {
        if ($this->items == null) {
            if (app()->getLocale() == 'ar') {
                $this->items = AssetCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->items = AssetCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->items;
    }

    public function render()
    {
        return view('livewire.asset.assets-sub-categories', [
            'expenses' => AssetSubCategory::query()->with('category')->mySearch($this->search)->latest()->paginate(10),
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
        $item = AssetSubCategory::query()->findOrFail($this->assetId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->category = $item->asset_category_id;
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
            $item = new AssetSubCategory();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->asset_category_id = $this->category;
            $item->save();
        } else {
            $item = AssetSubCategory::query()->findOrFail($id);
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->asset_category_id = $this->category;
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
        AssetSubCategory::query()->findOrFail($this->assetId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->assetId = null;
        $this->reset();
    }
}
