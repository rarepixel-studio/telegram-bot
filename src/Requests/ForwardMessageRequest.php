<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\Message;

/**
 * Method to forward messages of any kind.
 *
 * @link https://core.telegram.org/bots/api#forwardmessage
 */
class ForwardMessageRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  int|string  $from_chat_id  Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param  int  $message_id  Message identifier in the chat specified in from_chat_id
     */
    public function __construct(
        protected int|string $chat_id,
        protected int|string $from_chat_id,
        protected int $message_id,
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
     * Sends the message silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the forwarded message from forwarding and saving.
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    public function getMethod(): string
    {
        return 'forwardMessage';
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'from_chat_id' => $this->from_chat_id,
            'message_id' => $this->message_id,
        ] + $this->params;
    }

    public function validate(): void
    {
        // Parameter validation
    }

    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }
}
