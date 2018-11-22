# laravelWebToken

### Install via composer
Add orm to composer.json configuration file.

```
$ composer require larapost/categories
```

### add to file config/app.php
```php
'providers' => [
    ...
    Larapost\Categorie\Support\ServiceProvider::class,
],
```

### publish 
```
$ php artisan vendor:publish
```
OR
```
$ php artisan vendor:publish --provider="Larapost\Categorie\Support\ServiceProvider"
```
### Migrate
you can use migrate
```
$ php artisan migrate:fresh
```

## Use
```php
use Larapost\Categories;
```
## functions

### Add
```php
function(Categories $categories)
{
    return $categories->add('<name>', '<slug>' = false);
}
```

### Get
```php
function(Categories $categories)
{
    return $categories->get('<column>', '<value>', <subs> = true | false);
}
```

### Remove
```php
function(Categories $categories)
{
    return $categories->remove('<id>');
}
```

### All
```php
function(Categories $categories)
{
    return $categories->all();
}
```

## Sub categorie

### Sub Add
```php
function(Categories $categories)
{
    return $categories->subAdd('<categorie_id>', '<name>', '<slug>' = false);
}
```

### Sub Get
```php
function(Categories $categories)
{
    return $categories->subGet('<categorie_id>', '<column>', '<value>');
}
```

### Sub Remove
```php
function(Categories $categories)
{
    return $categories->subRemove('<id>');
}
```