<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Http\Resources\PriceResource;
use App\Models\Price;

class PriceController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Price::class);

        return PriceResource::collection(Price::all());
    }

    public function store(PriceRequest $request)
    {
        $this->authorize('create', Price::class);

        return new PriceResource(Price::create($request->validated()));
    }

    public function show(Price $price)
    {
        $this->authorize('view', $price);

        return new PriceResource($price);
    }

    public function update(PriceRequest $request, Price $price)
    {
        $this->authorize('update', $price);

        $price->update($request->validated());

        return new PriceResource($price);
    }

    public function destroy(Price $price)
    {
        $this->authorize('delete', $price);

        $price->delete();

        return response()->json();
    }
}
