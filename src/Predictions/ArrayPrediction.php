<?php

namespace TryPhp\Predictions;

use TryPhp\Entity\FailedPredictionContainer;
use TryPhp\Exception\PredictionFailException;

/**
 * Class to predict array properties
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class ArrayPrediction extends AbstractPrediction
{

    /**
     * PredictionFails
     *
     * @var FailedPredictionContainer
     */
    protected $failedPredictions;

    /**
     * Value to compare
     *
     * @var array
     */
    protected $value;

    /**
     * ArrayPrediction constructor.
     *
     * @param array                     $value
     * @param FailedPredictionContainer $predictionContainer
     *
     * @throws PredictionFailException
     */
    public function __construct($value, FailedPredictionContainer $predictionContainer)
    {
        parent::__construct($value, $predictionContainer);
        if (!is_array($value)) {
            $this->addFail('Predict array, got ' . gettype($value), 'array', gettype($value))
                ->throwPredictionStack();
        }
    }

    /**
     * Expect array has given key
     *
     * @param string|int $key
     *
     * @return $this
     */
    public function withKey($key)
    {
        if (!array_key_exists($key, $this->value)) {
            $this->addFail('Key "' . $key . '" does not exist', $key);
        }

        return $this;
    }

    /**
     * Expect array has given keys
     *
     * @param array $keys
     *
     * @return $this
     */
    public function withKeys(array $keys)
    {
        $keys = array_flip($keys);
        $diff = array_diff_key($keys, $this->value);
        if (count($diff) !== 0) {
            $this->addFail('Following keys do not exist: ' . implode($diff, ', '), $keys, array_keys($this->value));
        }

        return $this;
    }

    /**
     * Expect array has not given key
     *
     * @param string|int $key
     *
     * @return $this
     */
    public function withoutKey($key)
    {
        if (array_key_exists($key, $this->value)) {
            $this->addFail('Array has key "' . $key, $key, array_keys($this->value));
        }

        return $this;
    }

    /**
     * Expect array has given keys
     *
     * @param array $keys
     *
     * @return $this
     */
    public function withoutKeys(array $keys)
    {
        foreach ($keys as $key) {
            $this->withoutKeys($key);
        }

        return $this;
    }

    /**
     * Expect count of array is equal
     *
     * @param int $expectedCount
     *
     * @return $this
     */
    public function countIs(int $expectedCount)
    {
        $count = count($this->value);
        if ($expectedCount !== count($this->value)) {
            $this->addFail('Predicted count of items is wrong', $expectedCount, $count);
        }

        return $this;
    }

    /**
     * Expect count of array is equal
     *
     * @param int $expected
     *
     * @return $this
     */
    public function countIsHigherThan(int $expected)
    {
        $count = count($this->value);
        if (count($this->value) <= $expected) {
            $this->addFail('Count of items is not higher then ' . $expected, $expected, $count);
        }

        return $this;
    }

    /**
     * Expect count of array is equal
     *
     * @param int $expected
     *
     * @return $this
     */
    public function countIsLowerThan(int $expected)
    {
        $count = count($this->value);
        if (count($this->value) >= $expected) {
            $this->addFail('Count of items is not smaller then ' . $expected, $expected, $count);
        }

        return $this;
    }

    /**
     * Expect the array has the given item
     *
     * @param mixed $item
     * @param bool  $strict
     *
     * @return $this
     */
    public function hasItem($item, bool $strict = true)
    {
        if (!in_array($item, $this->value, $strict)) {
            $this->addFail('Array has no value "' . $item, $item);
        }

        return $this;
    }

    /**
     * Expect array has given items
     *
     * @param array $items
     *
     * @return $this
     */
    public function hasItems(array $items)
    {
        $diff = array_diff($items, $this->value);
        if (count($diff) !== 0) {
            $this->addFail('Following items do not exist: ' . implode($diff, ', '), $items);
        }

        return $this;
    }

    /**
     * Expect array has given subset
     *
     * @param array $subset
     *
     * @return $this
     */
    public function hasSubset(array $subset)
    {
        $diff = array_diff_assoc($subset, $this->value);
        if (count($diff) !== 0) {
            $this->addFail('Subset does not exist: ' . $subset, $subset);
        }

        return $this;
    }
}