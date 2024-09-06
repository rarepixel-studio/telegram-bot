<?php

namespace Telegram\Bot\MethodObjects;

namespace Telegram\Bot\MethodObjects;

use Telegram\Bot\Objects\LinkPreviewOptions;

class SendMessage
{
    private int|string $chat_id;
    private string $text;

    private ?string $business_connection_id = null;
    private ?int $message_thread_id = null;
    private ?string $parse_mode = null;
    private ?array $entities = null;
    private ?LinkPreviewOptions $link_preview_options = null;
    private ?bool $disable_notification = null;
    private ?bool $protect_content = null;
    private ?string $message_effect_id = null;
    private ?object $reply_parameters = null;
    private ?object $reply_markup = null;

    // Constructor with required parameters
    public function __construct(int|string $chat_id, string $text)
    {
        $this->chat_id = $chat_id;
        $this->text = $text;
    }

    // Getters and setters for required parameters
    public function getChatId(): int|string
    {
        return $this->chat_id;
    }

    public function setChatId(int|string $chat_id): void
    {
        $this->chat_id = $chat_id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    // Getters and setters for optional parameters
    public function getBusinessConnectionId(): ?string
    {
        return $this->business_connection_id;
    }

    public function setBusinessConnectionId(?string $business_connection_id): void
    {
        $this->business_connection_id = $business_connection_id;
    }

    public function getMessageThreadId(): ?int
    {
        return $this->message_thread_id;
    }

    public function setMessageThreadId(?int $message_thread_id): void
    {
        $this->message_thread_id = $message_thread_id;
    }

    public function getParseMode(): ?string
    {
        return $this->parse_mode;
    }

    public function setParseMode(?string $parse_mode): void
    {
        $this->parse_mode = $parse_mode;
    }

    public function getEntities(): ?array
    {
        return $this->entities;
    }

    public function setEntities(?array $entities): void
    {
        $this->entities = $entities;
    }

    public function getLinkPreviewOptions(): ?LinkPreviewOptions
    {
        return $this->link_preview_options;
    }

    public function setLinkPreviewOptions(?object $link_preview_options): void
    {
        $this->link_preview_options = $link_preview_options;
    }

    public function getDisableNotification(): ?bool
    {
        return $this->disable_notification;
    }

    public function setDisableNotification(?bool $disable_notification): void
    {
        $this->disable_notification = $disable_notification;
    }

    public function getProtectContent(): ?bool
    {
        return $this->protect_content;
    }

    public function setProtectContent(?bool $protect_content): void
    {
        $this->protect_content = $protect_content;
    }

    public function getMessageEffectId(): ?string
    {
        return $this->message_effect_id;
    }

    public function setMessageEffectId(?string $message_effect_id): void
    {
        $this->message_effect_id = $message_effect_id;
    }

    public function getReplyParameters(): ?object
    {
        return $this->reply_parameters;
    }

    public function setReplyParameters(?object $reply_parameters): void
    {
        $this->reply_parameters = $reply_parameters;
    }

    public function getReplyMarkup(): ?object
    {
        return $this->reply_markup;
    }

    public function setReplyMarkup(?object $reply_markup): void
    {
        $this->reply_markup = $reply_markup;
    }
}
