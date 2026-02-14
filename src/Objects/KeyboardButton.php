<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Traits\ValidatesNestedObjects;

/**
 * Class KeyboardButton.
 *
 * This object represents one button of the reply keyboard.
 */
class KeyboardButton extends BaseObject implements ClientConstructibleObjectInterface
{
    use ValidatesNestedObjects;

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'request_users' => KeyboardButtonRequestUsers::class,
            'request_chat' => KeyboardButtonRequestChat::class,
            'request_poll' => KeyboardButtonPollType::class,
            'web_app' => WebAppInfo::class,
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
     * Create a KeyboardButton instance.
     *
     * @param  array<string, mixed>|string  $items
     */
    public static function make($items = []): self
    {
        if (is_string($items)) {
            return new self(['text' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the button text.
     */
    public function withText(string $text): self
    {
        $this->items['text'] = $text;

        return $this;
    }

    /**
     * Set request users criteria.
     *
     * @param  KeyboardButtonRequestUsers|array<string, mixed>|null  $requestUsers
     */
    public function withRequestUsers(KeyboardButtonRequestUsers|array|null $requestUsers): self
    {
        $this->items['request_users'] = $requestUsers;

        return $this;
    }

    /**
     * Set request chat criteria.
     *
     * @param  KeyboardButtonRequestChat|array<string, mixed>|null  $requestChat
     */
    public function withRequestChat(KeyboardButtonRequestChat|array|null $requestChat): self
    {
        $this->items['request_chat'] = $requestChat;

        return $this;
    }

    /**
     * Request the user's contact.
     */
    public function withRequestContact(?bool $requestContact): self
    {
        $this->items['request_contact'] = $requestContact;

        return $this;
    }

    /**
     * Request the user's location.
     */
    public function withRequestLocation(?bool $requestLocation): self
    {
        $this->items['request_location'] = $requestLocation;

        return $this;
    }

    /**
     * Set request poll type.
     *
     * @param  KeyboardButtonPollType|array<string, mixed>|null  $requestPoll
     */
    public function withRequestPoll(KeyboardButtonPollType|array|null $requestPoll): self
    {
        $this->items['request_poll'] = $requestPoll;

        return $this;
    }

    /**
     * Set Web App info.
     *
     * @param  WebAppInfo|array<string, mixed>|null  $webApp
     */
    public function withWebApp(WebAppInfo|array|null $webApp): self
    {
        $this->items['web_app'] = $webApp;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['text'])) {
            throw new TelegramValidationException('text is required');
        }

        $count = 0;

        if (array_key_exists('request_users', $this->items) && $this->items['request_users'] !== null) {
            $count++;
        }
        if (array_key_exists('request_chat', $this->items) && $this->items['request_chat'] !== null) {
            $count++;
        }
        if (($this->items['request_contact'] ?? null) === true) {
            $count++;
        }
        if (($this->items['request_location'] ?? null) === true) {
            $count++;
        }
        if (array_key_exists('request_poll', $this->items) && $this->items['request_poll'] !== null) {
            $count++;
        }
        if (array_key_exists('web_app', $this->items) && $this->items['web_app'] !== null) {
            $count++;
        }

        if ($count > 1) {
            throw new TelegramValidationException('At most one optional field must be set on KeyboardButton');
        }

        $this->validateNested('request_users', KeyboardButtonRequestUsers::class);
        $this->validateNested('request_chat', KeyboardButtonRequestChat::class);
        $this->validateNested('request_poll', KeyboardButtonPollType::class);
        $this->validateNested('web_app', WebAppInfo::class);
    }

    /**
     * Text of the button.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * Request users criteria.
     */
    public function getRequestUsers(): ?KeyboardButtonRequestUsers
    {
        return $this->items['request_users'] ?? null;
    }

    /**
     * Request chat criteria.
     */
    public function getRequestChat(): ?KeyboardButtonRequestChat
    {
        return $this->items['request_chat'] ?? null;
    }

    /**
     * True if contact should be requested.
     */
    public function getRequestContact(): ?bool
    {
        return $this->items['request_contact'] ?? null;
    }

    /**
     * True if location should be requested.
     */
    public function getRequestLocation(): ?bool
    {
        return $this->items['request_location'] ?? null;
    }

    /**
     * Request poll type.
     */
    public function getRequestPoll(): ?KeyboardButtonPollType
    {
        return $this->items['request_poll'] ?? null;
    }

    /**
     * Web App info.
     */
    public function getWebApp(): ?WebAppInfo
    {
        return $this->items['web_app'] ?? null;
    }

    /**
     * (Optional). Custom emoji identifier to be shown on the button.
     */
    public function getIconCustomEmojiId(): ?string
    {
        return $this->items['icon_custom_emoji_id'] ?? null;
    }

    /**
     * Set the custom emoji identifier to be shown on the button.
     */
    public function withIconCustomEmojiId(?string $iconCustomEmojiId): self
    {
        $this->items['icon_custom_emoji_id'] = $iconCustomEmojiId;

        return $this;
    }

    /**
     * (Optional). The color style of the button.
     */
    public function getStyle(): ?string
    {
        return $this->items['style'] ?? null;
    }

    /**
     * Set the color style of the button.
     */
    public function withStyle(?string $style): self
    {
        $this->items['style'] = $style;

        return $this;
    }
}
