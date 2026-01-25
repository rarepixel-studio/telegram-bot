<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the deleteStory method.
 *
 * Use this method to delete a story.
 *
 * @link https://core.telegram.org/bots/api#deletestory
 */
class DeleteStoryRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $story_id  Identifier of the story to delete
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $story_id,
    ) {}

    public function getMethod(): string
    {
        return 'deleteStory';
    }

    public function validate(): void
    {
        if ($this->story_id <= 0) {
            throw new TelegramValidationException('story_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'story_id' => $this->story_id,
        ];
    }
}
