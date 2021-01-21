# cartware/custombase

A PHP port of [Elixir's CustomBase module](https://hex.pm/packages/custom_base)

## Example

Lets make `Base12` module with conversion described below.

| Value | Encoding |
|------:|---------:|
|      0|         0|
|      1|         1|
|      2|         2|
|      3|         3|
|      4|         4|
|      5|         5|
|      6|         6|
|      7|         7|
|      8|         8|
|      9|         9|
|     10|         A|
|     11|         B|

```php
use Cartware\CustomBase\CustomBase;

class Base12 {
	use CustomBase;
	protected const CUSTOMBASE_ALPHABET = '0123456789AB';
}
```

Now your class has 2 functions `encode/1` and `decode/1`:

```php
$base12 = new Base12();

$base12->encode(9); # 9
$base12->encode(10); # A
$base12->encode(11); # B
$base12->encode(12); # 10

$base12->decode(16); # 18
$base12->decode('AB'); # 131
```

## [License](https://github.com/Cartware/php_custombase/blob/master/LICENSE)

Released under the MIT License.