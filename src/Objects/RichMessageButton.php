<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Traits\ValidatesNestedObjects;

/**
 * Class RichMessageButton.
 *
 * This object represents a button in a RichMessage.
 *
 * @link https://core.telegram.org/bots/api#richmessagebutton
 */
class RichMessageButton extends BaseObject implements ClientConstructibleObjectInterface
{
    use ValidatesNestedObjects;

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'text' => RichText::class,
            'web_app' => WebAppInfo::class,
            'login_url' => LoginUrl::class,
            'switch_inline_query_chosen_chat' => SwitchInlineQueryChosenChat::class,
            'copy_text' => CopyTextButton::class,
            'disabled' => DisabledButton::class,
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
     * Create a RichMessageButton instance.
     *
     * @param  array<string, mixed>|string  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
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
     *
     * @param  RichText|array<string, mixed>|string  $text
     */
    public function withText(RichText|array|string $text): self
    {
        $this->items['text'] = $text;

        return $this;
    }

    /**
     * Set the color style of the button.
     */
    public function withStyle(?string $style): self
    {
        $this->items['style'] = $style;

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
     * Set the disabled button placeholder.
     *
     * @param  DisabledButton|array<string, mixed>|null  $disabled
     */
    public function withDisabled(DisabledButton|array|null $disabled): self
    {
        $this->items['disabled'] = $disabled;

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
            'disabled',
        ];

        $count = 0;
        foreach ($optionalKeys as $key) {
            if (array_key_exists($key, $this->items) && $this->items[$key] !== null) {
                $count++;
            }
        }

        if ($count !== 1) {
            throw new TelegramValidationException('Exactly one optional field must be set on RichMessageButton');
        }

        if (isset($this->items['style'])) {
            $style = $this->items['style'];
            $allowed = ['danger', 'success', 'primary', 'link'];
            if (! is_string($style) || ! in_array($style, $allowed, true)) {
                throw new TelegramValidationException('style must be one of danger, success, primary, or link');
            }

            if ($style === 'link' && ! isset($this->items['callback_data'])) {
                throw new TelegramValidationException('style "link" is allowed only for callback buttons');
            }
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
        $this->validateNested('disabled', DisabledButton::class);
    }

    /**
     * Text of the button.
     */
    public function getText(): mixed
    {
        return $this->items['text'];
    }

    /**
     * (Optional). Style of the button.
     */
    public function getStyle(): ?string
    {
        return $this->items['style'] ?? null;
    }

    /**
     * (Optional). URL to be opened.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * (Optional). Callback data.
     */
    public function getCallbackData(): ?string
    {
        return $this->items['callback_data'] ?? null;
    }

    /**
     * (Optional). Web App info.
     */
    public function getWebApp(): ?WebAppInfo
    {
        return $this->items['web_app'] ?? null;
    }

    /**
     * (Optional). Login URL.
     */
    public function getLoginUrl(): ?LoginUrl
    {
        return $this->items['login_url'] ?? null;
    }

    /**
     * (Optional). Inline query to insert.
     */
    public function getSwitchInlineQuery(): ?string
    {
        return $this->items['switch_inline_query'] ?? null;
    }

    /**
     * (Optional). Inline query to insert in current chat.
     */
    public function getSwitchInlineQueryCurrentChat(): ?string
    {
        return $this->items['switch_inline_query_current_chat'] ?? null;
    }

    /**
     * (Optional). Chosen chat switch options.
     */
    public function getSwitchInlineQueryChosenChat(): ?SwitchInlineQueryChosenChat
    {
        return $this->items['switch_inline_query_chosen_chat'] ?? null;
    }

    /**
     * (Optional). Copy text button description.
     */
    public function getCopyText(): ?CopyTextButton
    {
        return $this->items['copy_text'] ?? null;
    }

    /**
     * (Optional). Disabled button placeholder.
     */
    public function getDisabled(): ?DisabledButton
    {
        return $this->items['disabled'] ?? null;
    }
}
