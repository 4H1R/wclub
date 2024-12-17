<?php

namespace App\Filament\Resources\ContactUsResource\Pages;

use App\Filament\Resources\ContactUsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContactUs extends ViewRecord
{
    protected static string $resource = ContactUsResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);
        $this->getRecord()->update(['updated_at' => now()]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
