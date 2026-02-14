<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the removeMyProfilePhoto method.
 *
 * Use this method to remove the bot's profile photo. Returns True on success.
 *
 * @link https://core.telegram.org/bots/api#removemyprofilephoto
 */
class RemoveMyProfilePhotoRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    /**
     * Identifier of the profile photo to remove. If not specified, the most recent profile photo is removed.
     */
    public function photoId(string $photoId): self
    {
        $this->params['photo_id'] = $photoId;

        return $this;
    }

    public function getMethod(): string
    {
        return 'removeMyProfilePhoto';
    }

    public function validate(): void
    {
        // No required parameters — all optional.
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
