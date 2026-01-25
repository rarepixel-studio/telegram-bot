<?php

namespace Telegram\Bot\Requests;

use Illuminate\Contracts\Support\Arrayable;
use Telegram\Bot\Contracts\ApiRequestInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardMarkup;
use Telegram\Bot\Objects\ReplyKeyboardRemove;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\SuggestedPostParameters;

/**
 * Abstract base class for Telegram API requests.
 *
 * Provides common functionality for all request objects including
 * payload normalization for nested objects and collections.
 */
abstract class TelegramApiRequest implements ApiRequestInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws TelegramValidationException
     */
    public function toWebhookPayload(): array
    {
        $this->validate();

        return array_merge(
            ['method' => $this->getMethod()],
            $this->toArray()
        );
    }

    /**
     * Normalize a value for API serialization.
     *
     * Handles nested ApiRequestInterface objects and arrays of them.
     */
    protected function normalizeValue(mixed $value): mixed
    {
        if ($value instanceof \BackedEnum) {
            return $value->value;
        }

        if ($value instanceof ApiRequestInterface) {
            return $value->toArray();
        }

        if ($value instanceof Arrayable) {
            return $this->normalizeValue($value->toArray());
        }

        if (is_array($value)) {
            return array_map(fn ($item) => $this->normalizeValue($item), $value);
        }

        return $value;
    }

    /**
     * Filter null values from an array.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    protected function filterNullValues(array $params): array
    {
        return array_filter($params, fn ($value) => $value !== null);
    }

    /**
     * Build the params array from class properties.
     *
     * Override this method in child classes to define which properties
     * are included in the API request.
     *
     * @return array<string, mixed>
     */
    protected function buildParams(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $params = $this->buildParams();

        // Normalize nested objects
        foreach ($params as $key => $value) {
            $params[$key] = $this->normalizeValue($value);
        }

        // JSON-encode nested arrays for Telegram API
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $params[$key] = json_encode($value);
            }
        }

        return $this->filterNullValues($params);
    }

    /**
     * Validate reply_parameters in the params array.
     *
     * Call this method from your validate() implementation when
     * your request supports the reply_parameters field.
     *
     * @param  array<string, mixed>  $params  Reference to the params array
     *
     * @throws TelegramValidationException
     */
    protected function validateReplyParameters(array &$params): void
    {
        if (! array_key_exists('reply_parameters', $params)) {
            return;
        }

        $value = $params['reply_parameters'];
        if ($value instanceof ReplyParameters) {
            $value->validate();

            return;
        }

        if (is_array($value)) {
            $object = ReplyParameters::fromArray($value);
            $object->validate();
            $params['reply_parameters'] = $object;
        }
    }

    /**
     * Validate reply_markup in the params array.
     *
     * Call this method from your validate() implementation when
     * your request supports the reply_markup field.
     *
     * @param  array<string, mixed>  $params  Reference to the params array
     *
     * @throws TelegramValidationException
     */
    protected function validateReplyMarkup(array &$params): void
    {
        if (! array_key_exists('reply_markup', $params)) {
            return;
        }

        $value = $params['reply_markup'];
        if ($value instanceof InlineKeyboardMarkup
            || $value instanceof ReplyKeyboardMarkup
            || $value instanceof ReplyKeyboardRemove
            || $value instanceof ForceReply
        ) {
            $value->validate();

            return;
        }

        if (is_array($value)) {
            $object = $this->normalizeReplyMarkupArray($value);
            if ($object !== null) {
                $object->validate();
                $params['reply_markup'] = $object;
            }
        }
    }

    /**
     * Validate and normalize suggested post parameters.
     *
     * Call this method from your validate() implementation when
     * your request supports the suggested_post_parameters field.
     *
     * @param  array<string, mixed>  $params  Reference to the params array
     *
     * @throws TelegramValidationException
     */
    protected function validateSuggestedPostParameters(array &$params): void
    {
        if (! isset($params['suggested_post_parameters'])) {
            return;
        }

        $spp = $params['suggested_post_parameters'];
        if ($spp instanceof SuggestedPostParameters) {
            $spp->validate();

            return;
        }

        if (is_array($spp)) {
            $object = SuggestedPostParameters::fromArray($spp);
            $object->validate();
            $params['suggested_post_parameters'] = $object;
        }
    }

    /**
     * Normalize reply markup arrays into concrete objects when possible.
     *
     * @param  array<string, mixed>  $replyMarkup
     */
    protected function normalizeReplyMarkupArray(array $replyMarkup): InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null
    {
        if (array_key_exists('inline_keyboard', $replyMarkup)) {
            return InlineKeyboardMarkup::fromArray($replyMarkup);
        }

        if (array_key_exists('keyboard', $replyMarkup)) {
            return ReplyKeyboardMarkup::fromArray($replyMarkup);
        }

        if (array_key_exists('remove_keyboard', $replyMarkup)) {
            return ReplyKeyboardRemove::fromArray($replyMarkup);
        }

        if (array_key_exists('force_reply', $replyMarkup)) {
            return ForceReply::fromArray($replyMarkup);
        }

        return null;
    }
}
