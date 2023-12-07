<?php

namespace App\Filament\Resources\LinkResource\Widgets;

use App\Models\Country;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class ByCountry extends ChartWidget
{
    protected static ?string $heading = 'Number of Clicks by country';

    public ?Model $record = null;

    public ?string $filter = 'today';

    protected function getData(): array
    {
        $countries = Country::whereHas('clicks.link', fn ($q) => $q->whereKey($this->record->id))
            ->withCount('clicks')
            ->orderBy('clicks_count', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Clicks',
                    'data' => $countries->map(fn ($country) => $country->clicks_count),
                ],
            ],
            'labels' => $countries->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Last 24 hours',
            'week' => 'Last 7 days',
            'month' => 'Last 30 days',
            'quarter' => 'Last 90 days',
            'year' => 'Last 365 days',
            'all' => 'All time',
        ];
    }
}
