<?php

require_once __DIR__ . '/vendor/autoload.php';

// IDE autocomplete does not work with anonymously classes for some reason
class A {
    use \TryPhp\PredictionTrait;
}
$t = new A();

$t->predict([1, 2,3])
    ->isArray()
    ->hasItem('a') // not rly
    ->withKey(1)
    ->withoutKey(4)
    ->countIsHigherThen(2)
    ->countIsSmallerThen(4)
    ->countIsEqual(3);

echo 'end' . PHP_EOL;