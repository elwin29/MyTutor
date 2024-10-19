<?php

namespace App\Filament\Resources\ProductSubscriptionResource\Pages;

use App\Filament\Resources\ProductSubscriptionResource;
use App\Filament\Resources\ProductSubscriptionResource\Widgets\ProductSubscriptionsStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductSubscriptions extends ListRecords
{
    protected static string $resource = ProductSubscriptionResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ProductSubscriptionsStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
