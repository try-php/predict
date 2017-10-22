<?php

require_once __DIR__ . '/../vendor/autoload.php';

$t = new class {
    use \TryPhp\PredictionTrait;
};

class A {
    use \TryPhp\PredictionTrait;
}

$t = new A();

try {
    $t->predict(__FILE__)
        ->isFile()
        ->isReadable(true)
        ->isWritable(true)
        ->withExtension('php')
        ->hasFileName('something') // nope
        ->inDirectory(__DIR__)
        ->inDirectory(__CLASS__);
} catch (\TryPhp\Exception\PredictionFailException $e) {
    echo $e->getMessage() . PHP_EOL;
    while($e->getPrevious() !== null) {
        $e = $e->getPrevious();
        echo $e->getMessage() . PHP_EOL;
    }
}


echo 'end' . PHP_EOL;