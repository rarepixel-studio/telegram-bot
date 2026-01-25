<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class BaseObject.
 */
abstract class BaseObject extends Collection
{
    /**
     * Builds collection entity.
     *
     * @param  array|mixed  $data
     */
    public function __construct(mixed $data)
    {
        parent::__construct($this->getRawResult($data));

        $this->mapRelatives();
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Property relations.
     */
    abstract public function relations(): array;

    /**
     * Map property relatives to appropriate objects.
     */
    public function mapRelatives(): array|false
    {
        $relations = $this->relations();

        if (empty($relations)) {
            return false;
        }

        $results = $this->all();
        foreach ($results as $key => $data) {
            if (is_array($data) && array_key_exists($key, $relations)) {
                $class = $relations[$key];
                $results[$key] = $this->recursiveMapRelatives($class, $data);
            }
        }

        return $this->items = $results;
    }

    protected function recursiveMapRelatives(string $class, mixed $data): Collection|BaseObject
    {
        if (is_array($data) && array_keys($data) === range(0, count($data) - 1)) {
            $array = [];
            foreach ($data as $item) {
                $array[] = $this->recursiveMapRelatives($class, $item);
            }

            return new Collection($array);
        } else {
            return new $class($data);
        }
    }

    /**
     * Returns raw response.
     */
    public function getRawResponse(): array
    {
        return $this->items;
    }

    /**
     * Returns raw result.
     */
    public function getRawResult(mixed $data): mixed
    {
        return Arr::get($data, 'result', $data);
    }

    /**
     * Get Status of request.
     */
    public function getStatus(): mixed
    {
        return Arr::get($this->items, 'ok', false);
    }

    /**
     * Magic method to get properties dynamically.
     */
    public function __call($method, $parameters)
    {
        $action = substr($method, 0, 3);

        if ($action === 'get') {
            $property = Str::snake(substr($method, 3));
            $response = $this->get($property);

            return $response;
        }

        return false;
    }
}
