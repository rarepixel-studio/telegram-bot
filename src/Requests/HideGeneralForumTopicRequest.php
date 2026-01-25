<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the hideGeneralForumTopic method.
 *
 * Use this method to hide the 'General' topic in a forum supergroup chat.
 *
 * @link https://core.telegram.org/bots/api#hidegeneralforumtopic
 */
class HideGeneralForumTopicRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'hideGeneralForumTopic';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ];
    }
}
