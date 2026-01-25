<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the sendChatAction method.
 *
 * Use this method when you need to tell the user that something is happening on the bot's side.
 * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
 *
 * @link https://core.telegram.org/bots/api#sendchataction
 */
class SendChatActionRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $action  Type of action to broadcast
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $action,
    ) {}

    /**
     * Unique identifier of the business connection on behalf of which the action will be sent.
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * Unique identifier for the target message thread; for forum supergroups only.
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendChatAction';
    }

    public function validate(): void
    {
        $validActions = [
            'typing',
            'upload_photo',
            'record_video',
            'upload_video',
            'record_voice',
            'upload_voice',
            'upload_document',
            'choose_sticker',
            'find_location',
            'record_video_note',
            'upload_video_note',
        ];

        if (! in_array($this->action, $validActions, true)) {
            throw new TelegramValidationException(
                'Invalid action. Must be one of: '.implode(', ', $validActions)
            );
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'action' => $this->action,
        ] + $this->params;
    }
}
