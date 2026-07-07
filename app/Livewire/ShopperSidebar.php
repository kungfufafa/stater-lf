<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShopperSidebar extends Component
{
    public function render(): View
    {
        return view('filament.livewire.shopper-sidebar');
    }
}
