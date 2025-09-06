<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        /*
        We will have 3 parts to this form
        1. About providers
        2. Multiple products
        3. Subtotal & total
        */

        return $schema
            ->components([
                Section::make()
                ->columns(3)
                ->heading('Provider Details')
                ->schema([

                TextInput::make('invoice_no')
                    ->required(),

                Select::make('provider_id')
                    ->label('Provider')
                    ->relationship('provider', 'name')
                    ->required(),

                DatePicker::make('purchase_date')
                    ->required(),

                TextInput::make('total')
                    ->required()
                    ->numeric(),

                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0),

                Textarea::make('data')
                    ->columnSpanFull(),

                Textarea::make('remarks')
                    ->columnSpanFull(),
                ]),

            Section::make()
                ->heading('Product Details')
                ->columns(3)
                ->schema([
                    Repeater::make('product')
                    ->schema([
                        // This will be a repeater component for multiple products
                        Select::make('product_id')
                        ->label('Product')
                        ->relationship('product', 'name')
                        ->searchable()
                        ->required()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required(),

                            TextInput::make('code')
                                ->required(),

                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->required(),

                            Select::make('unit_id')
                                ->label('Unit')
                                ->relationship('unit', 'key')
                                ->searchable()
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

                            DatePicker::make('expires_at'),
                        ]),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->reactive()
                            ->afterStateUpdated(function ($get, Set $set) {
                                $price = $get('price') ?? 0;
                                $quantity = $get('quantity') ?? 0;
                                $set('total', $price * $quantity);
                            }),

                            TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->reactive()
                                ->afterStateUpdated(function ($get, Set $set) {
                                    $price = $get('price') ?? 0;
                                    $quantity = $get('quantity') ?? 0;
                                    $set('total', $price * $quantity);
                                }),

                            TextInput::make('total')
                                ->numeric()
                                ->prefix('UGX ')
                                ->disabled(), // Make it read-only since it's calculated
                        ])->columns(4)
                    ]),

                ]);
    }
}
