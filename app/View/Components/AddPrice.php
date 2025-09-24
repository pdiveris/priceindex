<?php

namespace App\View\Components;

use AllowDynamicProperties;
use App\Models\Country;
use App\Models\Unit;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JetBrains\PhpStorm\NoReturn;

#[AllowDynamicProperties] class AddPrice extends Component
{
    /**
     * Create a new component instance.
     */
    public array $countries;
    public array $units;
    public array $retailers;

    #[NoReturn] public function __construct(
        array $countries,
        array $units,
        array $retailers
    )
    {
        $this->countries = $countries;
        $this->units = $units;
        $this->retailers = $retailers;
        $this->user_country = auth()->user()->country;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.add-price',
            [
                'countries' => $this->countries,
                'user_country' => $this->user_country,
                'units' => $this->units,
            ]
        );
    }
}
