<?php

namespace App\Filament\Resources\CotegaryResource\Pages;

use App\Filament\Resources\CotegaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCotegaries extends ListRecords
{
    protected static string $resource = CotegaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
