# Algerian Cities

A Laravel package to create/load wilayas and communes of Algeria

## Installation

```sh
composer require kossa/algerian-cities
php artisan algerian-cities:install
```

## Using this package
### Basic usage

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

### Helpers
There is multiple helper functions like :

```php
$wilayas  = wilayas();     // get all wilayas as $id => $name
$communes = communes();    // get all communes as $id => $name
$communes = communes(16);  // get all communes of Algiers(16) as $id => $name
```
 

### Blade/Views
There is multiple helper functions for your views

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

// communes of Algiers
<select>
    @foreach (communes(16) as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

// communes with wilaya name : Dar El Beida, Alger
<select>
    @foreach (communes(null, true) as $id => $commune)
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
The list of wilayas/communes are collected from [algeria-cities](https://github.com/othmanus/algeria-cities)
