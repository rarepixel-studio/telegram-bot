<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getUserProfilePhotos method.
 *
 * Use this method to get a list of profile pictures for a user.
 *
 * @link https://core.telegram.org/bots/api#getuserprofilephotos
 */
class GetUserProfilePhotosRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int $user_id,
    ) {}

    /**
     * Sequential number of the first photo to be returned. By default, all photos are returned.
     */
    public function offset(int $offset): self
    {
        $this->params['offset'] = $offset;

        return $this;
    }

    /**
     * Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     */
    public function limit(int $limit): self
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getUserProfilePhotos';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        if (isset($this->params['offset']) && $this->params['offset'] < 0) {
            throw new TelegramValidationException('offset must be greater than or equal to 0');
        }

        if (isset($this->params['limit'])) {
            $limit = $this->params['limit'];
            if ($limit < 1 || $limit > 100) {
                throw new TelegramValidationException('limit must be between 1 and 100');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
        ] + $this->params;
    }
}
