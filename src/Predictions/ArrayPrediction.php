<?php

namespace TryPhp\Predictions;

use TryPhp\Exception\FailedPredictionContainer;
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
    protected $predictionFails;

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
        if (!is_array($value)) {
            throw new PredictionFailException('Expected array, got ' . gettype($value));
        }
        parent::__construct($value, $predictionContainer);
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
            $this->addFail('Expect array has key "' . $key . '" but it does not exist');
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
        foreach ($keys as $key) {
            $this->withKey($key);
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
            $this->addFail('Expect array has not key "' . $key . '" but it exist');
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
    public function countIsEqual(int $expectedCount)
    {
        $count = count($this->value);
        if ($expectedCount !== count($this->value)) {
            $this->addFail('Expect array has ' . $expectedCount . ' items, but count is ' . $count);
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
    public function countIsHigherThen(int $expected)
    {
        $count = count($this->value);
        if (count($this->value) <= $expected) {
            $this->addFail('Expect count of items is higher then ' . $expected . ', but its ' . $count);
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
    public function countIsSmallerThen(int $expected)
    {
        $count = count($this->value);
        if (count($this->value) >= $expected) {
            $this->addFail('Expect count of items is smaller then ' . $expected . ', but its ' . $count);
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
            $this->addFail('Expect array has value "' . $item . '" but it does not exist');
        }

        return $this;
    }

    public function hasSubset(array $subset)
    {
//        @todo
    }
}