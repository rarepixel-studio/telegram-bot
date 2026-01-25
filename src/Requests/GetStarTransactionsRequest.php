<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getStarTransactions method.
 *
 * Use this method to get the bot's Star transactions.
 *
 * @link https://core.telegram.org/bots/api#getstartransactions
 */
class GetStarTransactionsRequest extends TelegramApiRequest
{
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
        return 'getStarTransactions';
    }

    public function validate(): void
    {
        // No mandatory parameters
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
