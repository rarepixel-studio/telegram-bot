<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Traits\ValidatesNestedObjects;

/**
 * Class InlineKeyboardButton.
 *
 * This object represents one button of an inline keyboard.
 */
class InlineKeyboardButton extends BaseObject implements ClientConstructibleObjectInterface
{
    use ValidatesNestedObjects;

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'web_app' => WebAppInfo::class,
            'login_url' => LoginUrl::class,
            'switch_inline_query_chosen_chat' => SwitchInlineQueryChosenChat::class,
            'copy_text' => CopyTextButton::class,
            'callback_game' => CallbackGame::class,
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
     * Create an InlineKeyboardButton instance.
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
     * Set the URL to be opened.
     */
    public function withUrl(?string $url): self
    {
        $this->items['url'] = $url;

        return $this;
    }

    /**
     * Set the callback data.
     */
    public function withCallbackData(?string $callbackData): self
    {
        $this->items['callback_data'] = $callbackData;

        return $this;
    }

    /**
     * Set the Web App info.
     *
     * @param  WebAppInfo|array<string, mixed>|null  $webApp
     */
    public function withWebApp(WebAppInfo|array|null $webApp): self
    {
        $this->items['web_app'] = $webApp;

        return $this;
    }

    /**
     * Set the Login URL.
     *
     * @param  LoginUrl|array<string, mixed>|null  $loginUrl
     */
    public function withLoginUrl(LoginUrl|array|null $loginUrl): self
    {
        $this->items['login_url'] = $loginUrl;

        return $this;
    }

    /**
     * Set the inline query to insert.
     */
    public function withSwitchInlineQuery(?string $switchInlineQuery): self
    {
        $this->items['switch_inline_query'] = $switchInlineQuery;

        return $this;
    }

    /**
     * Set the inline query to insert in current chat.
     */
    public function withSwitchInlineQueryCurrentChat(?string $switchInlineQueryCurrentChat): self
    {
        $this->items['switch_inline_query_current_chat'] = $switchInlineQueryCurrentChat;

        return $this;
    }

    /**
     * Set the chosen chat switch options.
     *
     * @param  SwitchInlineQueryChosenChat|array<string, mixed>|null  $switchInlineQueryChosenChat
     */
    public function withSwitchInlineQueryChosenChat(SwitchInlineQueryChosenChat|array|null $switchInlineQueryChosenChat): self
    {
        $this->items['switch_inline_query_chosen_chat'] = $switchInlineQueryChosenChat;

        return $this;
    }

    /**
     * Set the copy text button.
     *
     * @param  CopyTextButton|array<string, mixed>|null  $copyText
     */
    public function withCopyText(CopyTextButton|array|null $copyText): self
    {
        $this->items['copy_text'] = $copyText;

        return $this;
    }

    /**
     * Set the callback game.
     *
     * @param  CallbackGame|array<string, mixed>|null  $callbackGame
     */
    public function withCallbackGame(CallbackGame|array|null $callbackGame): self
    {
        $this->items['callback_game'] = $callbackGame;

        return $this;
    }

    /**
     * Set whether this is a Pay button.
     */
    public function withPay(?bool $pay): self
    {
        $this->items['pay'] = $pay;

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

        $optionalKeys = [
            'url',
            'callback_data',
            'web_app',
            'login_url',
            'switch_inline_query',
            'switch_inline_query_current_chat',
            'switch_inline_query_chosen_chat',
            'copy_text',
            'callback_game',
        ];

        $count = 0;
        foreach ($optionalKeys as $key) {
            if (array_key_exists($key, $this->items) && $this->items[$key] !== null) {
                $count++;
            }
        }

        if (($this->items['pay'] ?? null) === true) {
            $count++;
        }

        if ($count !== 1) {
            throw new TelegramValidationException('Exactly one optional field must be set on InlineKeyboardButton');
        }

        if (isset($this->items['callback_data'])) {
            $callbackData = $this->items['callback_data'];
            if (! is_string($callbackData) || $callbackData === '' || strlen($callbackData) > 64) {
                throw new TelegramValidationException('callback_data must be 1-64 bytes');
            }
        }

        $this->validateNested('web_app', WebAppInfo::class);
        $this->validateNested('login_url', LoginUrl::class);
        $this->validateNested('switch_inline_query_chosen_chat', SwitchInlineQueryChosenChat::class);
        $this->validateNested('copy_text', CopyTextButton::class);
        $this->validateNested('callback_game', CallbackGame::class);
    }

    /**
     * Label text on the button.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * URL to be opened.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * Callback data.
     */
    public function getCallbackData(): ?string
    {
        return $this->items['callback_data'] ?? null;
    }

    /**
     * Web App info.
     */
    public function getWebApp(): ?WebAppInfo
    {
        return $this->items['web_app'] ?? null;
    }

    /**
     * Login URL.
     */
    public function getLoginUrl(): ?LoginUrl
    {
        return $this->items['login_url'] ?? null;
    }

    /**
     * Inline query to insert.
     */
    public function getSwitchInlineQuery(): ?string
    {
        return $this->items['switch_inline_query'] ?? null;
    }

    /**
     * Inline query to insert in current chat.
     */
    public function getSwitchInlineQueryCurrentChat(): ?string
    {
        return $this->items['switch_inline_query_current_chat'] ?? null;
    }

    /**
     * Chosen chat switch options.
     */
    public function getSwitchInlineQueryChosenChat(): ?SwitchInlineQueryChosenChat
    {
        return $this->items['switch_inline_query_chosen_chat'] ?? null;
    }

    /**
     * Copy text button description.
     */
    public function getCopyText(): ?CopyTextButton
    {
        return $this->items['copy_text'] ?? null;
    }

    /**
     * Callback game description.
     */
    public function getCallbackGame(): ?CallbackGame
    {
        return $this->items['callback_game'] ?? null;
    }

    /**
     * True if this is a Pay button.
     */
    public function getPay(): ?bool
    {
        return $this->items['pay'] ?? null;
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
