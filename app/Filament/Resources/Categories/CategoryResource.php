<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'category';

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema)
            ->components([
                TextInput::make('name')
                    ->label('Category Name')
                    ->required(),

                TextInput::make('description')
                    ->required(),
                    
                KeyValue::make('data')
                    ->label('Additional Data')
            ]);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table)
            ->pushColumns([
                TextColumn::make('tenant_id')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('description'),

                TextColumn::make('data'),

                TextColumn::make('created_at')
                    ->date('D N M Y')
                    ->sortable(),
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
