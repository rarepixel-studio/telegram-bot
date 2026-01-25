<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getBusinessAccountGifts method.
 *
 * Use this method to get the list of gifts associated with the business connection.
 *
 * @link https://core.telegram.org/bots/api#getbusinessaccountgifts
 */
class GetBusinessAccountGiftsRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     */
    public function __construct(
        protected string $business_connection_id,
    ) {}

    protected array $params = [];

    public function offset(int $offset): self
    {
        $this->params['offset'] = $offset;

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getBusinessAccountGifts';
    }

    public function validate(): void
    {
        // No specific validation other than type hints
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
        ] + $this->params;
    }
}
