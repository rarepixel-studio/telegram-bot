<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\InputMedia;

/**
 * Request object for the postStory method.
 *
 * Use this method to post a story.
 *
 * @link https://core.telegram.org/bots/api#poststory
 */
class PostStoryRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  InputMedia  $content  The content of the story
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputMedia $content,
    ) {}

    protected array $params = [];

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
        return 'postStory';
    }

    public function validate(): void
    {
        // Basic validation
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'content' => $this->content,
        ] + $this->params;
    }
}
