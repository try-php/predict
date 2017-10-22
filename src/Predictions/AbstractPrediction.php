<?php

namespace TryPhp\Predictions;

use TryPhp\Entity\FailedPrediction;
use TryPhp\Entity\FailedPredictionContainer;

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
    protected $failedPredictions;

    /**
     * Value to compare
     *
     * @var mixed
     */
    protected $value;

    /**
     * ArrayPrediction constructor.
     *
     * @param mixed                     $value
     * @param FailedPredictionContainer $predictionContainer
     */
    public function __construct($value, FailedPredictionContainer $predictionContainer)
    {
        $this->value             = $value;
        $this->failedPredictions = $predictionContainer;
    }

    /**
     * Add predictionFail to container
     *
     * @param string     $description
     * @param mixed      $prediction
     * @param mixed|null $actual
     *
     * @return FailedPredictionContainer
     */
    protected function addFail(string $description, $prediction, $actual = null)
    {
        $actual           = $actual ?? $this->value;
        $failedPrediction = new FailedPrediction($description, $prediction, $actual);
        $this->failedPredictions->add($failedPrediction);

        return $this->failedPredictions;
    }
}