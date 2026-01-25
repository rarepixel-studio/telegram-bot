<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the setUserEmojiStatus method.
 *
 * Changes the emoji status for a given user that was  previously set using the bot.
 *
 * @link https://core.telegram.org/bots/api#setuseremojistatus
 */
class SetUserEmojiStatusRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int $user_id,
    ) {}

    /**
     * Custom emoji identifier of the emoji status to set. Pass an empty string to remove the status.
     */
    public function emojiStatusCustomEmojiId(?string $emoji_status_custom_emoji_id): self
    {
        $this->params['emoji_status_custom_emoji_id'] = $emoji_status_custom_emoji_id;

        return $this;
    }

    /**
     * Expiration date of the emoji status, if any.
     */
    public function emojiStatusExpirationDate(?int $emoji_status_expiration_date): self
    {
        $this->params['emoji_status_expiration_date'] = $emoji_status_expiration_date;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setUserEmojiStatus';
    }

    public function validate(): void
    {
        // No specific validation needed for this method
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
        ] + $this->params;
    }
}
