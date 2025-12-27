<?php

namespace App\Livewire;

use App\Models\Retailer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class RetailerSelect extends Component
{
    public $search = '';
    public $name;
    public $retailerId;
    public $retailers;

    public $retailer;

    protected $rules = [
        'retailers.*.id' => '',
        'retailers.*.name' => '',

        'retailer.id' => '',
        'retailer.name' => '',
    ];

    public function mount(): void
    {
        $this->getRetailers();
    }

    public function updatedRetailerId(): void
    {
        $this->retailer = Retailer::find($this->retailerId);
    }

    public function updatedName(): void
    {
        $this->getRetailers();
    }

    public function getRetailers(): void
    {
        $this->retailers = Retailer::query()
            ->when($this->name, function ($query, $name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('name')
            ->get();
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'livewire.retailer-select', [
                'retailers' => $this->search <> '' ?
                    Retailer::where(
                        'name',
                        'like',
                        "$this->search%")
                        ->get()
                    : []
            ]
        );
    }
}
