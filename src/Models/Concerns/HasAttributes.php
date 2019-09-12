<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Concerns;

use Carbon\Carbon;
use DateTimeInterface;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Support\Arrayable;

trait HasAttributes
{
    /**
     * The data attributes for this model.
     */
    protected $attributes = [];

    /**
     * The attributes that should be cast to dates.
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to the given type.
     */
    protected $casts = [];

    /**
     * The attributes that should be cast to arrays of the given type.
     *
     * @var array
     */
    protected $castArrays = [];

    /**
     * Fills the attributes for this model from the given data source.
     *
     * @param  Arrayable|array
     *
     * @return $this
     */
    public function fill($attributes): self
    {
        if ($attributes instanceof Arrayable) {
            $attributes = $attributes->toArray();
        }

        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Get an attribute from the model.
     *
     * @return mixed
     */
    public function getAttribute(string $key)
    {
        if (! isset($this->attributes[$key])) {
            return null;
        }

        return $this->getAttributeValue($key);
    }

    /**
     * Gets the value of a given attribute, after performing any specified
     * casting, from the model.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function getAttributeValue(string $key)
    {
        $value = $this->attributes[$key] ?? null;

        if ($this->isDateTime($key)) {
            return $this->asDateTime($value);
        }

        if ($this->shouldCast($key)) {
            return $this->castAttribute($key, $value);
        }

        return $value;
    }

    /**
     * Determine whether a given attribute should be cast to a Carbon instance.
     */
    public function isDateTime(string $key): bool
    {
        return in_array($key, $this->dates);
    }

    /**
     * Cast the given attribute to a Carbon instance.
     *
     * @param  mixed  $value
     */
    private function asDateTime($value): CarbonInterface
    {
        // If the value given is already an instance of Carbon (or implements
        // its interface) we can save ourselves some time and return that.
        if ($value instanceof Carbon || $value instanceof CarbonInterface) {
            return $value;
        }

        // Otherwise if the value is an object that implements the base
        // interface we can just create a Carbon instance direct from that.
        if ($value instanceof DateTimeInterface) {
            return Carbon::instance($value);
        }

        // If the value is numeric, we're going to presume that the value is
        // a UNIX timestamp so we'll create the Carbon instance from that.
        if (is_numeric($value)) {
            return Carbon::createFromTimestamp($value);
        }

        // If we've made it this far, we're going to presume it's striaght from
        // the Shopify API and the string is a date in ISO-8601 format.
        return Carbon::parse($value);
    }

    /**
     * Determine whether the given attribute has a defined cast.
     */
    public function shouldCast(string $key): bool
    {
        return array_key_exists($key, $this->casts)
            || array_key_exists($key, $this->castArrays);
    }

    /**
     * Cast the given attribute to the specified type.
     *
     * @param  mixed $value
     *
     * @return mixed
     */
    public function castAttribute(string $key, $value)
    {
        if (array_key_exists($key, $this->castArrays)) {
            return $this->castArrayAttribute($key, $value);
        }

        return $this->castTo($this->casts[$key], $value);
    }

    /**
     * Cast the given attribute to an array the specified type.
     *
     * @param  array|Arrayable  $value
     *
     * @return array
     */
    public function castArrayAttribute(string $key, $array): array
    {
        if ($array instanceof Arrayable) {
            $array = $array->toArray();
        }

        return (new Collection($array))->map(function ($value) use ($key) {
            return $this->castTo($this->castArrays[$key], $value);
        });
    }

    /**
     * Cast the given value to the given type.
     *
     * @param  mixed $value
     * @return mixed
     *
     * @see https://github.com/laravel/framework/blob/6.x/src/Illuminate/Database/Eloquent/Concerns/HasAttributes.php#L478
     */
    public function castTo(string $type, $value)
    {
        if (class_exists($type)) {
            return new $type($value);
        }

        switch ($type) {
            case 'int':
            case 'integer':
                return (int) $value;

            case 'real':
            case 'float':
            case 'double':
                return $this->fromFloat($value);

            case 'bool':
            case 'boolean':
                return (bool) $value;

            default:
                return $value;
        }
    }

    /**
     * Decode the given float.
     *
     * @param  mixed  $value
     *
     * @return mixed
     *
     * @see https://github.com/laravel/framework/blob/6.x/src/Illuminate/Database/Eloquent/Concerns/HasAttributes.php#L728
     */
    public function fromFloat($value)
    {
        switch ((string) $value) {
            case 'Infinity':
                return INF;
            case '-Infinity':
                return -INF;
            case 'NaN':
                return NAN;
            default:
                return (float) $value;
        }
    }
}
