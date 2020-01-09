<?php


namespace App\Services;


use App\Contracts\Medias;
use App\Models\Media;

class MediaService implements Medias
{
    /**
     * @inheritDoc
     */
    public function findByTypeId(int $typeId): ?Media
    {
        return Media::where('type_id', '=', $typeId)->first();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Media
    {
        $media = new Media();
        if ($data) {
            $media->fill($data);
            $media->save();
        }
        return $media;
    }

    /**
     * @inheritDoc
     */
    public function update(Media $media, array $data): Media
    {
        if ($data) {
            $media->fill($data);
            $media->save();
        }
        return $media;
    }

    /**
     * @inheritDoc
     */
    public function delete(Media $media): bool
    {
        return $media->delete();
    }
}
