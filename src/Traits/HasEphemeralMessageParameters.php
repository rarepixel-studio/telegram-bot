<?php

namespace Telegram\Bot\Traits;

use Telegram\Bot\Objects\EphemeralMessageParameters;

/**
 * Trait HasEphemeralMessageParameters.
 *
 * Adds ephemeral message parameter helpers to request objects that store
 * optional fields in a `$params` array.
 */
trait HasEphemeralMessageParameters
{
    /**
     * Set the parameters of the ephemeral message to send.
     *
     * @param  EphemeralMessageParameters|array<string, mixed>  $ephemeral_message_parameters
     * @return $this
     */
    public function ephemeralMessageParameters(EphemeralMessageParameters|array $ephemeral_message_parameters): self
    {
        $this->params['ephemeral_message_parameters'] = $ephemeral_message_parameters;

        return $this;
    }

    /**
     * Identifier of the user who will receive the ephemeral message.
     *
     * @return $this
     */
    public function receiverUserId(int $receiver_user_id): self
    {
        $this->mergeEphemeralMessageParameter('receiver_user_id', $receiver_user_id);

        return $this;
    }

    /**
     * Identifier of the callback query which triggered the ephemeral message.
     *
     * @return $this
     */
    public function callbackQueryId(string $callback_query_id): self
    {
        $this->mergeEphemeralMessageParameter('callback_query_id', $callback_query_id);

        return $this;
    }

    /**
     * Merge a field into ephemeral_message_parameters.
     */
    private function mergeEphemeralMessageParameter(string $key, mixed $value): void
    {
        $params = $this->params['ephemeral_message_parameters'] ?? [];

        if ($params instanceof EphemeralMessageParameters) {
            $params = $params->toArray();
        }

        if (! is_array($params)) {
            $params = [];
        }

        $params[$key] = $value;
        $this->params['ephemeral_message_parameters'] = $params;
    }
}
