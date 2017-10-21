<?php

namespace TryPhp\Exception;


/**
 * Container for predictionMessages
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class FailedPredictionContainer
{

    /**
     * FailedPrediction
     *
     * @var PredictionFailException|null
     */
    protected $failedPrediction;

    /**
     * Add failed prediction to container
     *
     * @param PredictionFailException $exception
     *
     * @return $this
     */
    public function add(PredictionFailException $exception)
    {
        if (isset($this->failedPrediction)) {
            $this->injectPreviousException($exception, $this->failedPrediction);
        }
        $this->failedPrediction = $exception;

        return $this;
    }

    /**
     * Return the failed predictions
     *
     * @return null|PredictionFailException
     */
    public function getFailedPrediction()
    {
        return $this->failedPrediction;
    }

    /**
     * Inject the previous exception in the current one
     *
     * @param PredictionFailException $current
     * @param PredictionFailException $previous
     *
     * @return PredictionFailException
     */
    protected function injectPreviousException(PredictionFailException $current, PredictionFailException $previous)
    {
        $reflection = new \ReflectionClass($current);
        $property   = $reflection->getParentClass()
            ->getProperty('previous');
        $property->setAccessible('true');
        $property->setValue($current, $previous);
        $property->setAccessible('false');

        return $current;
    }

}