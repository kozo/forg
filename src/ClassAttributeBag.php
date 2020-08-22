<?php

namespace Shield;

use ArrayAccess;
use ArrayIterator;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Traits\Macroable;
use IteratorAggregate;

class ClassAttributeBag implements ArrayAccess, Htmlable, IteratorAggregate
{
    use Macroable;

    /**
     * The raw array of attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Create a new component attribute bag instance.
     *
     * @param  array|string  $attributes
     * @return void
     */
    public function __construct($attributes = [])
    {
        if (is_string($attributes)) {
            $attributes = $this->parseString($attributes);
        }
        $this->attributes = $attributes;
    }

    /**
     * Convert string to array
     *
     * @param string $attributes
     * @return array
     */
    private function parseString(string $attributes) : array
    {
        $list = explode(' ', $attributes);
        $list = array_unique(array_filter($list));

        if (empty($list)) {
            return [];
        }
        $list = array_merge($list);

        return $list;
    }

    public function toHtml()
    {
        return (string) $this;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->attributes);
    }

    /**
     * Get a given attribute from the attribute array.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->attributes[$key] ?? value($default);
    }

    /**
     * Determine if the given offset exists.
     *
     * @param  string  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * Get the value at the given offset.
     *
     * @param  string  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Set the value at a given offset.
     *
     * @param  string  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $list = $value;
        if (is_string($value)) {
            $list = $this->parseString($value);
        }

        foreach ($list as $v) {
            $this->attributes[] = $v;
        }
    }

    /**
     * Remove the value at the given offset.
     *
     * @param  string  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * Implode the attributes into a single HTML ready string.
     *
     * @return string
     */
    public function __toString()
    {
        $string = '';

        foreach ($this->attributes as $value) {
            if (!empty($string)) {
                $string .= ' ';
            }

            $string .= str_replace('"', '\\"', trim($value));
        }

        return trim($string);
    }
}
