<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the createForumTopic method.
 *
 * Use this method to create a topic in a forum supergroup chat.
 *
 * @link https://core.telegram.org/bots/api#createforumtopic
 */
class CreateForumTopicRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  string  $name  Topic name, 1-128 characters
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $name,
    ) {}

    /**
     * Color of the topic icon in RGB format.
     */
    public function iconColor(int $icon_color): self
    {
        $this->params['icon_color'] = $icon_color;

        return $this;
    }

    /**
     * Unique identifier of the custom emoji shown as the topic icon.
     */
    public function iconCustomEmojiId(string $icon_custom_emoji_id): self
    {
        $this->params['icon_custom_emoji_id'] = $icon_custom_emoji_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'createForumTopic';
    }

    public function validate(): void
    {
        $nameLength = mb_strlen($this->name);

        if ($nameLength < 1 || $nameLength > 128) {
            throw new TelegramValidationException('name must be between 1 and 128 characters');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'name' => $this->name,
        ] + $this->params;
    }
}
