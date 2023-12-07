<?php

namespace App\Filament\Resources\LinkResource\Pages;

use App\Filament\Resources\LinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLink extends ViewRecord
{
    protected static string $resource = LinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LinkResource\Widgets\NumberOfClicks::class,
            LinkResource\Widgets\ByDate::class,
            LinkResource\Widgets\ByCountry::class,
            LinkResource\Widgets\DeviceType::class,
        ];
    }
}
