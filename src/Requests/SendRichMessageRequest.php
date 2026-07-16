<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InputRichMessage;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Request object for the sendRichMessage method.
 *
 * @link https://core.telegram.org/bots/api#sendrichmessage
 */
class SendRichMessageRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'rich_message',
        'suggested_post_parameters',
        'reply_parameters',
        'reply_markup',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username
     * @param  InputRichMessage|array  $rich_message  The rich message to be sent
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputRichMessage|array $rich_message,
    ) {}

    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    public function messageThreadId(int $message_thread_id): self
    {
        $this->params['message_thread_id'] = $message_thread_id;

        return $this;
    }

    public function directMessagesTopicId(int $direct_messages_topic_id): self
    {
        $this->params['direct_messages_topic_id'] = $direct_messages_topic_id;

        return $this;
    }

    public function disableNotification(bool $disable_notification): self
    {
        $this->params['disable_notification'] = $disable_notification;

        return $this;
    }

    public function protectContent(bool $protect_content): self
    {
        $this->params['protect_content'] = $protect_content;

        return $this;
    }

    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

        return $this;
    }

    public function suggestedPostParameters(SuggestedPostParameters|array $suggested_post_parameters): self
    {
        $this->params['suggested_post_parameters'] = $suggested_post_parameters;

        return $this;
    }

    public function replyParameters(ReplyParameters|array $reply_parameters): self
    {
        $this->params['reply_parameters'] = $reply_parameters;

        return $this;
    }

    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendRichMessage';
    }

    public function validate(): void
    {
        if (is_array($this->rich_message)) {
            $this->rich_message = InputRichMessage::fromArray($this->rich_message);
        }

        $this->rich_message->validate();
        $this->validateSuggestedPostParameters($this->params);
        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'rich_message' => $this->rich_message,
        ] + $this->params;
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
