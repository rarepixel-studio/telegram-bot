<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\LinkPreviewOptions;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Request object for the sendMessage method.
 *
 * Use this method to send text messages. On success, the sent Message is returned.
 *
 * @link https://core.telegram.org/bots/api#sendmessage
 */
class SendMessageRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'entities',
        'suggested_post_parameters',
        'reply_markup',
    ];

    /** @var int|string Unique identifier for the target chat or username */
    protected int|string $chatId;

    /** @var string Text of the message to be sent, 1-4096 characters */
    protected string $text;

    /** @var string|null Unique identifier of the business connection */
    protected ?string $businessConnectionId = null;

    /** @var int|null Unique identifier for the target message thread (topic) */
    protected ?int $messageThreadId = null;

    /** @var int|null Identifier of the direct messages topic */
    protected ?int $directMessagesTopicId = null;

    /** @var ParseMode|null Mode for parsing entities in the message text */
    protected ?ParseMode $parseMode = null;

    /** @var array|null List of MessageEntity objects */
    protected ?array $entities = null;

    /** @var LinkPreviewOptions|array|null Link preview generation options */
    protected LinkPreviewOptions|array|null $linkPreviewOptions = null;

    /** @var bool|null Sends the message silently */
    protected ?bool $disableNotification = null;

    /** @var bool|null Protects the contents of the sent message */
    protected ?bool $protectContent = null;

    /** @var bool|null Allow up to 1000 messages per second */
    protected ?bool $allowPaidBroadcast = null;

    /** @var string|null Unique identifier of the message effect */
    protected ?string $messageEffectId = null;

    /** @var SuggestedPostParameters|array|null Parameters of the suggested post to send */
    protected SuggestedPostParameters|array|null $suggestedPostParameters = null;

    /** @var ReplyParameters|array|null Description of the message to reply to */
    protected ReplyParameters|array|null $replyParameters = null;

    /** @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array|null Additional interface options */
    protected InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array|null $replyMarkup = null;

    /**
     * Create a new SendMessageRequest instance.
     *
     * @param  int|string  $chatId  Unique identifier for the target chat or username
     * @param  string  $text  Text of the message to be sent, 1-4096 characters
     */
    public function __construct(int|string $chatId, string $text)
    {
        $this->chatId = $chatId;
        $this->text = $text;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'sendMessage';
    }

    /**
     * Set the business connection ID.
     *
     * @return $this
     */
    public function setBusinessConnectionId(string $businessConnectionId): self
    {
        $this->businessConnectionId = $businessConnectionId;

        return $this;
    }

    /**
     * Set the message thread ID.
     *
     * @return $this
     */
    public function setMessageThreadId(int $messageThreadId): self
    {
        $this->messageThreadId = $messageThreadId;

        return $this;
    }

    /**
     * Set the direct messages topic ID.
     *
     * @return $this
     */
    public function setDirectMessagesTopicId(int $directMessagesTopicId): self
    {
        $this->directMessagesTopicId = $directMessagesTopicId;

        return $this;
    }

    /**
     * Set the parse mode for message entities.
     *
     * @param  ParseMode|string  $parseMode  Mode for parsing entities (HTML, Markdown, MarkdownV2)
     * @return $this
     *
     * @throws TelegramValidationException
     */
    public function setParseMode(ParseMode|string $parseMode): self
    {
        if (is_string($parseMode)) {
            try {
                $parseMode = ParseMode::from($parseMode);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid parse_mode provided', previous: $exception);
            }
        }

        $this->parseMode = $parseMode;

        return $this;
    }

    /**
     * Set special entities that appear in the message text.
     *
     * @param  array  $entities  List of MessageEntity objects
     * @return $this
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * Set link preview generation options.
     *
     * @param  LinkPreviewOptions|array  $linkPreviewOptions  LinkPreviewOptions object
     * @return $this
     */
    public function setLinkPreviewOptions(LinkPreviewOptions|array $linkPreviewOptions): self
    {
        $this->linkPreviewOptions = $linkPreviewOptions;

        return $this;
    }

    /**
     * Send the message silently.
     *
     * @return $this
     */
    public function setDisableNotification(bool $disableNotification): self
    {
        $this->disableNotification = $disableNotification;

        return $this;
    }

    /**
     * Protect the contents of the sent message.
     *
     * @return $this
     */
    public function setProtectContent(bool $protectContent): self
    {
        $this->protectContent = $protectContent;

        return $this;
    }

    /**
     * Allow up to 1000 messages per second (paid broadcast).
     *
     * @return $this
     */
    public function setAllowPaidBroadcast(bool $allowPaidBroadcast): self
    {
        $this->allowPaidBroadcast = $allowPaidBroadcast;

        return $this;
    }

    /**
     * Set the message effect ID.
     *
     * @return $this
     */
    public function setMessageEffectId(string $messageEffectId): self
    {
        $this->messageEffectId = $messageEffectId;

        return $this;
    }

    /**
     * Set suggested post parameters.
     *
     * @param  SuggestedPostParameters|array  $suggestedPostParameters  SuggestedPostParameters object
     * @return $this
     */
    public function setSuggestedPostParameters(SuggestedPostParameters|array $suggestedPostParameters): self
    {
        $this->suggestedPostParameters = $suggestedPostParameters;

        return $this;
    }

    /**
     * Set reply parameters.
     *
     * @param  ReplyParameters|array  $replyParameters  ReplyParameters object
     * @return $this
     */
    public function setReplyParameters(ReplyParameters|array $replyParameters): self
    {
        $this->replyParameters = $replyParameters;

        return $this;
    }

    /**
     * Set reply markup.
     *
     * @return $this
     */
    public function setReplyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $replyMarkup): self
    {
        $this->replyMarkup = $replyMarkup;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        $textLength = mb_strlen($this->text);

        if ($textLength < 1) {
            throw new TelegramValidationException('Text cannot be empty');
        }

        if ($textLength > 4096) {
            throw new TelegramValidationException('Text must not exceed 4096 characters');
        }

        if ($this->parseMode !== null && $this->entities !== null) {
            throw new TelegramValidationException('parse_mode cannot be used with entities');
        }

        $this->validateLinkPreviewOptions();
        $this->validateSuggestedPostParametersProperty();
        $this->validateReplyParametersProperty();

        if ($this->replyMarkup !== null) {
            $this->validateReplyMarkupProperty($this->replyMarkup);
        }
    }

    /**
     * Validate link preview options.
     *
     * @throws TelegramValidationException
     */
    private function validateLinkPreviewOptions(): void
    {
        if ($this->linkPreviewOptions instanceof LinkPreviewOptions) {
            $this->linkPreviewOptions->validate();

            return;
        }

        if (is_array($this->linkPreviewOptions)) {
            $object = LinkPreviewOptions::fromArray($this->linkPreviewOptions);
            $object->validate();
            $this->linkPreviewOptions = $object;
        }
    }

    /**
     * Validate suggested post parameters property.
     *
     * @throws TelegramValidationException
     */
    private function validateSuggestedPostParametersProperty(): void
    {
        if ($this->suggestedPostParameters instanceof SuggestedPostParameters) {
            $this->suggestedPostParameters->validate();

            return;
        }

        if (is_array($this->suggestedPostParameters)) {
            $object = SuggestedPostParameters::fromArray($this->suggestedPostParameters);
            $object->validate();
            $this->suggestedPostParameters = $object;
        }
    }

    /**
     * Validate reply parameters property.
     *
     * @throws TelegramValidationException
     */
    private function validateReplyParametersProperty(): void
    {
        if ($this->replyParameters instanceof ReplyParameters) {
            $this->replyParameters->validate();

            return;
        }

        if (is_array($this->replyParameters)) {
            $object = ReplyParameters::fromArray($this->replyParameters);
            $object->validate();
            $this->replyParameters = $object;
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function buildParams(): array
    {
        return [
            'business_connection_id' => $this->businessConnectionId,
            'chat_id' => $this->chatId,
            'message_thread_id' => $this->messageThreadId,
            'direct_messages_topic_id' => $this->directMessagesTopicId,
            'text' => $this->text,
            'parse_mode' => $this->parseMode,
            'entities' => $this->entities,
            'link_preview_options' => $this->linkPreviewOptions,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'allow_paid_broadcast' => $this->allowPaidBroadcast,
            'message_effect_id' => $this->messageEffectId,
            'suggested_post_parameters' => $this->suggestedPostParameters,
            'reply_parameters' => $this->replyParameters,
            'reply_markup' => $this->replyMarkup,
        ];
    }
}
