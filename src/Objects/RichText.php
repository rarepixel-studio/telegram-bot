<?php

namespace Telegram\Bot\Objects;

/**
 * Class RichText.
 *
 * Represents rich formatted text.
 *
 * @link https://core.telegram.org/bots/api#richtext
 */
class RichText extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'text' => self::class,
            'user' => User::class,
        ];
    }

    /**
     * Type of the rich text.
     */
    public function getType(): ?string
    {
        return $this->items['type'] ?? null;
    }

    /**
     * Text content or nested rich text.
     */
    public function getText(): mixed
    {
        return $this->items['text'] ?? null;
    }

    /**
     * (Optional). URL for URL rich text.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * (Optional). User for text mention rich text.
     */
    public function getUser(): ?User
    {
        return $this->items['user'] ?? null;
    }

    /**
     * (Optional). Custom emoji identifier.
     */
    public function getCustomEmojiId(): ?string
    {
        return $this->items['custom_emoji_id'] ?? null;
    }

    /**
     * (Optional). Unix timestamp for date-time rich text.
     */
    public function getTimestamp(): ?int
    {
        return $this->items['unix_time'] ?? $this->items['timestamp'] ?? null;
    }

    /**
     * (Optional). The formatting string for date-time rich text.
     */
    public function getDateTimeFormat(): ?string
    {
        return $this->items['date_time_format'] ?? null;
    }

    /**
     * (Optional). LaTeX expression.
     */
    public function getExpression(): ?string
    {
        return $this->items['expression'] ?? null;
    }

    /**
     * (Optional). Alternative emoji text for custom emoji.
     */
    public function getAlternativeText(): ?string
    {
        return $this->items['alternative_text'] ?? null;
    }

    /**
     * (Optional). Email address.
     */
    public function getEmailAddress(): ?string
    {
        return $this->items['email_address'] ?? null;
    }

    /**
     * (Optional). Phone number.
     */
    public function getPhoneNumber(): ?string
    {
        return $this->items['phone_number'] ?? null;
    }

    /**
     * (Optional). Bank card number.
     */
    public function getBankCardNumber(): ?string
    {
        return $this->items['bank_card_number'] ?? null;
    }

    /**
     * (Optional). Username.
     */
    public function getUsername(): ?string
    {
        return $this->items['username'] ?? null;
    }

    /**
     * (Optional). Hashtag.
     */
    public function getHashtag(): ?string
    {
        return $this->items['hashtag'] ?? null;
    }

    /**
     * (Optional). Cashtag.
     */
    public function getCashtag(): ?string
    {
        return $this->items['cashtag'] ?? null;
    }

    /**
     * (Optional). Bot command.
     */
    public function getBotCommand(): ?string
    {
        return $this->items['bot_command'] ?? null;
    }

    /**
     * (Optional). Anchor or reference name.
     */
    public function getName(): ?string
    {
        return $this->items['name'] ?? null;
    }

    /**
     * (Optional). Anchor name.
     */
    public function getAnchorName(): ?string
    {
        return $this->items['anchor_name'] ?? null;
    }

    /**
     * (Optional). Reference name.
     */
    public function getReferenceName(): ?string
    {
        return $this->items['reference_name'] ?? null;
    }

    /**
     * (Optional). Referenced entity type.
     */
    public function getTextEntityType(): ?string
    {
        return $this->items['text_entity_type'] ?? null;
    }
}
