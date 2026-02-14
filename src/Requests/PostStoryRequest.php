<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
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
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'content',
    ];

    /**
     * @param  InputMedia  $content  The content of the story
     */
    public function __construct(
        protected string $business_connection_id,
        protected InputMedia $content,
        protected int $active_period,
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
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
        if ($this->active_period <= 0) {
            throw new TelegramValidationException('active_period must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'content' => $this->content,
            'active_period' => $this->active_period,
        ] + $this->params;
    }
}
