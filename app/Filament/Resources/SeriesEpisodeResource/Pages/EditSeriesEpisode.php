<?php

namespace App\Filament\Resources\SeriesEpisodeResource\Pages;

use App\Filament\Resources\SeriesEpisodeResource;
use App\Jobs\AddVideoToSeriesEpisode;
use App\Models\SeriesEpisode;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditSeriesEpisode extends EditRecord
{
    protected static string $resource = SeriesEpisodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('add_video')
                ->label('اضافه کردن ویدیو')
                ->form([
                    Forms\Components\Section::make()
                        ->columns(2)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('نام فایل ویدیو')
                                ->columnSpanFull()
                                ->required(),
                        ]),
                ])
                ->action(function (array $data) {
                    $filePath = sprintf('manual/%s.mp4', Str::replace('.mp4', '', $data['name']));
                    $disk = 's3_private';

                    $record = $this->getRecord();

                    if (! $record instanceof SeriesEpisode) {
                        return;
                    }

                    if ($record->video) {
                        Notification::make()
                            ->danger()
                            ->title('این قسمت دارای ویدیو است')
                            ->body('اگر میخواهید ویدیو جدید اپلود کنید لطفا ویدیو قبلی رو پاک کنید')
                            ->send();

                        return;
                    }

                    if (! Storage::disk($disk)->exists($filePath)) {
                        Notification::make()
                            ->danger()
                            ->title('همچین ویدیویی وجود ندارد')
                            ->body('لطفا مطمئن شوید که ویدیو در پوشه manual اپلود شده است')
                            ->send();

                        return;
                    }

                    if (! in_array(Storage::disk($disk)->mimeType($filePath), ['video/mp4'], true)) {
                        Notification::make()
                            ->danger()
                            ->title('فرمت ویدیو صحیح نیست')
                            ->body('فرمت ویدیو باید .mp4 باشد')
                            ->send();

                        return;
                    }

                    AddVideoToSeriesEpisode::dispatch($this->getRecord(), $filePath);

                    Notification::make()
                        ->success()
                        ->title('ویدیو تا دقایقی دیگر به سریال وصل خواهد شد')
                        ->send();
                }),
        ];
    }
}
