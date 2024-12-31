<label for="search" hidden></label>
<input
    wire:model.debounce.500ms="{{ $wireModel }}"
    class="form-control"
    type="search"
    name="search"
    id="search"
    placeholder="{{ __('public.search') }}"
/>
