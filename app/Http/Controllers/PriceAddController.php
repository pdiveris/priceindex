<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Retailer;
use App\Models\Unit;

class PriceAddController extends Controller
{
    public function __invoke()
    {
        $countries = Country::where('enabled', 1)
            ->orderBy('name')
            ->get()
            ->pluck('name', 'alpha_2')
            ->toArray();

        $units = Unit::where('enabled', 1)
            ->orderBy('unit')
            ->get()
            ->pluck('unit', 'id')
            ->toArray();

        $retailers = Retailer::where('enabled', 1)
            ->orderBy('name')
            ->get(['id', 'name', 'country'])
            ->toArray();

        return view('price',
            [
                'countries' => $countries,
                'retailers' => $retailers,
                'units' => $units,
            ]
        );
    }
}
