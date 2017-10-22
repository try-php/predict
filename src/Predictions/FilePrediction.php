<?php

namespace TryPhp\Predictions;

use TryPhp\Entity\FailedPredictionContainer;


/**
 * Predictions for files
 *
 * @copyright Felix Buchheim
 * @author    Felix Buchheim <buflix.dev@gmail.com>
 */
class FilePrediction extends AbstractPrediction
{

    /**
     * FilePrediction constructor.
     *
     * @param array                     $value
     * @param FailedPredictionContainer $predictionContainer
     *
     * @throws \TryPhp\Exception\PredictionFailException
     */
    public function __construct($value, FailedPredictionContainer $predictionContainer)
    {
        parent::__construct($value, $predictionContainer);
        if (!is_file($this->value)) {
            $this->addFail('Expected file does not exist', 'is_file')
                ->throwPredictionStack();
        }
    }

    public function content()
    {
        return new StringPrediction(file_get_contents($this->value), $this->failedPredictions);
    }

    /**
     * Predict if the file is readable
     *
     * @param bool $isReadable
     *
     * @return $this
     */
    public function isReadable(bool $isReadable)
    {
        if (is_readable($this->value) !== $isReadable) {
            $readAble = ($isReadable) ? '' : 'not';
            $this->addFail('File is ' . $readAble . ' readable', $isReadable);
        }

        return $this;
    }

    /**
     * Predict if the file is writable
     *
     * @param bool $isWritable
     *
     * @return $this
     */
    public function isWritable(bool $isWritable)
    {
        if (is_writable($this->value) !== $isWritable) {
            $writable = ($isWritable) ? '' : 'not';
            $this->addFail('File is ' . $writable . ' writable', $isWritable);
        }

        return $this;
    }

    /**
     * Compare file directory path
     *
     * @param string $directory
     *
     * @return $this
     */
    public function inDirectory(string $directory)
    {
        $dirName = pathinfo($this->value)['dirname'];
        if ($dirName !== $directory) {
            $this->addFail('Predicted directory is wrong', $directory, $dirName);
        }

        return $this;
    }

    /**
     * Predict file name
     *
     * @param string $predictedName
     *
     * @return $this
     */
    public function hasFileName(string $predictedName)
    {
        $fileName = pathinfo($this->value)['filename'];
        if ($predictedName !== $fileName) {
            $this->addFail('Predicted filename is wrong', $predictedName);
        }

        return $this;
    }

    /**
     * Predict file has extension
     *
     * @param string $predictedExtension
     *
     * @return $this
     */
    public function withExtension(string $predictedExtension)
    {
        $extension = pathinfo($this->value)['extension'];
        if ($predictedExtension !== $extension) {
            $this->addFail('Predicted fileextension is wrong', $predictedExtension, $extension);
        }

        return $this;
    }


}