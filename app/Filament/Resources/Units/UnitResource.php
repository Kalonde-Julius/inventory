<?php

namespace App\Filament\Resources\Units;

use App\Filament\Resources\Units\Pages\CreateUnit;
use App\Filament\Resources\Units\Pages\EditUnit;
use App\Filament\Resources\Units\Pages\ListUnits;
use App\Filament\Resources\Units\Schemas\UnitForm;
use App\Filament\Resources\Units\Tables\UnitsTable;
use App\Models\Unit;
use BackedEnum;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'unit';

    public static function form(Schema $schema): Schema
    {
        return UnitForm::configure($schema)

            ->components([
                TextInput::make('name')
                    ->label('Unit Name')
                    ->helperText('Kilogram, Tons, Liter, Piece, etc')
                    ->required(),

                TextInput::make('key')
                    ->label('short unit')
                    ->helperText('kg, ton, l, pc, etc')
                    ->required(),

                KeyValue::make('data')
                    ->label('Additional Data')
            ]);
    }

    public static function table(Table $table): Table
    {
        return UnitsTable::configure($table)

            ->pushColumns([
                TextColumn::make('tenant_id')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Unit Name'),

                TextColumn::make('key')
                    ->label('Short Unit')
                    ->searchable(),

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
            'index' => ListUnits::route('/'),
            'create' => CreateUnit::route('/create'),
            'edit' => EditUnit::route('/{record}/edit'),
        ];
    }
}
