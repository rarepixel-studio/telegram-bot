<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Answer a query from a widget.
 *
 * @link https://core.telegram.org/bots/api#answerwidgetquery
 */
class AnswerWidgetQueryRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Additional request parameters. */
    protected array $params = [];

    /**
     * @param  string  $widgetQueryId  Widget query identifier
     */
    public function __construct(
        protected string $widgetQueryId,
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
        $widgetQueryId = $params['widget_query_id'] ?? null;
        if (! is_string($widgetQueryId)) {
            throw new TelegramValidationException('widget_query_id is required and must be a string');
        }

        $request = new self($widgetQueryId);
        $request->params = array_diff_key($params, array_flip(['widget_query_id']));

        return $request;
    }

    /**
     * Set the answer payload for the widget.
     *
     * @param  string  $data  Answer payload for the widget
     * @return $this
     */
    public function data(string $data): self
    {
        $this->params['data'] = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'answerWidgetQuery';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->widgetQueryId === '') {
            throw new TelegramValidationException('widget_query_id cannot be empty');
        }

        if (isset($this->params['data']) && (! is_string($this->params['data']) || strlen($this->params['data']) > 1024)) {
            throw new TelegramValidationException('data must be a string of up to 1024 bytes');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return [
            'widget_query_id' => $this->widgetQueryId,
        ] + $this->params;
    }
}
