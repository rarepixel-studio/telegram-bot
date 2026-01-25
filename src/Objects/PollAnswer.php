<?php

namespace Telegram\Bot\Objects;

/**
 * Class PollAnswer.
 *
 * Represents an answer of a user in a non-anonymous poll.
 */
class PollAnswer extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'voter_chat' => Chat::class,
            'user' => User::class,
        ];
    }

    /**
     * Unique poll identifier.
     */
    public function getPollId(): string
    {
        return $this->items['poll_id'];
    }

    /**
     * (Optional). The chat that changed the answer to the poll, if the voter is anonymous.
     */
    public function getVoterChat(): ?Chat
    {
        return $this->items['voter_chat'] ?? null;
    }

    /**
     * (Optional). The user that changed the answer to the poll, if the voter isn't anonymous.
     */
    public function getUser(): ?User
    {
        return $this->items['user'] ?? null;
    }

    /**
     * 0-based identifiers of chosen answer options.
     */
    public function getOptionIds(): array
    {
        return $this->items['option_ids'];
    }
}
