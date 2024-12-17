<?php

namespace App\Custom;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\RemoteFile;

class FileSystem extends \Spatie\MediaLibrary\MediaCollections\Filesystem
{
    public function copyToMediaLibraryFromRemote(RemoteFile $file, Media $media, ?string $type = null, ?string $targetFileName = null): void
    {
        $destinationFileName = $targetFileName ?: $file->getFilename();

        $destination = $this->getMediaDirectory($media, $type).$destinationFileName;

        $diskDriverName = (in_array($type, ['conversions', 'responsiveImages']))
            ? $media->getConversionsDiskDriverName()
            : $media->getDiskDriverName();

        if ($this->shouldCopyFileOnDisk($file, $media, $diskDriverName)) {
            $this->copyFileOnDisk($file->getKey(), $destination, $media->disk);

            return;
        }

        $storage = Storage::disk($file->getDisk());
        // Change: Prevent using readStream when moving moving file if source and destination disk are identical.
        if ($file->getDisk() === $media->disk) {
            $storage->move($file->getKey(), $destination);

            return;
        }
        $headers = $diskDriverName === 'local'
            ? []
            : $this->getRemoteHeadersForFile(
                $file->getKey(),
                $media->getCustomHeaders(),
                $storage->mimeType($file->getKey())
            );

        $this->streamFileToDisk(
            $storage->getDriver()->readStream($file->getKey()),
            $destination,
            $media->disk,
            $headers
        );
    }
}
