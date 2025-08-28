<?php

namespace App\Filament\TenantManager\Resources\Tenants\Pages;

use App\Filament\TenantManager\Resources\Tenants\TenantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;
}
