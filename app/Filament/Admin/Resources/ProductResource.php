<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\CategorySorted;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TagsInput::make('product_tags')
                    ->suggestions(
                        Tag::all()->pluck('tag')->toArray(),
                    )
                    ->saveRelationshipsUsing(function (Model $record, $state) {
                        $ids = Tag::whereIn('tag', $state)->pluck('id');

                        $new = array_diff($state, Tag::whereIn("tag", $state)
                            ->pluck("tag")
                            ->toArray());

                        foreach ($new as $tagName) {
                            $tag = new Tag(['tag' => $tagName]);
                            $tag->save();
                            $ids[] = $tag->id;
                        }

                        $record->tags()->sync($ids);

                    })
                    ->columnSpanFull(),
                Select::make('category')
                    ->label('Category')
                    ->options(CategorySorted::where(["enabled" => 1])
                        ->pluck("name", "id")
                        ->all()
                    )
                    ->required()
                    ->searchable(),
                Select::make('unit')
                    ->options(Unit::all()->pluck('unit', 'id'))
                    ->required(),
                Forms\Components\Toggle::make('enabled')
                    ->default(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_category')
                    ->label('Category')
                    ->searchable(query: function (Builder $query, $search): Builder {
                        return $query->whereIn(
                            'category',
                            DB::table("categories")
                                ->where("name", "like",
                                    str_replace('c:', '', "$search%")
                                )
                                ->pluck("id")
                        );
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query
                            ->orderBy('category', $direction);
                    }),
                Tables\Columns\TextColumn::make('product_unit')
                    ->label('Unit')
                    ->searchable(query: function (Builder $query, $search): Builder {
                        return $query->whereIn(
                            'unit',
                            DB::table("units")
                                ->where("unit", "like",
                                    str_replace('u:', '', "$search%")
                                )
                                ->pluck("id")
                        );
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query
                            ->orderBy('unit', $direction);
                    }),
                Tables\Columns\IconColumn::make('enabled')
                    ->alignCenter()
                    ->boolean(),
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
            ->defaultSort('name')
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
          RelationManagers\ProductTranslationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
