<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setChatDescription method.
 *
 * Use this method to change the description of a group, supergroup or channel.
 *
 * @link https://core.telegram.org/bots/api#setchatdescription
 */
class SetChatDescriptionRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    /**
     * New chat description, 0-255 characters.
     */
    public function description(string $description): self
    {
        $this->params['description'] = $description;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setChatDescription';
    }

    public function validate(): void
    {
        if (isset($this->params['description'])) {
            $descLength = mb_strlen($this->params['description']);

            if ($descLength > 255) {
                throw new TelegramValidationException('description must not exceed 255 characters');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ] + $this->params;
    }
}
