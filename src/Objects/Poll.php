<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Poll.
 *
 * Represents a poll.
 */
class Poll extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'options' => PollOption::class,
            'explanation_entities' => MessageEntity::class,
            'question_entities' => MessageEntity::class,
        ];
    }

    /**
     * Unique poll identifier.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * Poll question, 1-300 characters.
     */
    public function getQuestion(): string
    {
        return $this->items['question'];
    }

    /**
     * List of poll options.
     */
    /**
     * @return Collection<int, PollOption>
     */
    public function getOptions(): Collection
    {
        return $this->items['options'];
    }

    /**
     * Total number of users that voted in the poll.
     */
    public function getTotalVoterCount(): int
    {
        return $this->items['total_voter_count'];
    }

    /**
     * True, if the poll is closed.
     */
    public function getIsClosed(): bool
    {
        return $this->items['is_closed'];
    }

    /**
     * True, if the poll is anonymous.
     */
    public function getIsAnonymous(): bool
    {
        return $this->items['is_anonymous'];
    }

    /**
     * Poll type, currently can be "regular" or "quiz".
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * True, if the poll allows multiple answers.
     */
    public function getAllowsMultipleAnswers(): bool
    {
        return $this->items['allows_multiple_answers'];
    }

    /**
     * (Optional). 0-based identifier of the correct answer option.
     */
    public function getCorrectOptionId(): ?int
    {
        return $this->items['correct_option_id'] ?? null;
    }

    /**
     * (Optional). Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll.
     */
    public function getExplanation(): ?string
    {
        return $this->items['explanation'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getExplanationEntities(): ?Collection
    {
        return $this->items['explanation_entities'] ?? null;
    }

    /**
     * (Optional). Amount of time in seconds the poll will be active after creation.
     */
    public function getOpenPeriod(): ?int
    {
        return $this->items['open_period'] ?? null;
    }

    /**
     * (Optional). Point in time (Unix timestamp) when the poll will be automatically closed.
     */
    public function getCloseDate(): ?int
    {
        return $this->items['close_date'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getQuestionEntities(): ?Collection
    {
        return $this->items['question_entities'] ?? null;
    }
}
