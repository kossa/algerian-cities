<div align="center">
    <img src="docs/package-social-preview-readme.png" width="600" alt="Laravel Algerian Cities">
    <div align="center">
        <a href="https://packagist.org/packages/kossa/algerian-cities"><img src="https://poser.pugx.org/piteurstudio/satim-php/require/php" alt="PHP Version Require"></a>
        <a href="https://github.com/kossa/algerian-cities/blob/master/phpstan.neon"><img src="https://img.shields.io/badge/PHPStan-max-blue.svg?style=flat" alt="PHPStan"></a>
        <a href="https://github.com/kossa/algerian-cities/blob/master/composer.json#L51"><img src="https://img.shields.io/badge/Coverage-100%25-blue" alt="Test coverage"></a>
        <a href="https://github.com/kossa/algerian-cities/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/actions/workflow/status/kossa/algerian-cities/laravel.yml?branch=master&label=Tests"></a>
        <a href="https://packagist.org/packages/kossa/algerian-cities"><img alt="Latest Version" src="https://img.shields.io/packagist/v/kossa/algerian-cities"></a>
        <a href="https://packagist.org/packages/kossa/algerian-cities"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/kossa/algerian-cities"></a>
        <a href="https://packagist.org/packages/kossa/algerian-cities"><img src="https://poser.pugx.org/piteurstudio/satim-php/license" alt="License"></a>
    </div>
</div>

------

**Laravel Algerian Cities** : A comprehensive Laravel package to easily manage and interact with Algerian administrative divisions. 

It provides functionality to load Wilayas (provinces) and Communes (municipalities) in both Arabic and French, complete with postal codes and precise latitude/longitude coordinates for each commune.

