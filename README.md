# Algerian Cities

A Laravel package to create/load wilayas and communes of Algeria in Arabic and French language, included zip code and latitude/longitude of communes

## Installation

```sh
composer require kossa/algerian-cities
php artisan algerian-cities:install
```

## Using this package
### Basic usage
There is two model `Wilaya` that has many `Commune`, import and use them like any model

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

class AnyClass extends Model
{
    $wilayas          = Wilaya::all();                           // Get all wilayas
    $communes         = Commune::all();                          // Get all communes
    $algiers_communes = Commune::where('wilaya_id', 16)->get();  // get all communes of Algiers(16)
}
```

### Via helpers
There is multiple helper functions like :

```php
$wilayas  = wilayas();                                                // get all wilayas as $id => $name
$wilayas  = wilayas('arabic_name');                                   // get all wilayas in arabic
$communes = communes();                                               // get all communes as $id => $name
$communes = communes(16);                                             // get all communes of Algiers(16) as $id => $name
$communes = communes(16, $withWilaya = true);                         // get all communes of Algiers(16) with name of wilayas like : Alger Centre, Alger
$communes = communes(16, $withWilaya = true, $name = "arabic_name");  // get all communes of Algiers(16) with name of wilayas in arabic like : الجزائر الوسطى, الجزائر

$single_commune = commune(1);                      // get a single commune model
$single_commune = commune(1, $withWilaya = true);  // get a single commune model include wilaya
$single_wilaya  = wilaya(1);                       // get a single wilaya
```
 

### Blade/Views

You can use any helper/model above and use it in select 

```php

// wilayas
<select>
    @foreach (wilayas() as $id => $wilaya)
        <option value="{{ $id }}">{{ $wilaya }}</option>
    @endforeach
</select>

// communes
<select>
    @foreach (communes() as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

// communes of Algiers(16)
<select>
    @foreach (communes($wilaya_id = 16) as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

// communes with wilaya name : Adrar, Adrar ...
<select>
    @foreach (communes($wilaya_id = null, $withWilaya = true) as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

// communes with wilaya name in arabic : أدرار, أدرار ...
<select>
    @foreach (communes($wilaya_id = null, $withWilaya = true, 'arabic_name') as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

```

## Contribution
All contributions are welcome, please follow :
1. [PSR-2](https://www.php-fig.org/psr/psr-2/) Coding Standard
1. Document any change in behaviour - Make sure the README.md and any other relevant documentation are kept up-to-date.
1. One pull request per feature - If you want to do more than one thing, send multiple pull requests.


## Credits
The list of wilayas/communes are collected from [Wilaya-Of-Algeria](https://github.com/bahinapster/Wilaya-Of-Algeria/)
