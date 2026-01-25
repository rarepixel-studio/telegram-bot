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
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Method to send voice audio files.
 *
 * @link https://core.telegram.org/bots/api#sendvoice
 */
class SendVoiceRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'caption_entities',
        'suggested_post_parameters',
        'reply_markup',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param  InputFile|string  $voice  Audio file to send
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile|string $voice,
    ) {}

    /**
     * Unique identifier of the business connection on behalf of which the message will be sent.
     *
     * @return $this
     */
    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only.
     *
     * @return $this
     */
    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    /**
     * Identifier of the direct messages topic to which the message will be sent.
     *
     * @return $this
     */
    public function directMessagesTopicId(int $direct_messages_topic_id): self
    {
        $this->params['direct_messages_topic_id'] = $direct_messages_topic_id;

        return $this;
    }

    /**
     * Voice message caption, 0-1024 characters after entities parsing.
     *
     * @return $this
     */
    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    /**
     * Mode for parsing entities in the voice message caption.
     *
     * @return $this
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
     *
     * @return $this
     */
    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    /**
     * Duration of the voice message in seconds.
     *
     * @return $this
     */
    public function duration(int $duration): self
    {
        $this->params['duration'] = $duration;

        return $this;
    }

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     *
     * @return $this
     */
    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    /**
     * Protects the contents of the sent message from forwarding and saving.
     *
     * @return $this
     */
    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    /**
     * Allow paid broadcast for higher throughput.
     *
     * @return $this
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    /**
     * Unique identifier of the message effect to be added to the message.
     *
     * @return $this
     */
    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

        return $this;
    }

    /**
     * Suggested post parameters for direct messages chats.
     *
     * @param  SuggestedPostParameters|array  $suggested_post_parameters  Suggested post parameters
     * @return $this
     */
    public function suggestedPostParameters(SuggestedPostParameters|array $suggested_post_parameters): self
    {
        $this->params['suggested_post_parameters'] = $suggested_post_parameters;

        return $this;
    }

    /**
     * Description of the message to reply to.
     *
     * @return $this
     */
    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    /**
     * Additional interface options.
     *
     * @return $this
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'sendVoice';
    }

    /**
     * {@inheritDoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if (isset($this->params['parse_mode'], $this->params['caption_entities'])) {
            throw new TelegramValidationException('parse_mode cannot be used with caption_entities');
        }

        $this->validateSuggestedPostParameters($this->params);
        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    /**
     * {@inheritDoc}
     */
    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'voice' => $this->voice,
        ] + $this->params;
    }

    /**
     * Resolve the response into a Message object.
     */
    public function resolveResponse(mixed $response): Message
    {
        return new Message($response);
    }
}
