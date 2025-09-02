<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('code')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('unit_id')
                    ->label('Unit')
                    ->relationship('unit', 'key')
                    ->required(),

                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('UGX'),

                TextInput::make('safety_stock')
                    ->helperText('The minimum stock to be stored')
                    ->numeric(),

                Textarea::make('description')
                    ->columnSpanFull(),

                TextInput::make('unit_id')
                    ->required()
                    ->numeric(),

                KeyValue::make('data')
                ->label('Additional Data'),

                DatePicker::make('expires_at'),
            ]);
    }
}
