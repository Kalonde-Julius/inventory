<?php

namespace App\Filament\TenantManager\Resources\Tenants\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('contact')
                    ->required(),
                Textarea::make('data')
                    ->columnSpanFull(),
            ]);
    }
}
