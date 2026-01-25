<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteMyCommands method.
 *
 * Use this method to delete the list of the bot's commands for the given scope and user language.
 *
 * @link https://core.telegram.org/bots/api#deletemycommands
 */
class DeleteMyCommandsRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct()
    {
        // All parameters are optional
    }

    /**
     * A JSON-serialized object describing scope of users for which the commands are relevant.
     */
    public function scope(array $scope): self
    {
        $this->params['scope'] = $scope;

        return $this;
    }

    /**
     * A two-letter ISO 639-1 language code.
     */
    public function languageCode(string $language_code): self
    {
        $this->params['language_code'] = $language_code;

        return $this;
    }

    public function getMethod(): string
    {
        return 'deleteMyCommands';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
