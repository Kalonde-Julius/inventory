<?php

namespace App\Filament\TenantManager\Resources\Tenants;

use App\Filament\TenantManager\Resources\Tenants\Pages\CreateTenant;
use App\Filament\TenantManager\Resources\Tenants\Pages\EditTenant;
use App\Filament\TenantManager\Resources\Tenants\Pages\ListTenants;
use App\Filament\TenantManager\Resources\Tenants\RelationManagers\UsersRelationManager;
use App\Filament\TenantManager\Resources\Tenants\Schemas\TenantForm;
use App\Filament\TenantManager\Resources\Tenants\Tables\TenantsTable;
use App\Models\Tenant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TenantForm::configure($schema)

            ->schema([
                TextInput::make('name')
                    ->label('Tenant Name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),

                TextInput::make('contact')
                    ->label('Contact')
                    ->required(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return TenantsTable::configure($table)
       // return $table
        ->pushColumns([
            TextColumn::make('name')
                ->label('Tenant Name')
                ->sortable()
                ->searchable(),
            // ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('email')
                ->label('email')
                ->searchable(),
            // ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('contact')
                ->label('contact')
                ->searchable(),
            // ->toggleable(isToggledHiddenByDefault: true),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTenants::route('/'),
            'create' => CreateTenant::route('/create'),
            'edit' => EditTenant::route('/{record}/edit'),
        ];
    }
}
