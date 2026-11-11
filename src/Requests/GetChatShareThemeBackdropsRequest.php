<?php

namespace Telegram\Bot\Requests;

/**
 * Get the available backdrops for chat share themes.
 *
 * @link https://core.telegram.org/bots/api#getchatsharethemebackdrops
 */
class GetChatShareThemeBackdropsRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Additional request parameters. */
    protected array $params = [];

    /**
     * Build a request from Telegram parameter names.
     *
     * @param  array<string, mixed>  $params  Telegram request parameters
     * @return self The request object
     */
    public static function fromArray(array $params): self
    {
        $request = new self;
        $request->params = $params;

        return $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'getChatShareThemeBackdrops';
    }

    /**
     * {@inheritdoc}
     */
    public function validate(): void {}

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return $this->params;
    }
}
