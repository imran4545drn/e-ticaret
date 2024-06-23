<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\order;
use Faker\Core\Number;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class orderstats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('new orders', order::query()->where('status','new')->count()),
            Stat::make('order processing', order::query()->where('status','processing')->count()),
            Stat::make('order Shippend', order::query()->where('status','shipped')->count()),
            $averagePrice = number_format(Order::query()->avg('grand_total'), 2), // Format the average price with two decimal places
            Stat::make('average_price',   $averagePrice)


        ];
    }
}
