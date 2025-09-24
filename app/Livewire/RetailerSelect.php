<?php

namespace App\Livewire;

use App\Models\Retailer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class RetailerSelect extends Component
{
    public $search = '';

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'livewire.retailer-select', [
                'retailers' => Retailer::where('name', 'like', "$this->search%")->get()
            ]
        );
    }
}
