<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getUserGifts method.
 *
 * Returns the gifts owned and hosted by a user. Returns OwnedGifts on success.
 *
 * @link https://core.telegram.org/bots/api#getusergifts
 */
class GetUserGiftsRequest extends TelegramApiRequest
{
    /** @var int Unique identifier of the user */
    protected int $userId;

    /** @var bool|null Pass True to exclude gifts that can be purchased an unlimited number of times */
    protected ?bool $excludeUnlimited = null;

    /** @var bool|null Pass True to exclude gifts that can be purchased a limited number of times and can be upgraded to unique */
    protected ?bool $excludeLimitedUpgradable = null;

    /** @var bool|null Pass True to exclude gifts that can be purchased a limited number of times and can't be upgraded to unique */
    protected ?bool $excludeLimitedNonUpgradable = null;

    /** @var bool|null Pass True to exclude gifts that were assigned from the TON blockchain */
    protected ?bool $excludeFromBlockchain = null;

    /** @var bool|null Pass True to exclude unique gifts */
    protected ?bool $excludeUnique = null;

    /** @var bool|null Pass True to sort results by gift price instead of send date */
    protected ?bool $sortByPrice = null;

    /** @var string|null Offset of the first entry to return */
    protected ?string $offset = null;

    /** @var int|null The maximum number of gifts to be returned; 1-100 */
    protected ?int $limit = null;

    /**
     * GetUserGiftsRequest constructor.
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return $this
     */
    public function setExcludeUnlimited(bool $excludeUnlimited): self
    {
        $this->excludeUnlimited = $excludeUnlimited;

        return $this;
    }

    /**
     * @return $this
     */
    public function setExcludeLimitedUpgradable(bool $excludeLimitedUpgradable): self
    {
        $this->excludeLimitedUpgradable = $excludeLimitedUpgradable;

        return $this;
    }

    /**
     * @return $this
     */
    public function setExcludeLimitedNonUpgradable(bool $excludeLimitedNonUpgradable): self
    {
        $this->excludeLimitedNonUpgradable = $excludeLimitedNonUpgradable;

        return $this;
    }

    /**
     * @return $this
     */
    public function setExcludeFromBlockchain(bool $excludeFromBlockchain): self
    {
        $this->excludeFromBlockchain = $excludeFromBlockchain;

        return $this;
    }

    /**
     * @return $this
     */
    public function setExcludeUnique(bool $excludeUnique): self
    {
        $this->excludeUnique = $excludeUnique;

        return $this;
    }

    /**
     * @return $this
     */
    public function setSortByPrice(bool $sortByPrice): self
    {
        $this->sortByPrice = $sortByPrice;

        return $this;
    }

    /**
     * @return $this
     */
    public function setOffset(string $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the method name.
     */
    public function getMethod(): string
    {
        return 'getUserGifts';
    }

    /**
     * Validate the request.
     */
    public function validate(): void
    {
        // No validation required beyond type hints
    }

    /**
     * Get the request parameters.
     */
    protected function buildParams(): array
    {
        return [
            'user_id' => $this->userId,
            'exclude_unlimited' => $this->excludeUnlimited,
            'exclude_limited_upgradable' => $this->excludeLimitedUpgradable,
            'exclude_limited_non_upgradable' => $this->excludeLimitedNonUpgradable,
            'exclude_from_blockchain' => $this->excludeFromBlockchain,
            'exclude_unique' => $this->excludeUnique,
            'sort_by_price' => $this->sortByPrice,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ];
    }
}
