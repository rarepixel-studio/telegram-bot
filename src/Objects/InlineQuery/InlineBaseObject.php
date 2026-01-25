<?php

namespace Telegram\Bot\Objects\InlineQuery;

use BadMethodCallException;
use Illuminate\Support\Str;
use Telegram\Bot\Objects\BaseObject;

abstract class InlineBaseObject extends BaseObject
{
    public function __construct(mixed $data = [])
    {
        parent::__construct($data);
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Magic method to set properties dynamically.
     *
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        $action = substr($method, 0, 3);

        if ($action === 'set') {
            $property = Str::snake(substr($method, 3));
            $this->put($property, $parameters[0]);

            return $this;
        }

        if ($action === 'get') {
            return parent::__call($method, $parameters);
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}
