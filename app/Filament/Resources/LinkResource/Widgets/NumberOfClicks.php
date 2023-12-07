<?php

namespace App\Filament\Resources\LinkResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class NumberOfClicks extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Number of Clicks', $this->record->clicks()->count()),
        ];
    }
}
