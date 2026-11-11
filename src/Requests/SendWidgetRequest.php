<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Send a message containing an HTML widget.
 *
 * @link https://core.telegram.org/bots/api#sendwidget
 */
class SendWidgetRequest extends SendWidgetMessageRequest
{
    /**
     * @param  int|string  $chatId  Target chat ID or username
     * @param  string  $html  Widget HTML
     */
    public function __construct(
        protected int|string $chatId,
        protected string $html,
    ) {}

    /**
     * Build a request from Telegram parameter names.
     *
     * @param  array<string, mixed>  $params  Telegram request parameters
     * @return self The request object
     *
     * @throws TelegramValidationException
     */
    public static function fromArray(array $params): self
    {
        $chatId = $params['chat_id'] ?? null;
        if (! is_int($chatId) && ! is_string($chatId)) {
            throw new TelegramValidationException('chat_id is required and must be an integer or a string');
        }

        $html = $params['html'] ?? null;
        if (! is_string($html)) {
            throw new TelegramValidationException('html is required and must be a string');
        }

        $request = new self($chatId, $html);
        $request->params = array_diff_key($params, array_flip(['chat_id', 'html']));

        return $request;
    }

    /**
     * Set the widget width in logical pixels.
     *
     * @param  int  $width  Widget width in logical pixels
     * @return $this
     */
    public function width(int $width): self
    {
        $this->params['width'] = $width;

        return $this;
    }

    /**
     * Set the widget height in logical pixels.
     *
     * @param  int  $height  Widget height in logical pixels
     * @return $this
     */
    public function height(int $height): self
    {
        $this->params['height'] = $height;

        return $this;
    }

    /**
     * Set the public data visible wherever the widget appears.
     *
     * @param  string  $publicData  Public data visible wherever the widget appears
     * @return $this
     */
    public function publicData(string $publicData): self
    {
        $this->params['public_data'] = $publicData;

        return $this;
    }

    /**
     * Set the whether the widget can send queries to the bot.
     *
     * @param  bool  $allowQueries  Whether the widget can send queries to the bot
     * @return $this
     */
    public function allowQueries(bool $allowQueries): self
    {
        $this->params['allow_queries'] = $allowQueries;

        return $this;
    }

    /**
     * Set the whether the widget can be sent again by its identifier.
     *
     * @param  bool  $isShared  Whether the widget can be sent again by its identifier
     * @return $this
     */
    public function isShared(bool $isShared): self
    {
        $this->params['is_shared'] = $isShared;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'sendWidget';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->chatId === '' || $this->chatId === 0) {
            throw new TelegramValidationException('chat_id must identify the target chat');
        }

        $htmlLength = strlen($this->html);
        if ($htmlLength < 1 || $htmlLength > 32768) {
            throw new TelegramValidationException('html must contain 1 to 32768 bytes');
        }

        if (function_exists('gzcompress')) {
            $compressed = gzcompress($this->html, 9);
            if ($compressed === false || strlen($compressed) > 4096) {
                throw new TelegramValidationException('Compressed html must not exceed 4096 bytes');
            }
        }

        if (isset($this->params['public_data']) && (! is_string($this->params['public_data']) || strlen($this->params['public_data']) > 1024)) {
            throw new TelegramValidationException('public_data must be a string of up to 1024 bytes');
        }

        $this->validateWidgetMessageOptions();
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return [
            'chat_id' => $this->chatId,
            'html' => $this->html,
        ] + $this->params;
    }
}
