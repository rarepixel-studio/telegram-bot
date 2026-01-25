<?php

namespace Telegram\Bot\Objects\InputContent;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;
use Telegram\Bot\Objects\LabeledPrice;

/**
 * Class InputInvoiceMessageContent.
 *
 * Represents the content of an invoice message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputinvoicemessagecontent
 */
class InputInvoiceMessageContent extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'prices' => LabeledPrice::class,
        ];
    }

    /**
     * Product name.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * Product description.
     */
    public function getDescription(): string
    {
        return $this->items['description'];
    }

    /**
     * Bot-defined invoice payload.
     */
    public function getPayload(): string
    {
        return $this->items['payload'];
    }

    /**
     * Payments provider token.
     */
    public function getProviderToken(): string
    {
        return $this->items['provider_token'];
    }

    /**
     * Three-letter ISO 4217 currency code.
     */
    public function getCurrency(): string
    {
        return $this->items['currency'];
    }

    /**
     * Price breakdown.
     *
     * @return array<int, LabeledPrice>
     */
    public function getPrices(): array
    {
        $prices = $this->items['prices'];

        if ($prices instanceof Collection) {
            return $prices->all();
        }

        return $prices;
    }

    /**
     * (Optional). The maximum accepted amount for tips in the smallest units of the currency.
     */
    public function getMaxTipAmount(): ?int
    {
        return $this->items['max_tip_amount'] ?? null;
    }

    /**
     * (Optional). Suggested amounts of tip in the smallest units of the currency.
     *
     * @return array<int, int>|null
     */
    public function getSuggestedTipAmounts(): ?array
    {
        return $this->items['suggested_tip_amounts'] ?? null;
    }

    /**
     * (Optional). JSON-serialized data about the invoice.
     */
    public function getProviderData(): ?string
    {
        return $this->items['provider_data'] ?? null;
    }

    /**
     * (Optional). URL of the product photo.
     */
    public function getPhotoUrl(): ?string
    {
        return $this->items['photo_url'] ?? null;
    }

    /**
     * (Optional). Photo size.
     */
    public function getPhotoSize(): ?int
    {
        return $this->items['photo_size'] ?? null;
    }

    /**
     * (Optional). Photo width.
     */
    public function getPhotoWidth(): ?int
    {
        return $this->items['photo_width'] ?? null;
    }

    /**
     * (Optional). Photo height.
     */
    public function getPhotoHeight(): ?int
    {
        return $this->items['photo_height'] ?? null;
    }

    /**
     * (Optional). Pass True if you require the user's full name.
     */
    public function getNeedName(): ?bool
    {
        return $this->items['need_name'] ?? null;
    }

    /**
     * (Optional). Pass True if you require the user's phone number.
     */
    public function getNeedPhoneNumber(): ?bool
    {
        return $this->items['need_phone_number'] ?? null;
    }

    /**
     * (Optional). Pass True if you require the user's email address.
     */
    public function getNeedEmail(): ?bool
    {
        return $this->items['need_email'] ?? null;
    }

    /**
     * (Optional). Pass True if you require the user's shipping address.
     */
    public function getNeedShippingAddress(): ?bool
    {
        return $this->items['need_shipping_address'] ?? null;
    }

    /**
     * (Optional). Pass True if you require the user's phone number to be sent to the provider.
     */
    public function getSendPhoneNumberToProvider(): ?bool
    {
        return $this->items['send_phone_number_to_provider'] ?? null;
    }

    /**
     * (Optional). Pass True if you require the user's email address to be sent to the provider.
     */
    public function getSendEmailToProvider(): ?bool
    {
        return $this->items['send_email_to_provider'] ?? null;
    }

    /**
     * (Optional). Pass True if the final price depends on the shipping method.
     */
    public function getIsFlexible(): ?bool
    {
        return $this->items['is_flexible'] ?? null;
    }
}
