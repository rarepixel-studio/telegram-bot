<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputRichMessage;

/**
 * Request object for the sendRichMessageDraft method.
 *
 * @link https://core.telegram.org/bots/api#sendrichmessagedraft
 */
class SendRichMessageDraftRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'rich_message',
    ];

    protected array $params = [];

    /**
     * @param  int  $chat_id  Unique identifier for the target private chat
     * @param  int  $draft_id  Unique non-zero identifier of the message draft
     * @param  InputRichMessage|array  $rich_message  The partial message to be streamed
     */
    public function __construct(
        protected int $chat_id,
        protected int $draft_id,
        protected InputRichMessage|array $rich_message,
    ) {}

    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * Pass True to show the user a button to stop further drafts.
     */
    public function canStop(bool $can_stop): self
    {
        $this->params['can_stop'] = $can_stop;

        return $this;
    }

    /**
     * Pass True to keep the draft in the chat when the stop button is pressed.
     */
    public function keepOnStop(bool $keep_on_stop): self
    {
        $this->params['keep_on_stop'] = $keep_on_stop;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendRichMessageDraft';
    }

    public function validate(): void
    {
        if ($this->draft_id === 0) {
            throw new TelegramValidationException('draft_id must be non-zero');
        }

        if (is_array($this->rich_message)) {
            $this->rich_message = InputRichMessage::fromArray($this->rich_message);
        }

        $this->rich_message->validate();
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'draft_id' => $this->draft_id,
            'rich_message' => $this->rich_message,
        ] + $this->params;
    }
}
