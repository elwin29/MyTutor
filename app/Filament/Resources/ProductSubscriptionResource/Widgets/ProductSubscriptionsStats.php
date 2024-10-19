<?php

namespace App\Filament\Resources\ProductSubscriptionResource\Widgets;

use App\Models\ProductSubscription;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductSubscriptionsStats extends BaseWidget
{
    protected function getStats(): array
    {   
        // Fetch total transactions count
        $totalTransactions = ProductSubscription::count();

        // Fetch approved transactions count (is_paid = true)
        $approvedTransactions = ProductSubscription::where('is_paid', true)->count();

        // Calculate total revenue from approved transactions (sum of total_amount for paid transactions)
        $totalRevenue = ProductSubscription::where('is_paid', true)->sum('total_amount');

        // Format revenue for display (with thousands separator)
        $formattedRevenue = 'IDR ' . number_format($totalRevenue, 0, '', ',');

        return [
            // Display total transactions
            Stat::make('Total Transactions', $totalTransactions)
                ->description('All Transactions')
                ->descriptionIcon('heroicon-o-currency-dollar'),
            
            // Display approved transactions
            Stat::make('Approved Transactions', $approvedTransactions)
                ->description('Approved Transactions')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
            
            // Display total revenue as a single string
            Stat::make('Total Revenue', $formattedRevenue)
                ->description('Revenue from approved transactions')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
