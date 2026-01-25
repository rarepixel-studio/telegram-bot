<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the editForumTopic method.
 *
 * Use this method to edit name and icon of a topic in a forum supergroup chat.
 *
 * @link https://core.telegram.org/bots/api#editforumtopic
 */
class EditForumTopicRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  int  $message_thread_id  Unique identifier for the target message thread of the forum topic
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_thread_id,
    ) {}

    /**
     * New topic name, 1-128 characters.
     */
    public function name(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    /**
     * New unique identifier of the custom emoji shown as the topic icon.
     */
    public function iconCustomEmojiId(string $icon_custom_emoji_id): self
    {
        $this->params['icon_custom_emoji_id'] = $icon_custom_emoji_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editForumTopic';
    }

    public function validate(): void
    {
        if ($this->message_thread_id <= 0) {
            throw new TelegramValidationException('message_thread_id must be greater than 0');
        }

        if (isset($this->params['name'])) {
            $nameLength = mb_strlen($this->params['name']);

            if ($nameLength < 1 || $nameLength > 128) {
                throw new TelegramValidationException('name must be between 1 and 128 characters');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_thread_id' => $this->message_thread_id,
        ] + $this->params;
    }
}
