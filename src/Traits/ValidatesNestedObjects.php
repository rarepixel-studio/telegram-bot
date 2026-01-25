<?php

namespace Telegram\Bot\Traits;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Trait ValidatesNestedObjects.
 */
trait ValidatesNestedObjects
{
    /**
     * Validate nested object if present.
     *
     * @param  string  $key  Item key containing the nested object.
     * @param  class-string<ClientConstructibleObjectInterface>  $class  Nested object class name.
     *
     * @throws TelegramValidationException
     */
    protected function validateNested(string $key, string $class): void
    {
        if (! array_key_exists($key, $this->items) || $this->items[$key] === null) {
            return;
        }

        $value = $this->items[$key];
        if (is_array($value)) {
            $value = $class::fromArray($value);
            $this->items[$key] = $value;
        }

        if ($value instanceof ClientConstructibleObjectInterface) {
            $value->validate();
        }
    }
}
