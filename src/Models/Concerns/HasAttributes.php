<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Concerns;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;

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
}
