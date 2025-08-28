<?php

namespace App\Filament\Resources\Providers;

use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Providers\Pages\CreateProvider;
use App\Filament\Resources\Providers\Pages\EditProvider;
use App\Filament\Resources\Providers\Pages\ListProviders;
use App\Filament\Resources\Providers\Schemas\ProviderForm;
use App\Filament\Resources\Providers\Tables\ProvidersTable;
use App\Models\Provider;
use BackedEnum;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class ProviderResource extends CustomerResource
{
    protected static ?string $model = Provider::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::User;

    protected static ?string $recordTitleAttribute = 'provider';

    protected static string|\UnitEnum|null $navigationGroup = 'Entities';

    public static function getNavigationLabel(): string
    {
        return __("Providers");
    }

    public static function form(Schema $schema): Schema
    {
        return ProviderForm::configure($schema)

            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('contact'),
                TextInput::make('address'),
                KeyValue::make('data')->label('Additional information'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return ProvidersTable::configure($table);
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
            'index' => ListProviders::route('/'),
            'create' => CreateProvider::route('/create'),
            'edit' => EditProvider::route('/{record}/edit'),
        ];
    }
}
