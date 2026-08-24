<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the sendMessageDraft method.
 *
 * Use this method to stream a partial message to a user while the message is being generated;
 * supported only for bots with forum topic mode enabled. Returns True on success.
 *
 * @link https://core.telegram.org/bots/api#sendmessagedraft
 */
class SendMessageDraftRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'entities',
    ];

    /** @var int Unique identifier for the target private chat */
    protected int $chatId;

    /** @var int Unique identifier of the message draft */
    protected int $draftId;

    /** @var string Text of the message to be sent, 0-4096 characters */
    protected string $text;

    /** @var int|null Unique identifier for the target message thread */
    protected ?int $messageThreadId = null;

    /** @var ParseMode|null Mode for parsing entities in the message text */
    protected ?ParseMode $parseMode = null;

    /** @var array|null List of MessageEntity objects */
    protected ?array $entities = null;

    /** @var bool|null Pass True to show the user a button to stop further drafts */
    protected ?bool $canStop = null;

    /** @var bool|null Pass True to keep the draft in the chat when the stop button is pressed */
    protected ?bool $keepOnStop = null;

    /**
     * SendMessageDraftRequest constructor.
     */
    public function __construct(int $chatId, int $draftId, string $text = '')
    {
        $this->chatId = $chatId;
        $this->draftId = $draftId;
        $this->text = $text;
    }

    /**
     * @return $this
     */
    public function setMessageThreadId(int $messageThreadId): self
    {
        $this->messageThreadId = $messageThreadId;

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
     * Pass True to show the user a button to stop further drafts.
     *
     * @return $this
     */
    public function setCanStop(bool $canStop): self
    {
        $this->canStop = $canStop;

        return $this;
    }

    /**
     * Pass True to keep the draft in the chat when the stop button is pressed.
     *
     * @return $this
     */
    public function setKeepOnStop(bool $keepOnStop): self
    {
        $this->keepOnStop = $keepOnStop;

        return $this;
    }

    /**
     * Get the method name.
     */
    public function getMethod(): string
    {
        return 'sendMessageDraft';
    }

    /**
     * Validate the request.
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        $textLength = mb_strlen($this->text);

        if ($textLength > 4096) {
            throw new TelegramValidationException('Text must not exceed 4096 characters');
        }

        if ($this->parseMode !== null && $this->entities !== null) {
            throw new TelegramValidationException('parse_mode cannot be used with entities');
        }
    }

    /**
     * Get the request parameters.
     */
    protected function buildParams(): array
    {
        return [
            'chat_id' => $this->chatId,
            'message_thread_id' => $this->messageThreadId,
            'draft_id' => $this->draftId,
            'text' => $this->text,
            'parse_mode' => $this->parseMode,
            'entities' => $this->entities,
            'can_stop' => $this->canStop,
            'keep_on_stop' => $this->keepOnStop,
        ];
    }
}
