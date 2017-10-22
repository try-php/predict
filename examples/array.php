<?php

require_once __DIR__ . '/../vendor/autoload.php';

$t = new class {
    use \TryPhp\PredictionTrait;
};

try {
    $t->predict([1, 2,3])
        ->isArray()
        ->hasItem('a') // not rly
        ->withKey(1)
        ->withKey(42) // dont think so
        ->withoutKey(4)
        ->countIsHigherThen(2)
        ->countIsSmallerThen(4)
        ->countIsEqual(3)
        ->hasItem(1)
        ->hasItems([1,2])
        ->hasSubset([1 => 2, 2=> 3])
        ->hasSubset([0 => 2, 1 => 2, 2 => 3, 3 => 4]);
} catch (\TryPhp\Exception\PredictionFailException $e) {
    echo $e->getMessage() . PHP_EOL;
    while($e->getPrevious() !== null) {
        $e = $e->getPrevious();
        echo $e->getMessage() . PHP_EOL;
    }
}


echo 'end' . PHP_EOL;