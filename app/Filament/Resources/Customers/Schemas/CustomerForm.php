<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(self::getCustomerFormSchema());
    }

    public function  getCustomerFormSchema() {
        return [
            Section::make('Create Customer')
                ->columns(2)
                ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('contact'),
                TextInput::make('address'),
             //   TextInput::make('remarks'),
                KeyValue::make('data')->label('Additional information'),
                ])
        ];
    }
}