## Features
- Includes all 58 Algerian Wilayas and 1541 Communes.
- Wilaya and Commune Eloquent models with relationships.
- Supports Arabic and French languages.
- Includes postal codes and latitude/longitude for each commune.
- [Helper functions for easy integration in Blade views](#using-helper-functions).
- [Available as API endpoints](#using-the-package-as-an-api).

## Requirements

- **PHP** : 8.1 or higher
- **Laravel** : 10 or higher

## Installation

You can install the package via composer:

```bash
composer require kossa/algerian-cities
```

Next, publish the migrations and seeders by running the installation command:


```bash
php artisan algerian-cities:install
```

## Usage
### Basic usage

The package provides two models: `Wilaya` and `Commune`. 

A `Wilaya` has many `Commune`, and you can interact with them just like any other Eloquent models.

```php
// Retrieve all Wilayas
$wilayas = Wilaya::all();
    
// Retrieve all Communes
$communes = Commune::all();
    
// Get all Communes belonging to Algiers (Wilaya ID: 16)
$algiers_communes = Commune::where('wilaya_id', 16)->get();
```

### Using Helper Functions

The package provides several helper functions for convenient data retrieval:

```php
$wilayas = wilayas();                                                // Get all Wilayas as $id => $name
$wilayas = wilayas('arabic_name');                                   // Get all Wilayas with names in Arabic
$communes = communes();                                              // Get all Communes as $id => $name
$communes = communes(16);                                            // Get all Communes of Algiers (Wilaya ID: 16) as $id => $name
$communes = communes(16, $withWilaya = true);                        // Get all Communes of Algiers (16) including Wilayas: "Alger Centre, Alger"
$communes = communes(16, $withWilaya = true, $name = 'arabic_name'); // Get all Communes of Algiers (16) with Wilayas in Arabic: "الجزائر الوسطى, الجزائر"

$single_commune = commune(1);                      // Retrieve a single Commune model
$single_commune = commune(1, $withWilaya = true);  // Retrieve a single Commune model, including its Wilaya
$single_wilaya = wilaya(1);                        // Retrieve a single Wilaya model
```
 

### Blade Templates / Views

You can leverage the provided helpers or models to populate `<select>` elements:

```html
<!-- Select for Wilayas -->
<select>
    @foreach (wilayas() as $id => $wilaya)
        <option value="{{ $id }}">{{ $wilaya }}</option>
    @endforeach
</select>

<!-- Select for Communes -->
<select>
    @foreach (communes() as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

<!-- Select for Communes of Algiers (Wilaya ID: 16) -->
<select>
    @foreach (communes(16) as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

<!-- Select for Communes with Wilaya Name (e.g., "Adrar, Adrar") -->
<select>
    @foreach (communes(null, true) as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>

<!-- Select for Communes with Wilaya Name in Arabic (e.g., "أدرار, أدرار") -->
<select>
    @foreach (communes(null, true, 'arabic_name') as $id => $commune)
        <option value="{{ $id }}">{{ $commune }}</option>
    @endforeach
</select>
```

## Using the Package as an API

This package includes `api.php` routes, allowing you to interact with the data through a RESTful API. Here are the available endpoints:

| Verb | URI                          | Description                                        |
|------|------------------------------|----------------------------------------------------|
| GET  | `/api/wilayas`               | Retrieve all Wilayas                               |
| GET  | `/api/wilayas/{id}`          | Retrieve a specific Wilaya by ID                   |
| GET  | `/api/wilayas/{id}/communes` | Retrieve all Communes from a specific Wilaya by ID |
| GET  | `/api/communes`              | Retrieve all Communes                              |
| GET  | `/api/communes/{id}`         | Retrieve a specific Commune by ID                  |
| GET  | `/api/search/wilaya/{q}`     | Search Wilayas by name or Arabic name              |
| GET  | `/api/search/commune/{q}`    | Search Communes by name or Arabic name             |

### Usage of Traits

The package provides **`HasWilaya`** and **`HasCommune`** traits to easily associate models with **Wilayas (provinces)** and **Communes (municipalities)**.

```php
use Illuminate\Database\Eloquent\Model;
use Kossa\AlgerianCities\Traits\HasWilaya;
use Kossa\AlgerianCities\Traits\HasCommune;

class User extends Model
{
    use HasWilaya, HasCommune;
}
```

#### **Access Wilaya & Commune Data**
```php
$user = User::find(1);

echo $user->wilaya->name; // Example: "Alger"
echo $user->commune->name; // Example: "Bab El Oued"
```

✔ **Ensure `wilaya_id` and `commune_id` exist in the `users` table:**
```php
Schema::table('users', function (Blueprint $table) {
    $table->foreignId('wilaya_id')->nullable()->constrained('wilayas');
    $table->foreignId('commune_id')->nullable()->constrained('communes');
});
```

## Config
### API Availability Toggle

You can enable or disable the Algerian Cities API endpoints by setting the following option in your `.env` file:

```dotenv
ALGERIAN_CITIES_API_ENABLED=false # Default: true
```

----

## Goals

- [ ] Add support for Dairas, including relationships with Wilayas and Communes
- [ ] Add a configuration file to allow customizing package behaviors
- [ ] Add support for caching to optimize API responses
- [ ] support no database usage

## Contribution

We welcome all contributions! Please follow these guidelines:

1. Document any changes in behavior — ensure `README.md` updated accordingly.
2. Write tests to cover any new functionality.
3. Please ensure that your pull request passes all tests.

## Issues & Suggesting Features

If you encounter any issues or have ideas for new features, please [open an issue](https://github.com/kossa/algerian-cities/issues/new). 

We appreciate your feedback and contributions to help improve this package.

## Credits

- [Kouceyla](https://github.com/kossa) , and all [contributors](https://github.com/kossa/algerian-cities/graphs/contributors) who have helped improve and enhance the project.
- The list of Wilayas and Communes is sourced from [Wilaya-Of-Algeria](https://github.com/bahinapster/Wilaya-Of-Algeria/).

## Security Reports

If you discover any security vulnerabilities, please report them by emailing the package maintainer at `hadjikouceyla at gmail`. 

## ⭐ Support Us

If you find this package helpful, please consider giving it a ⭐ on [GitHub](https://github.com/kossa/algerian-cities) !
Your support encourages us to keep improving the project.
Thank you!

[![Stargazers repo roster for @kossa/algerian-cities](https://reporoster.com/stars/dark/kossa/algerian-cities)](https://github.com/kossa/algerian-cities/stargazers)

## License

This package is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).