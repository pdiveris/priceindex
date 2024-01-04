<?php

namespace App\Filament\Admin\Resources\ProductResource\RelationManagers;

use App\Models\CategorySorted;
use App\Models\Language;
use App\Models\LanguageSorted;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductTranslationsRelationManager extends RelationManager
{
    protected static string $relationship = 'translations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('lang_id')
                    ->label('Language')
                    ->options(LanguageSorted::where(["enabled" => 1])
                        ->pluck("name", "lang_id")
                        ->all()
                    )
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('language.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(
                )->mutateFormDataUsing(
                    function (array $data): array {
                       // dump($data);
                        return $data;
                }),
            ])
            ->actions([
                Tables\Actions\CreateAction::make(
                )->mutateFormDataUsing(
                    function (array $data): array {
                        return $data;
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
