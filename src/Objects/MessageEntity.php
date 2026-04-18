<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class MessageEntity.
 *
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *

 *                          “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org),
 *                          “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123),
 *                          “bold” (bold text), “italic” (italic text), “underline” (underlined text),
 *                          “strikethrough” (strikethrough text), “spoiler” (spoiler message),
 *                          “blockquote” (block quotation), “expandable_blockquote” (collapsed-by-default block quotation),
 *                          “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs),
 *                          “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers).
 */
class MessageEntity extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * Define the relations between objects.
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Create a MessageEntity instance.
     *
     * @param  array<string, mixed>  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the URL for text_link entities.
     */
    public function withUrl(?string $url): self
    {
        $this->items['url'] = $url;

        return $this;
    }

    /**
     * Set the mentioned user for text_mention entities.
     *
     * @param  User|array<string, mixed>|null  $user
     */
    public function withUser(User|array|null $user): self
    {
        $this->items['user'] = $user;

        return $this;
    }

    /**
     * Set the programming language for pre entities.
     */
    public function withLanguage(?string $language): self
    {
        $this->items['language'] = $language;

        return $this;
    }

    /**
     * Set the custom emoji ID for custom_emoji entities.
     */
    public function withCustomEmojiId(?string $customEmojiId): self
    {
        $this->items['custom_emoji_id'] = $customEmojiId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['type'])) {
            throw new TelegramValidationException('type is required');
        }

        if (! isset($this->items['offset'])) {
            throw new TelegramValidationException('offset is required');
        }

        if (! isset($this->items['length'])) {
            throw new TelegramValidationException('length is required');
        }

        if (! is_int($this->items['offset']) || $this->items['offset'] < 0) {
            throw new TelegramValidationException('offset must be a non-negative integer');
        }

        if (! is_int($this->items['length']) || $this->items['length'] <= 0) {
            throw new TelegramValidationException('length must be a positive integer');
        }

        if ($this->items['type'] === 'text_link' && empty($this->items['url'])) {
            throw new TelegramValidationException('url is required for text_link entities');
        }

        if ($this->items['type'] === 'text_mention' && empty($this->items['user'])) {
            throw new TelegramValidationException('user is required for text_mention entities');
        }

        if ($this->items['type'] === 'custom_emoji' && empty($this->items['custom_emoji_id'])) {
            throw new TelegramValidationException('custom_emoji_id is required for custom_emoji entities');
        }
    }

    /**
     * Check if the entity type is an HTML formatting entity.
     */
    public function isHtmlEntity(): bool
    {
        return in_array($this->getType(), [
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'spoiler',
            'blockquote',
            'expandable_blockquote',
            'code',
            'pre',
            'text_link',
        ]);
    }

    /**
     * Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag),
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * Offset in UTF-16 code units to the start of the entity.
     */
    public function getOffset(): int
    {
        return $this->items['offset'];
    }

    /**
     * Length of the entity in UTF-16 code units.
     */
    public function getLength(): int
    {
        return $this->items['length'];
    }

    /**
     * (Optional). For “text_link” only, URL that will be opened after user taps on the text.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * (Optional). For “text_mention” only, the mentioned user.
     */
    public function getUser(): ?User
    {
        return $this->items['user'] ?? null;
    }

    /**
     * (Optional). For “pre” only, the programming language of the entity text.
     */
    public function getLanguage(): ?string
    {
        return $this->items['language'] ?? null;
    }

    /**
     * (Optional). For “custom_emoji” only, unique identifier of the custom emoji.
     */
    public function getCustomEmojiId(): ?string
    {
        return $this->items['custom_emoji_id'] ?? null;
    }
}
