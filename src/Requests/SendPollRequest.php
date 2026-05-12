<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InputPollMedia;
use Telegram\Bot\Objects\InputPollOption;
use Telegram\Bot\Objects\MessageEntity;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;

/**
 * Request object for the sendPoll method.
 *
 * Use this method to send a native poll. On success, the sent Message is returned.
 *
 * @link https://core.telegram.org/bots/api#sendpoll
 */
class SendPollRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'options',
        'question_entities',
        'explanation_entities',
        'explanation_media',
        'description_entities',
        'media',
        'country_codes',
        'reply_markup',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $question  Poll question, 1-300 characters
     * @param  array  $options  A JSON-serialized list of 2-10 answer options
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $question,
        protected array $options,
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
     * Mode for parsing entities in the question.
     */
    public function questionParseMode(string $question_parse_mode): self
    {
        $this->params['question_parse_mode'] = $question_parse_mode;

        return $this;
    }

    /**
     * A JSON-serialized list of special entities that appear in the poll question.
     *
     * @param  array<MessageEntity>  $question_entities
     */
    public function questionEntities(array $question_entities): self
    {
        $this->params['question_entities'] = $question_entities;

        return $this;
    }

    /**
     * True, if the poll needs to be anonymous, defaults to True.
     */
    public function isAnonymous(bool $is_anonymous): self
    {
        $this->params['is_anonymous'] = $is_anonymous;

        return $this;
    }

    /**
     * Poll type, "quiz" or "regular", defaults to "regular".
     */
    public function type(string $type): self
    {
        $this->params['type'] = $type;

        return $this;
    }

    /**
     * True, if the poll allows multiple answers, ignored for polls in quiz mode, defaults to False.
     */
    public function allowsMultipleAnswers(bool $allows_multiple_answers): self
    {
        $this->params['allows_multiple_answers'] = $allows_multiple_answers;

        return $this;
    }

    /**
     * 0-based identifiers of the correct answer options, required for polls in quiz mode.
     */
    public function correctOptionIds(array $correct_option_ids): self
    {
        $this->params['correct_option_ids'] = $correct_option_ids;

        return $this;
    }

    /**
     * Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters.
     */
    public function explanation(string $explanation): self
    {
        $this->params['explanation'] = $explanation;

        return $this;
    }

    /**
     * Mode for parsing entities in the explanation.
     */
    public function explanationParseMode(string $explanation_parse_mode): self
    {
        $this->params['explanation_parse_mode'] = $explanation_parse_mode;

        return $this;
    }

    /**
     * A JSON-serialized list of special entities that appear in the poll explanation.
     *
     * @param  array<MessageEntity>  $explanation_entities
     */
    public function explanationEntities(array $explanation_entities): self
    {
        $this->params['explanation_entities'] = $explanation_entities;

        return $this;
    }

    /**
     * Media added to the quiz explanation.
     */
    public function explanationMedia(array|InputPollMedia $explanation_media): self
    {
        $this->params['explanation_media'] = $explanation_media;

        return $this;
    }

    /**
     * True, if the poll allows revoting.
     */
    public function allowsRevoting(bool $allows_revoting): self
    {
        $this->params['allows_revoting'] = $allows_revoting;

        return $this;
    }

    /**
     * True, if the options should be shuffled.
     */
    public function shuffleOptions(bool $shuffle_options): self
    {
        $this->params['shuffle_options'] = $shuffle_options;

        return $this;
    }

    /**
     * True, if new options can be added to the poll.
     */
    public function allowAddingOptions(bool $allow_adding_options): self
    {
        $this->params['allow_adding_options'] = $allow_adding_options;

        return $this;
    }

    /**
     * True, if the poll results should be hidden until the poll closes.
     */
    public function hideResultsUntilCloses(bool $hide_results_until_closes): self
    {
        $this->params['hide_results_until_closes'] = $hide_results_until_closes;

        return $this;
    }

    /**
     * Text that is shown to the user when the poll is closed or closed by the user, 0-200 characters.
     */
    public function description(string $description): self
    {
        $this->params['description'] = $description;

        return $this;
    }

    /**
     * Mode for parsing entities in the description.
     */
    public function descriptionParseMode(string $description_parse_mode): self
    {
        $this->params['description_parse_mode'] = $description_parse_mode;

        return $this;
    }

    /**
     * A JSON-serialized list of special entities that appear in the poll description.
     *
     * @param  array<MessageEntity>  $description_entities
     */
    public function descriptionEntities(array $description_entities): self
    {
        $this->params['description_entities'] = $description_entities;

        return $this;
    }

    /**
     * Media added to the poll description.
     */
    public function media(array|InputPollMedia $media): self
    {
        $this->params['media'] = $media;

        return $this;
    }

    /**
     * Pass True, if voting is limited to users who have been members of the chat where the poll is being sent for more than 24 hours; for channel chats only.
     */
    public function membersOnly(bool $members_only): self
    {
        $this->params['members_only'] = $members_only;

        return $this;
    }

    /**
     * A JSON-serialized list of 0-12 two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which users can vote in the poll; for channel chats only.
     */
    public function countryCodes(array $country_codes): self
    {
        $this->params['country_codes'] = $country_codes;

        return $this;
    }

    /**
     * Amount of time in seconds the poll will be active after creation, 5-2628000.
     */
    public function openPeriod(int $open_period): self
    {
        $this->params['open_period'] = $open_period;

        return $this;
    }

    /**
     * Point in time (Unix timestamp) when the poll will be automatically closed.
     */
    public function closeDate(int $close_date): self
    {
        $this->params['close_date'] = $close_date;

        return $this;
    }

    /**
     * Pass True if the poll needs to be immediately closed.
     */
    public function isClosed(bool $is_closed): self
    {
        $this->params['is_closed'] = $is_closed;

        return $this;
    }

    /**
     * Sends the message silently.
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
     * Pass True to allow up to 1000 messages per second, ignoring broadcasting limits.
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast): self
    {
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;

        return $this;
    }

    /**
     * Unique identifier of the message effect to be added to the message.
     */
    public function messageEffectId(string $message_effect_id): self
    {
        $this->params['message_effect_id'] = $message_effect_id;

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
     * Additional interface options.
     */
    public function replyMarkup(InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'sendPoll';
    }

    public function validate(): void
    {
        $questionLength = mb_strlen($this->question);
        if ($questionLength < 1 || $questionLength > 300) {
            throw new TelegramValidationException('Poll question must be between 1 and 300 characters');
        }

        $optionCount = count($this->options);
        if ($optionCount < 1 || $optionCount > 12) {
            throw new TelegramValidationException('Poll must have between 1 and 12 options');
        }

        foreach ($this->options as $index => $option) {
            $text = match (true) {
                $option instanceof InputPollOption => $option->getText(),
                is_array($option) => $option['text'] ?? '',
                default => (string) $option,
            };
            $textLength = mb_strlen($text);

            if ($textLength < 1 || $textLength > 100) {
                throw new TelegramValidationException("Poll option at index {$index} must be between 1 and 100 characters");
            }
        }

        if (isset($this->params['type']) && ! in_array($this->params['type'], ['regular', 'quiz'], true)) {
            throw new TelegramValidationException('Poll type must be either "regular" or "quiz"');
        }

        if (isset($this->params['question_parse_mode'], $this->params['question_entities'])) {
            throw new TelegramValidationException('question_parse_mode cannot be used with question_entities');
        }

        if (isset($this->params['explanation_parse_mode'], $this->params['explanation_entities'])) {
            throw new TelegramValidationException('explanation_parse_mode cannot be used with explanation_entities');
        }

        if (isset($this->params['description_parse_mode'], $this->params['description_entities'])) {
            throw new TelegramValidationException('description_parse_mode cannot be used with description_entities');
        }

        $type = $this->params['type'] ?? 'regular';
        if ($type === 'quiz' && empty($this->params['correct_option_ids'])) {
            throw new TelegramValidationException('correct_option_ids is required for quiz polls');
        }

        if (isset($this->params['correct_option_ids'])) {
            $previous = -1;
            foreach ($this->params['correct_option_ids'] as $optionId) {
                if (! is_int($optionId) || $optionId <= $previous || $optionId < 0 || $optionId >= $optionCount) {
                    throw new TelegramValidationException('correct_option_ids must contain monotonically increasing valid option identifiers');
                }

                $previous = $optionId;
            }
        }

        if (isset($this->params['explanation']) && mb_strlen($this->params['explanation']) > 200) {
            throw new TelegramValidationException('Poll explanation must not exceed 200 characters');
        }

        if (isset($this->params['description']) && mb_strlen($this->params['description']) > 1024) {
            throw new TelegramValidationException('Poll description must not exceed 1024 characters');
        }

        if (isset($this->params['open_period'])) {
            $openPeriod = $this->params['open_period'];
            if ($openPeriod < 5 || $openPeriod > 2628000) {
                throw new TelegramValidationException('Poll open period must be between 5 and 2628000 seconds');
            }
        }

        if (isset($this->params['open_period'], $this->params['close_date'])) {
            throw new TelegramValidationException('open_period cannot be used with close_date');
        }

        if (isset($this->params['close_date'])) {
            $secondsUntilClose = $this->params['close_date'] - time();
            if ($secondsUntilClose < 5 || $secondsUntilClose > 2628000) {
                throw new TelegramValidationException('Poll close date must be between 5 and 2628000 seconds in the future');
            }
        }

        if (isset($this->params['country_codes']) && count($this->params['country_codes']) > 12) {
            throw new TelegramValidationException('country_codes must not contain more than 12 countries');
        }

        $this->validateReplyParameters($this->params);
        $this->validateReplyMarkup($this->params);
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'question' => $this->question,
            'options' => $this->options,
        ] + $this->params;
    }
}
