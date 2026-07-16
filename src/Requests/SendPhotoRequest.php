<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;

/**
 * Method to send photos.
 *
 * @link https://core.telegram.org/bots/api#sendphoto
 */
class SendPhotoRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'caption_entities',
        'reply_markup',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  InputFile|string  $photo  Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data.
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile|string $photo,
    ) {}

    /**
     * Unique identifier of the business connection on behalf of which the message will be sent.
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * Photo caption (may also be used when resending photos by file_id), 0-1024 characters after entities parsing.
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * Mode for parsing entities in the photo caption.
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
     * A JSON-serialized list of special entities that appear in the caption.
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
     * Pass True if the photo needs to be covered with a spoiler animation.
     */
    public function hasSpoiler(bool $has_spoiler): self
    {
        $this->params['has_spoiler'] = $has_spoiler;

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
        return 'sendPhoto';
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
            'photo' => $this->photo,
        ] + $this->params;
    }

    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }

    public function receiverUserId(int $receiver_user_id): self
    {
        $this->params['receiver_user_id'] = $receiver_user_id;

        return $this;
    }

    public function callbackQueryId(string $callback_query_id): self
    {
        $this->params['callback_query_id'] = $callback_query_id;

        return $this;
    }
}
