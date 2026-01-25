<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the unpinChatMessage method.
 *
 * Use this method to remove a message from the list of pinned messages in a chat.
 *
 * @link https://core.telegram.org/bots/api#unpinchatmessage
 */
class UnpinChatMessageRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    /**
     * Identifier of a message to unpin. If not specified, the most recent pinned message will be unpinned.
     */
    public function messageId(int $message_id): self
    {
        $this->params['message_id'] = $message_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'unpinChatMessage';
    }

    public function validate(): void
    {
        if (isset($this->params['message_id']) && $this->params['message_id'] <= 0) {
            throw new TelegramValidationException('message_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ] + $this->params;
    }
}
