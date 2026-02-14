<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setMyProfilePhoto method.
 *
 * Use this method to set the bot's profile photo. Returns True on success.
 *
 * @link https://core.telegram.org/bots/api#setmyprofilephoto
 */
class SetMyProfilePhotoRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  array<string, mixed>|string  $photo  A JSON-serialized object of the InputProfilePhoto type
     */
    public function __construct(
        protected array|string $photo,
    ) {}

    /**
     * Pass True to set the photo as a public photo visible even if the bot's main photo is hidden
     * by the user's privacy settings. An additional photo will be set only for the user who has
     * hidden the main photo; other users will continue to see the photo previously set by the bot.
     */
    public function isPublic(bool $isPublic): self
    {
        $this->params['is_public'] = $isPublic;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setMyProfilePhoto';
    }

    public function validate(): void
    {
        if (empty($this->photo)) {
            throw new TelegramValidationException('photo is required');
        }
    }

    public function buildParams(): array
    {
        return [
            'photo' => is_array($this->photo) ? json_encode($this->photo) : $this->photo,
        ] + $this->params;
    }
}
