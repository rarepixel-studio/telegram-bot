<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the createNewStickerSet method.
 *
 * Use this method to create a new sticker set.
 *
 * @link https://core.telegram.org/bots/api#createnewstickerset
 */
class CreateNewStickerSetRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'stickers',
    ];

    /**
     * @param  int  $user_id  User identifier of created sticker set owner
     * @param  string  $name  Short name of sticker set
     * @param  string  $title  Sticker set title
     * @param  array  $stickers  A list of InputSticker objects
     */
    public function __construct(
        protected int $user_id,
        protected string $name,
        protected string $title,
        protected array $stickers,
    ) {}

    protected array $params = [];

    public function stickerType(string $sticker_type): self
    {
        $this->params['sticker_type'] = $sticker_type;

        return $this;
    }

    public function needsRepainting(bool $needs_repainting): self
    {
        $this->params['needs_repainting'] = $needs_repainting;

        return $this;
    }

    public function getMethod(): string
    {
        return 'createNewStickerSet';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (empty($this->stickers)) {
            throw new TelegramValidationException('stickers cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'title' => $this->title,
            'stickers' => $this->stickers,
        ] + $this->params;
    }
}
