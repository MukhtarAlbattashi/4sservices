<?php

namespace App\View\Components;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class MobileCard extends Component
{
    /**
     * @param  Customer  $customer
     */
    public function __construct(
        public Customer $customer
    ) {
    }

    public function render(): View
    {
        return view('components.mobile-card');
    }
}
