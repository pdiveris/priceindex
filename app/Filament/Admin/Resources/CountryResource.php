<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CountryResource\Pages;
use App\Filament\Admin\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('enabled')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(80),
                Forms\Components\TextInput::make('alpha_2')
                    ->required()
                    ->maxLength(2),
                Forms\Components\TextInput::make('alpha_3')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('iso_3166_2')
                    ->required()
                    ->maxLength(60),
                Forms\Components\TextInput::make('region')
                    ->required()
                    ->maxLength(60),
                Forms\Components\TextInput::make('sub_region')
                    ->required()
                    ->maxLength(60),
                Forms\Components\TextInput::make('intermediate_region')
                    ->required()
                    ->maxLength(60),
                Forms\Components\TextInput::make('region_code')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('sub_region_code')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('intermediate_region_code')
                    ->required()
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('enabled')
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alpha_2')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alpha_3')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_code')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso_3166_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('intermediate_region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_region_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('intermediate_region_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
