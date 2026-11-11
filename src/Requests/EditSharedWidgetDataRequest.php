<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Edit the public data of a shared widget.
 *
 * @link https://core.telegram.org/bots/api#editsharedwidgetdata
 */
class EditSharedWidgetDataRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Additional request parameters. */
    protected array $params = [];

    /**
     * @param  string  $widgetId  Shared widget identifier
     * @param  string  $publicData  Public data visible wherever the widget appears
     */
    public function __construct(
        protected string $widgetId,
        protected string $publicData,
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
        $widgetId = $params['widget_id'] ?? null;
        if (! is_string($widgetId)) {
            throw new TelegramValidationException('widget_id is required and must be a string');
        }

        $publicData = $params['public_data'] ?? null;
        if (! is_string($publicData)) {
            throw new TelegramValidationException('public_data is required and must be a string');
        }

        $request = new self($widgetId, $publicData);
        $request->params = array_diff_key($params, array_flip(['widget_id', 'public_data']));

        return $request;
    }

    /**
     * Set the maximum client-side cache lifetime in seconds.
     *
     * @param  int  $cacheTime  Maximum client-side cache lifetime in seconds
     * @return $this
     */
    public function cacheTime(int $cacheTime): self
    {
        $this->params['cache_time'] = $cacheTime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'editSharedWidgetData';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->widgetId === '') {
            throw new TelegramValidationException('widget_id cannot be empty');
        }

        if (strlen($this->publicData) > 1024) {
            throw new TelegramValidationException('public_data must not exceed 1024 bytes');
        }

        $cacheTime = $this->params['cache_time'] ?? null;
        if ($cacheTime !== null && (! is_int($cacheTime) || $cacheTime < 5 || $cacheTime > 3600)) {
            throw new TelegramValidationException('cache_time must be an integer between 5 and 3600');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return [
            'widget_id' => $this->widgetId,
            'public_data' => $this->publicData,
        ] + $this->params;
    }
}
