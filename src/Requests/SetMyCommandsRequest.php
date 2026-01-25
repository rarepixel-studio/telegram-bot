<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setMyCommands method.
 *
 * Use this method to change the list of the bot's commands.
 *
 * @link https://core.telegram.org/bots/api#setmycommands
 */
class SetMyCommandsRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  array  $commands  A list of bot commands to be set
     */
    public function __construct(
        protected array $commands,
    ) {}

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
        return 'setMyCommands';
    }

    public function validate(): void
    {
        if (! is_array($this->commands)) {
            throw new TelegramValidationException('commands must be an array');
        }
    }

    public function buildParams(): array
    {
        return [
            'commands' => $this->commands,
        ] + $this->params;
    }
}
