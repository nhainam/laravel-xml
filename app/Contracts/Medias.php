<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Contracts;

use App\Models\Media;

interface Medias
{
    /**
     * @param int $typeId
     * @return Media|null
     */
    public function findByTypeId(int $typeId): ?Media;

    /**
     * @param array $data
     * @return Media
     */
    public function create(array $data): Media;

    /**
     * @param Media $media
     * @param array $data
     * @return Media
     */
    public function update(Media $media, array $data): Media;

    /**
     * @param Media $media
     * @return bool
     */
    public function delete(Media $media): bool;
}
