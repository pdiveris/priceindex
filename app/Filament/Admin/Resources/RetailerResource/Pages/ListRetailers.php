<?php

namespace App\Filament\Admin\Resources\RetailerResource\Pages;

use App\Filament\Admin\Resources\RetailerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetailers extends ListRecords
{
    protected static string $resource = RetailerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
