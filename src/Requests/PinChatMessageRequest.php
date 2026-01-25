<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the pinChatMessage method.
 *
 * Use this method to add a message to the list of pinned messages in a chat.
 *
 * @link https://core.telegram.org/bots/api#pinchatmessage
 */
class PinChatMessageRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $message_id  Identifier of a message to pin
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    /**
     * Pass True if it is not necessary to send a notification to all chat members about the new pinned message.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    public function getMethod(): string
    {
        return 'pinChatMessage';
    }

    public function validate(): void
    {
        if ($this->message_id <= 0) {
            throw new TelegramValidationException('message_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
        ] + $this->params;
    }
}
