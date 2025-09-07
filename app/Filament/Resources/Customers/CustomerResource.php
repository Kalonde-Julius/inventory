<?php

namespace App\Filament\Resources\Customers;

use BackedEnum;
use App\Models\Customer;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Form;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\CreateCustomer;
use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Tables\Columns\TextColumn;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

    protected static ?string $recordTitleAttribute = 'customer';

    protected static string|\UnitEnum|null $navigationGroup = 'Entities';

    public static function getNavigationLabel(): string
    {
        return __("Customers");
    }

    public static function form(Schema $schema): Schema
    {
        return $schema

            ->schema([
                ComponentsSection::make()
                ->columns(2)
                ->schema([
                    Select::make('provider_id')
                        ->label('Provider')
                        ->relationship('provider', 'name')
                        ->columnSpan(2)
                        ->createOptionForm(function() {
                            return (new CustomerForm())->getCustomerFormSchema();
                        })
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
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
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }
}
