<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Delete a regular gift owned by a managed business account.
 *
 * @link https://core.telegram.org/bots/api#deletebusinessaccountgift
 */
class DeleteBusinessAccountGiftRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Additional request parameters. */
    protected array $params = [];

    /**
     * @param  string  $businessConnectionId  Business connection identifier
     * @param  string  $ownedGiftId  Owned regular gift identifier
     */
    public function __construct(
        protected string $businessConnectionId,
        protected string $ownedGiftId,
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
        $businessConnectionId = $params['business_connection_id'] ?? null;
        if (! is_string($businessConnectionId)) {
            throw new TelegramValidationException('business_connection_id is required and must be a string');
        }

        $ownedGiftId = $params['owned_gift_id'] ?? null;
        if (! is_string($ownedGiftId)) {
            throw new TelegramValidationException('owned_gift_id is required and must be a string');
        }

        $request = new self($businessConnectionId, $ownedGiftId);
        $request->params = array_diff_key($params, array_flip(['business_connection_id', 'owned_gift_id']));

        return $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'deleteBusinessAccountGift';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->businessConnectionId === '' || $this->ownedGiftId === '') {
            throw new TelegramValidationException('business_connection_id and owned_gift_id cannot be empty');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return [
            'business_connection_id' => $this->businessConnectionId,
            'owned_gift_id' => $this->ownedGiftId,
        ] + $this->params;
    }
}
