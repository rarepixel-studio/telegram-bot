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
 * Method to send general files.
 *
 * @link https://core.telegram.org/bots/api#senddocument
 */
class SendDocumentRequest extends TelegramApiRequest
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
     * @param  InputFile|string  $document  File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile|string $document,
    ) {}

    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection on behalf of which the message will be sent
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * @param  int  $message_thread_id  Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * @param  string  $caption  Document caption (may also be used when resending documents by file_id), 0-1024 characters after entities parsing
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * @param  ParseMode|string  $parse_mode  Mode for parsing entities in the document caption.
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
     * @param  array  $caption_entities  A JSON-serialized list of special entities that appear in the caption
     */
    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    /**
     * @param  InputFile|string  $thumbnail  Thumbnail of the file sent
     */
    public function thumbnail(InputFile|string $thumbnail): self
    {
        $this->params['thumbnail'] = $thumbnail;

        return $this;
    }

    /**
     * @param  bool  $disable_content_type_detection  Disables automatic server-side content type detection for files uploaded using multipart/form-data
     */
    public function disableContentTypeDetection(bool $disable_content_type_detection): self
    {
        $this->params['disable_content_type_detection'] = $disable_content_type_detection;

        return $this;
    }

    /**
     * @param  bool  $disable_notification  Sends the message silently. Users will receive a notification with no sound.
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * @param  bool  $protect_content  Protects the contents of the sent message from forwarding and saving
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * @param  ReplyParameters|array  $reply_parameters  Description of the message to reply to
     */
    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    /**
     * @param  InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array  $reply_markup  Additional interface options
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendDocument';
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
            'document' => $this->document,
        ] + $this->params;
    }

    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }
}
