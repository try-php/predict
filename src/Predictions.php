<?php

namespace TryPhp;

use TryPhp\Entity\FailedPredictionContainer;
use TryPhp\Predictions\AbstractPrediction;
use TryPhp\Predictions\ArrayPrediction;
use TryPhp\Predictions\FilePrediction;
use TryPhp\Predictions\NumberPrediction;
use TryPhp\Predictions\StringPrediction;


/**
 * Facade to user predictions
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class Predictions extends AbstractPrediction
{

    /**
     * Predictions constructor.
     *
     * @param $valueToCompare
     */
    public function __construct($valueToCompare)
    {
        parent::__construct($valueToCompare, new FailedPredictionContainer());
    }

    public function isString()
    {
        return new StringPrediction($this->value, $this->failedPredictions);
    }

    public function isNumber()
    {
        return new NumberPrediction($this->value, $this->failedPredictions);
    }

    public function isFile()
    {
        return new FilePrediction($this->value, $this->failedPredictions);
    }

    /**
     * @return ArrayPrediction
     */
    public function isArray()
    {
        return new ArrayPrediction($this->value, $this->failedPredictions);
    }

    /**
     * Assert value is true
     *
     * @throws Exception\PredictionFailException
     */
    public function isTrue()
    {
        if ($this->value !== true) {
            $this->addFail('Value is not true.', true)
                ->throwPredictionStack();
        }
    }

    /**
     * Assert value is false
     *
     * @throws Exception\PredictionFailException
     */
    public function isFalse()
    {
        if ($this->value !== false) {
            $this->addFail('Value is not false.', false)
                ->throwPredictionStack();
        }
    }

}