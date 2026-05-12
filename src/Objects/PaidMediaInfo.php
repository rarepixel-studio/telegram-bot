<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class PaidMediaInfo.
 *
 * Describes the paid media added to a message.
 */
class PaidMediaInfo extends BaseObject
{
    public function __construct(mixed $data)
    {
        parent::__construct($data);

        if ($this->has('paid_media') && is_array($this->items['paid_media'])) {
            $this->items['paid_media'] = collect($this->items['paid_media'])->map(
                fn (array $media): PaidMedia|UnknownObject => $this->resolvePaidMedia($media)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The number of Telegram Stars that must be paid to buy access to the media.
     */
    public function getStarCount(): int
    {
        return $this->items['star_count'];
    }

    /**
     * Information about the paid media.
     */
    /**
     * @return Collection<int, PaidMedia|UnknownObject>
     */
    public function getPaidMedia(): Collection
    {
        return $this->items['paid_media'];
    }

    /**
     * @param  array<string, mixed>  $media
     */
    private function resolvePaidMedia(array $media): PaidMedia|UnknownObject
    {
        return match ($media['type'] ?? null) {
            'preview' => new PaidMediaPreview($media),
            'photo' => new PaidMediaPhoto($media),
            'video' => new PaidMediaVideo($media),
            'live_photo' => new PaidMediaLivePhoto($media),
            default => new UnknownObject($media),
        };
    }
}
