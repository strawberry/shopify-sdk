<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models;

use Illuminate\Support\Collection;
use Jenssegers\Model\Model as BaseModel;
use ReflectionClass;

abstract class Model extends BaseModel
{
    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     *
     * @return mixed
     */
    protected function getAttributeValue($key)
    {
        $value = $this->getAttributeFromArray($key);

        // If the attribute has a get mutator, we will call that then return what
        // it returns as the value, which is useful for transforming values on
        // retrieval from the model to a form that is more useful for usage.
        if ($this->hasGetMutator($key)) {
            return $this->mutateAttribute($key, $value);
        }

        // If the attribute exists within the cast array, we will convert it to
        // an appropriate native PHP type dependant upon the associated value
        // given with the key in the pair. Dayle made this comment line up.
        if ($this->hasCast($key)) {
            return $this->castAttribute($key, $value);
        }

        // If the attribute exists with the array cast array, we will map each
        // item of the value array into an instance of the given model.
        if ($this->hasModelArrayCast($key)) {
            return $this->castToModelArray($key, $value);
        }

        return $value;
    }

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        if ($this->shouldCastToSingleModel($key)) {
            return $this->castToSingleModel($this->casts[$key], $value);
        }

        switch ($this->getCastType($key)) {
            case 'int':
            case 'integer':
                return (int) $value;
            case 'real':
            case 'float':
            case 'double':
                return (float) $value;
            case 'string':
                return (string) $value;
            case 'bool':
            case 'boolean':
                return (bool) $value;
            case 'object':
                return $this->fromJson($value, true);
            case 'array':
            case 'json':
                return $this->fromJson($value);
            case 'collection':
                return new Collection($this->fromJson($value));
            default:
                return $value;
        }
    }

    /**
     * Determine whether this attribute should be cast to a model instance.
     *
     * @param  string  $key
     *
     * @return bool
     */
    protected function shouldCastToSingleModel($key): bool
    {
        if (! isset($this->casts[$key]) || ! class_exists($this->casts[$key])) {
            return false;
        }

        $reflector = new ReflectionClass($this->casts[$key]);

        return $reflector->isSubclassOf(self::class);
    }

    /**
     * Determine whether this attribute should be cast to an array
     * of model instances.
     *
     * @param  string  $key
     *
     * @return bool
     */
    protected function hasModelArrayCast($key): bool
    {
        if (is_null($key) || ! isset($this->castArrays[$key])) {
            return false;
        }

        if (! class_exists($this->castArrays[$key])) {
            return false;
        }

        $reflector = new ReflectionClass($this->castArrays[$key]);

        return $reflector->isSubclassOf(self::class);
    }

    /**
     * Cast the attribute to the given model instance.
     *
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return Model
     */
    protected function castToSingleModel($class, $value): self
    {
        return new $class($value);
    }

    /**
     * Cast the attribute to the given model instance.
     *
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return Model[]
     */
    protected function castToModelArray($key, $value): array
    {
        $class = $this->castArrays[$key];

        return (new Collection($value))->mapInto($class)->all();
    }
}
