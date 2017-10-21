<?php

namespace TryPhp;


/**
 * Mixin to use fluent prediction interface
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
trait PredictionTrait
{
    /**
     * Return new prediction class
     *
     * @param $value
     *
     * @return Predictions
     */
    public function predict($value)
    {
        return new Predictions($value);
    }
}