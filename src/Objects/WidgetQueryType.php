<?php

namespace Telegram\Bot\Objects;

/**
 * The kind of query sent by a widget.
 *
 * @link https://core.telegram.org/bots/api#widgetquerytype
 */
class WidgetQueryType extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Hydrate the variant identified by Telegram.
     *
     * @param  array<string, mixed>  $data  The Telegram object payload
     * @return static The hydrated object
     */
    public static function fromArray(array $data): static
    {
        if (static::class !== self::class) {
            return parent::fromArray($data);
        }

        return match ($data['type'] ?? null) {
            'data' => new WidgetQueryTypeData($data),
            'sign_data' => new WidgetQueryTypeSignData($data),
            'sent_transaction' => new WidgetQueryTypeSentTransaction($data),
            default => new self($data),
        };
    }

    /**
     * The variant discriminator.
     */
    public function getType(): ?string
    {
        return $this->items['type'] ?? null;
    }
}
