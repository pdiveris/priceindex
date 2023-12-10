<?php

namespace App\Filament\Admin\Resources\RetailerResource\Pages;

use App\Filament\Admin\Resources\RetailerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRetailer extends EditRecord
{
    protected static string $resource = RetailerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
