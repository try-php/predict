<?php

require_once __DIR__ . '/vendor/autoload.php';

// IDE autocomplete does not work with anonymously classes for some reason
class A {
    use \TryPhp\PredictionTrait;
}
$t = new A();
try {
    $t->predict([1, 2,3])
        ->isArray()
        ->hasItem('a') // not rly
        ->withKey(1)
        ->withKey(42) // dont think so
        ->withoutKey(4)
        ->countIsHigherThen(2)
        ->countIsSmallerThen(4)
        ->countIsEqual(3);
} catch (\TryPhp\Exception\PredictionFailException $e) {
    echo $e->getMessage() . PHP_EOL;
    while($e->getPrevious() !== null) {
        $e = $e->getPrevious();
        echo $e->getMessage() . PHP_EOL;
    }
}


echo 'end' . PHP_EOL;