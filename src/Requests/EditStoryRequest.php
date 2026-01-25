<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputMedia;

/**
 * Request object for the editStory method.
 *
 * Use this method to edit a story.
 *
 * @link https://core.telegram.org/bots/api#editstory
 */
class EditStoryRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'content',
    ];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $story_id  Identifier of the story to edit
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $story_id,
    ) {}

    protected array $params = [];

    public function content(InputMedia $content): self
    {
        $this->params['content'] = $content;

        return $this;
    }

    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    public function parseMode(string $parse_mode): self
    {
        $this->params['parse_mode'] = $parse_mode;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editStory';
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
        ] + $this->params;
    }
}
