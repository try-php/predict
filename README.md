# predict

> Fluent interface, small and simple predictions

## Install

```bash
$ compose require try/predict
```

## Usage

```php
<?php
require_once '/path/to/autoload.php';

use TryPhp\PredictionTrait;
use TryPhp\Exception\PredictionFailException;

$t = new class() {
	use PredictionTrait;
};

try {
	$t->predict([1, 2, 3])->isArray()->withKey(1);
} catch(PredictionFailException $ex) {
	// catch if the prediction failes
}
```

## API

### Trait

#### `TryPhp\PredictionTrait`

##### Methods

| Method | Arguments | Description | 
|---|---|---|
| predict($value) | * `$value` (**string**)(required) | Entrypoint to setup predictions based on the given `$value`, will return a fluid interface for prediction setups (See `Prediction Entrypoint`). See `Prediction Classes` for more information about the several prediction chaining possibilities. |


### Prediction Entrypoint

#### `TryPhp\Predictions`

Class wich will be returned by `TryPhp\PredictionTrait::predict($value)`. Provides setup functions for prediction chains.

##### Methods

| Method | Arguments | Description | 
|---|---|---|
| isTrue() | **none** | Will add a failed prediction if the set value is not true. |
| isFalse() | **none** | Will add a failed prediction if the set value is true. |
| isArray() | **none** | Will return a fluid interface to `TryPhp\Predictions\ArrayPrediction` and add a failed prediction if value is no array. |

### Prediction Classes

#### `TryPhp\Predictions\ArrayPrediction` 

Prediction class for array predictions and comparisons.

##### Methods

| Method | Arguments | Description | 
|---|---|---|
| withKey($key) | * `$key` (**mixed**)(required) | Will add a failed prediction if set value does not contain provided key. |
| withKeys($keys) | * `$keys` (**array**)(required) | Will add a failed prediction if set value does not contain provided keys. |
| withoutKey($key) | * `$key` (**mixed**)(required) | Inverted case of `withKey`. |
| withoutKeys($keys) | * `$keys` (**array**)(required) | Inverted case of `withKeys`. |
| countIs($expected) | * `$expected` (**int**)(required) | Will add a prediction fail if the length of the set value doesmatch the expected one. |
| countIsHigherThan($expected) | * `$expected` (**int**)(required) | Will add a prediction fail if the length of the set value is lower than the expected value. |
| countIsLowerThan($expected) | * `$expected` (**int**)(required) | Will add a prediction fail if the length of the set value is higher than the expected value. |
| hasItem($expected, $strict = false) | * `$expected` (**mixed**)(required) * `$strict` (**bool**) | Will add a prediction fail if the set values does not contain expected item. |
| hasItems($expected) | * `$expected` (**array**)(required) | Will add a prediction fail if the set values does not contain expected items. |
| hasSubset($supset) | * `$supset` (**array**)(required) | Will add a prediction fail if the set values does not contain expected subset. |

## License

GPL-2.0 © Felix Buchheim