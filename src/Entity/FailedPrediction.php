<?php

namespace TryPhp\Entity;


/**
 * Entity of a failed prediction
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class FailedPrediction
{
    /**
     * Predicted value
     *
     * @var mixed
     */
    protected $predicted;

    /**
     * Current value
     *
     * @var mixed|null
     */
    protected $current;

    /**
     * Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * FailedPrediction constructor.
     *
     * @param string     $message
     * @param mixed      $predicted
     * @param mixed|null $current
     */
    public function __construct(string $message, $predicted, $current = null)
    {
        $this->description = $message;
        $this->predicted   = $predicted;
        $this->current     = $current;
    }

    /**
     * The getter function for the property <em>$predicted</em>.
     *
     * @return mixed
     */
    public function getPredicted()
    {
        return $this->predicted;
    }

    /**
     * The getter function for the property <em>$current</em>.
     *
     * @return mixed|null
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * The getter function for the property <em>$description</em>.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

}