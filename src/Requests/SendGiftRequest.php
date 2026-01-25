<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the sendGift method.
 *
 * Use this method to send a gift to a user.
 *
 * @link https://core.telegram.org/bots/api#sendgift
 */
class SendGiftRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int  $user_id  Unique identifier of the target user
     * @param  string  $gift_id  Identifier of the gift
     */
    public function __construct(
        protected int $user_id,
        protected string $gift_id,
    ) {}

    public function text(string $text): self
    {
        $this->params['text'] = $text;

        return $this;
    }

    public function textParseMode(string $text_parse_mode): self
    {
        $this->params['text_parse_mode'] = $text_parse_mode;

        return $this;
    }

    public function textEntities(array $text_entities): self
    {
        $this->params['text_entities'] = $text_entities;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendGift';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (empty($this->gift_id)) {
            throw new TelegramValidationException('gift_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'gift_id' => $this->gift_id,
        ] + $this->params;
    }
}
