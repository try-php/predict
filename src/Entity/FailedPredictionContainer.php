<?php

namespace TryPhp\Entity;

use TryPhp\Exception\PredictionFailException;

/**
 * Container for predictionMessages
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class FailedPredictionContainer
{
    /**
     * Array with failed predictions
     *
     * @var FailedPrediction[]
     */
    protected $failedPredictions = [];

    /**
     * @throws PredictionFailException
     */
    public function __destruct()
    {
        if (count($this->failedPredictions) !== 0) {
            $this->throwPredictionStack();
        }
    }

    /**
     * Add failed prediction to container
     *
     * @param FailedPrediction $failedPrediction
     *
     * @return $this
     */
    public function add(FailedPrediction $failedPrediction)
    {
        $this->failedPredictions[] = $failedPrediction;

        return $this;
    }

    /**
     * Throw saved prediction messages as exceptions
     *
     * @throws PredictionFailException
     */
    public function throwPredictionStack()
    {
        $stack = array_reverse($this->failedPredictions);
        foreach ($stack as $prediction) {
            /* @var FailedPrediction $prediction */
            if (!isset($exception)) {
                $exception = new PredictionFailException($prediction->getDescription());
            } else {
                $exception = new PredictionFailException($prediction->getDescription(), 0, $exception);
            }

        }
        if (isset($exception)) {
            throw  $exception;
        }
    }

}