<?php

namespace Telegram\Bot\MethodObjects;


class BaseObject
{
    /**
     * Convert object properties to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];

        foreach (get_object_vars($this) as $property => $value) {
            if (is_object($value)) {
                // If the object is an instance of BaseObject, call toArray recursively
                if (method_exists($value, 'toArray')) {
                    $result[$property] = $value->toArray();
                } else {
                    $result[$property] = $value;
                }
            } elseif (is_array($value)) {
                // Handle arrays and convert each element if it's an object
                $result[$property] = array_map(function ($item) {
                    if (is_object($item) && method_exists($item, 'toArray')) {
                        return $item->toArray();
                    }
                    return $item;
                }, $value);
            } else {
                // For other types, just assign the value
                $result[$property] = $value;
            }
        }

        return $result;
    }
}
