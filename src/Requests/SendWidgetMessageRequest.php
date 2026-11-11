<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\MessageEntity;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;

/**
 * Common options for sending new and shared widget messages.
 */
abstract class SendWidgetMessageRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Optional API parameters. */
    protected array $params = [];

    /** @var list<string> Parameters to encode as JSON for API calls. */
    protected array $jsonSerializedFields = ['caption_entities', 'reply_parameters', 'reply_markup'];

    /**
     * Set the target topic identifier.
     *
     * @param  int  $messageThreadId  Target topic identifier
     * @return $this
     */
    public function messageThreadId(int $messageThreadId): self
    {
        $this->params['message_thread_id'] = $messageThreadId;

        return $this;
    }

    /**
     * Set the data specific to this widget message.
     *
     * @param  string  $chatData  Data specific to this widget message
     * @return $this
     */
    public function chatData(string $chatData): self
    {
        $this->params['chat_data'] = $chatData;

        return $this;
    }

    /**
     * Set the widget caption.
     *
     * @param  string  $caption  Widget caption
     * @return $this
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * Set the formatting mode for the caption.
     *
     * @param  ParseMode|string  $parseMode  Formatting mode for the caption
     * @return $this
     *
     * @throws TelegramValidationException
     */
    public function parseMode(ParseMode|string $parseMode): self
    {
        $mode = $parseMode instanceof ParseMode ? $parseMode : ParseMode::tryFrom($parseMode);
        if ($mode === null) {
            throw new TelegramValidationException('Invalid parse_mode provided');
        }

        $this->params['parse_mode'] = $mode;

        return $this;
    }

    /**
     * Set the entities in the caption.
     *
     * @param  list<MessageEntity|array<string, mixed>>  $captionEntities  Entities in the caption
     * @return $this
     */
    public function captionEntities(array $captionEntities): self
    {
        $this->params['caption_entities'] = $captionEntities;

        return $this;
    }

    /**
     * Set the whether to display the caption above the widget.
     *
     * @param  bool  $showCaptionAboveMedia  Whether to display the caption above the widget
     * @return $this
     */
    public function showCaptionAboveMedia(bool $showCaptionAboveMedia): self
    {
        $this->params['show_caption_above_media'] = $showCaptionAboveMedia;

        return $this;
    }

    /**
     * Set the whether to send the message silently.
     *
     * @param  bool  $disableNotification  Whether to send the message silently
     * @return $this
     */
    public function disableNotification(bool $disableNotification): self
    {
        $this->params['disable_notification'] = $disableNotification;

        return $this;
    }

    /**
     * Set the whether to protect the message from forwarding and saving.
     *
     * @param  bool  $protectContent  Whether to protect the message from forwarding and saving
     * @return $this
     */
    public function protectContent(bool $protectContent): self
    {
        $this->params['protect_content'] = $protectContent;

        return $this;
    }

    /**
     * Set the whether to allow Telegram to charge Stars for paid broadcasting.
     *
     * @param  bool  $allowPaidBroadcast  Whether to allow Telegram to charge Stars for paid broadcasting
     * @return $this
     */
    public function allowPaidBroadcast(bool $allowPaidBroadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allowPaidBroadcast;

        return $this;
    }

    /**
     * Set the effect to display in a private chat.
     *
     * @param  string  $messageEffectId  Effect to display in a private chat
     * @return $this
     */
    public function messageEffectId(string $messageEffectId): self
    {
        $this->params['message_effect_id'] = $messageEffectId;

        return $this;
    }

    /**
     * Set the message to reply to.
     *
     * @param  ReplyParameters|array  $replyParameters  Message to reply to
     * @return $this
     */
    public function replyParameters(ReplyParameters|array $replyParameters): self
    {
        $this->params['reply_parameters'] = $replyParameters;

        return $this;
    }

    /**
     * Set the keyboard or reply instructions.
     *
     * @param  InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array  $replyMarkup  Keyboard or reply instructions
     * @return $this
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $replyMarkup): self
    {
        $this->params['reply_markup'] = $replyMarkup;

        return $this;
    }

    /**
     * Validate the options common to widget messages.
     *
     * @throws TelegramValidationException
     */
    protected function validateWidgetMessageOptions(): void
    {
        if (isset($this->params['parse_mode'], $this->params['caption_entities'])) {
            throw new TelegramValidationException('parse_mode cannot be used with caption_entities');
        }

        $caption = $this->params['caption'] ?? null;
        if ($caption !== null && ! is_string($caption)) {
            throw new TelegramValidationException('caption must be a string');
        }

        if ($caption !== null && ! isset($this->params['parse_mode']) && mb_strlen($caption) > 1024) {
            throw new TelegramValidationException('caption must not exceed 1024 characters');
        }

        if (isset($this->params['chat_data']) && (! is_string($this->params['chat_data']) || strlen($this->params['chat_data']) > 1024)) {
            throw new TelegramValidationException('chat_data must be a string of up to 1024 bytes');
        }

        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }
}
