<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputPaidMediaPhoto.
 */
class InputPaidMediaPhoto extends InputPaidMedia
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $data)
    {
        $data['type'] = 'photo';
        parent::__construct($data);
    }
}
