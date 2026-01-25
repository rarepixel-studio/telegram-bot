<?php

namespace Telegram\Bot\Contracts;

/**
 * Contract for objects that can be constructed by SDK users.
 */
interface ClientConstructibleObjectInterface
{
    /**
     * Create an instance from raw array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static;

    /**
     * Validate the object state and constraints.
     *
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function validate(): void;
}
