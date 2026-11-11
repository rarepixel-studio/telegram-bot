<?php

namespace Telegram\Bot\Traits;

use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Adds optional formatting to a Telegram verification description.
 */
trait HasVerificationDescription
{
    /** @var array<string, mixed> Formatting options for the description. */
    protected array $descriptionParams = [];

    /**
     * {@inheritdoc}
     */
    protected function jsonSerializedFields(): array
    {
        return ['custom_description_entities'];
    }

    /**
     * Set the custom description for the verification.
     *
     * @param  string  $description  Verification description
     * @return $this
     */
    public function customDescription(string $description): self
    {
        $this->custom_description = $description;

        return $this;
    }

    /**
     * Set the parse mode for the description.
     *
     * @param  ParseMode|string  $parseMode  Telegram formatting mode
     * @return $this
     *
     * @throws TelegramValidationException
     */
    public function customDescriptionParseMode(ParseMode|string $parseMode): self
    {
        $mode = $parseMode instanceof ParseMode ? $parseMode : ParseMode::tryFrom($parseMode);
        if ($mode === null) {
            throw new TelegramValidationException('Invalid custom_description_parse_mode provided');
        }

        $this->descriptionParams['custom_description_parse_mode'] = $mode;

        return $this;
    }

    /**
     * Set the text-link entities for the description.
     *
     * @param  list<MessageEntity|array<string, mixed>>  $entities  Links in the description
     * @return $this
     */
    public function customDescriptionEntities(array $entities): self
    {
        $this->descriptionParams['custom_description_entities'] = $entities;

        return $this;
    }

    /**
     * Validate the description and its formatting options.
     *
     * @throws TelegramValidationException
     */
    protected function validateVerificationDescription(): void
    {
        $parseMode = $this->descriptionParams['custom_description_parse_mode'] ?? null;
        $entities = $this->descriptionParams['custom_description_entities'] ?? null;

        if ($parseMode !== null && $entities !== null) {
            throw new TelegramValidationException('custom_description_parse_mode cannot be used with custom_description_entities');
        }

        if ($parseMode === null && $this->custom_description !== null && mb_strlen($this->custom_description) > 70) {
            throw new TelegramValidationException('custom_description must not exceed 70 characters');
        }

        foreach ($entities ?? [] as $entity) {
            $type = $entity instanceof MessageEntity ? $entity->get('type') : ($entity['type'] ?? null);
            if ($type !== 'text_link') {
                throw new TelegramValidationException('custom_description_entities only supports text_link');
            }
        }
    }
}
