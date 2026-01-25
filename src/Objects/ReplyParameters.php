<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class ReplyParameters.
 *
 * Describes reply parameters for the message that is being sent.
 */
class ReplyParameters extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * Define the relations between objects.
     */
    public function relations(): array
    {
        return [
            'quote_entities' => MessageEntity::class,
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
     * Create a ReplyParameters instance.
     *
     * @param  array<string, mixed>|int  $items
     */
    public static function make($items = []): self
    {
        if (is_int($items)) {
            return new self(['message_id' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the chat identifier for the replied message.
     */
    public function withChatId(int|string|null $chatId): self
    {
        $this->items['chat_id'] = $chatId;

        return $this;
    }

    /**
     * Set whether to allow sending without reply.
     */
    public function withAllowSendingWithoutReply(?bool $allowSendingWithoutReply): self
    {
        $this->items['allow_sending_without_reply'] = $allowSendingWithoutReply;

        return $this;
    }

    /**
     * Set the quoted text.
     */
    public function withQuote(?string $quote): self
    {
        $this->items['quote'] = $quote;

        return $this;
    }

    /**
     * Set the parse mode for the quote.
     *
     * @throws TelegramValidationException
     */
    public function withQuoteParseMode(ParseMode|string|null $quoteParseMode): self
    {
        if (is_string($quoteParseMode)) {
            try {
                $quoteParseMode = ParseMode::from($quoteParseMode);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid quote_parse_mode provided', previous: $exception);
            }
        }

        $this->items['quote_parse_mode'] = $quoteParseMode;

        return $this;
    }

    /**
     * Set the quote entities.
     *
     * @param  array<int, MessageEntity|array<string, mixed>>|null  $quoteEntities
     */
    public function withQuoteEntities(?array $quoteEntities): self
    {
        $this->items['quote_entities'] = $quoteEntities;

        return $this;
    }

    /**
     * Set the quote position.
     */
    public function withQuotePosition(?int $quotePosition): self
    {
        $this->items['quote_position'] = $quotePosition;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['message_id'])) {
            throw new TelegramValidationException('message_id is required');
        }

        if (isset($this->items['quote_parse_mode'], $this->items['quote_entities'])) {
            throw new TelegramValidationException('quote_parse_mode cannot be used with quote_entities');
        }
    }

    /**
     * Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified.
     */
    public function getMessageId(): int
    {
        return $this->items['message_id'];
    }

    /**
     * (Optional). If the message to be replied to is from a different chat, unique identifier for the chat or username of the channel (in the format @channelusername). Not supported for messages sent on behalf of a business account.
     */
    public function getChatId(): int|string|null
    {
        return $this->items['chat_id'] ?? null;
    }

    /**
     * (Optional). Pass True if the message should be sent even if the specified message to be replied to is not found. Always False for replies in another chat or forum topic. Always True for messages sent on behalf of a business account.
     */
    public function getAllowSendingWithoutReply(): ?bool
    {
        return $this->items['allow_sending_without_reply'] ?? null;
    }

    /**
     * (Optional). Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, and custom_emoji entities.
     */
    public function getQuote(): ?string
    {
        return $this->items['quote'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the quote. See formatting options for more details.
     */
    public function getQuoteParseMode(): ?string
    {
        return $this->items['quote_parse_mode'] ?? null;
    }

    /**
     * (Optional). A JSON-serialized list of special entities that appear in the quote. It can be specified instead of quote_parse_mode.
     */
    public function getQuoteEntities(): ?array
    {
        return $this->items['quote_entities'] ?? null;
    }

    /**
     * (Optional). Position of the quote in the original message in UTF-16 code units.
     */
    public function getQuotePosition(): ?int
    {
        return $this->items['quote_position'] ?? null;
    }
}
