<?php

namespace TryPhp;

use TryPhp\Exception\FailedPredictionContainer;
use TryPhp\Predictions\ArrayPrediction;


/**
 * Facade to user predictions
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class Predictions
{

    /**
     * Value to compare
     *
     * @var mixed
     */
    protected $value;

    /**
     * PredictionFails
     *
     * @var FailedPredictionContainer
     */
    protected $predictionFails;

    /**
     * Predictions constructor.
     *
     * @param $valueToCompare
     */
    public function __construct($valueToCompare)
    {
        $this->value           = $valueToCompare;
        $this->predictionFails = new FailedPredictionContainer();
    }

    /**
     * @return ArrayPrediction
     */
    public function isArray()
    {
        return new ArrayPrediction($this->value, $this->predictionFails);
    }

}