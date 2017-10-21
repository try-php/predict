<?php

namespace TryPhp\Predictions;

use TryPhp\Exception\FailedPredictionContainer;
use TryPhp\Exception\PredictionFailException;

/**
 * Abstract Predication
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
abstract class AbstractPrediction
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
     */
    public function __construct($value, FailedPredictionContainer $predictionContainer)
    {
        $this->value           = $value;
        $this->predictionFails = $predictionContainer;
    }

    /**
     * Add predictionFail to container
     *
     * @param string $message
     *
     * @return $this
     */
    protected function addFail(string $message)
    {
        $this->predictionFails->add(new PredictionFailException($message));

        return $this;
    }
}