<?php

namespace Telegram\Bot\Requests;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageId;

/**
 * Method to forward multiple messages of any kind.
 *
 * @link https://core.telegram.org/bots/api#forwardmessages
 */
class ForwardMessagesRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  int|string  $from_chat_id  Unique identifier for the chat where the original messages were sent (or channel username in the format @channelusername)
     * @param  array  $message_ids  Identifiers of 1-100 messages in the chat specified in from_chat_id to forward. The identifiers must be specified in a strictly increasing order.
     */
    public function __construct(
        protected int|string $chat_id,
        protected int|string $from_chat_id,
        protected array $message_ids,
    ) {}

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * Sends the messages silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the forwarded messages from forwarding and saving.
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    public function getMethod(): string
    {
        return 'forwardMessages';
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'from_chat_id' => $this->from_chat_id,
            'message_ids' => $this->message_ids,
        ] + $this->params;
    }

    public function validate(): void
    {
        // Parameter validation
    }

    public function resolveResponse(mixed $response): Collection
    {
        return collect($response)->map(function ($messageId) {
            return new MessageId($messageId);
        });
    }
}
