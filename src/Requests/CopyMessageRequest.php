<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\MessageId;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;

/**
 * Method to copy messages of any kind.
 *
 * @link https://core.telegram.org/bots/api#copymessage
 */
class CopyMessageRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  int|string  $from_chat_id  Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param  int  $message_id  Message identifier in the chat specified in from_chat_id
     */
    public function __construct(
        protected int|string $chat_id,
        protected int|string $from_chat_id,
        protected int $message_id,
    ) {}

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept.
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * Mode for parsing entities in the new caption.
     *
     * @throws TelegramValidationException
     */
    public function parseMode(ParseMode|string $parse_mode): self
    {
        if (is_string($parse_mode)) {
            try {
                $parse_mode = ParseMode::from($parse_mode);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid parse_mode provided', previous: $exception);
            }
        }

        $this->params['parse_mode'] = $parse_mode;

        return $this;
    }

    /**
     * A JSON-serialized list of special entities that appear in the new caption.
     */
    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    /**
     * Pass True, if the caption must be shown above the message media.
     */
    public function showCaptionAboveMedia(bool $show_caption_above_media): self
    {
        $this->params['show_caption_above_media'] = $show_caption_above_media;

        return $this;
    }

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the sent message from forwarding and saving.
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * Description of the message to reply to.
     */
    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    /**
     * Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard,
     * instructions to remove a reply keyboard or to force a reply from the user.
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'copyMessage';
    }

    public function validate(): void
    {
        if (isset($this->params['parse_mode'], $this->params['caption_entities'])) {
            throw new TelegramValidationException('parse_mode cannot be used with caption_entities');
        }

        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'from_chat_id' => $this->from_chat_id,
            'message_id' => $this->message_id,
        ] + $this->params;
    }

    public function resolveResponse(mixed $response): MessageId
    {
        return new MessageId($response);
    }
}
