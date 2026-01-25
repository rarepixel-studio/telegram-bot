<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputPaidMediaVideo.
 */
class InputPaidMediaVideo extends InputPaidMedia
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $data)
    {
        $data['type'] = 'video';
        parent::__construct($data);
    }
}
