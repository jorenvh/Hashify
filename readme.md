# Hashify

This Laravel package makes it easy to generate random strings from a given charset. It can also generate database table and/or column unique strings.

## Installation

This package can be installed through Composer.

```php
composer require jorenvanhocht/hashify
```

You must register the service provider.

```php
// config/app.php
'provider' => [
    ...
    jorenvanhocht\Hashify\Providers\HashifyServiceProvider::class,
    ...
];
```

This package also comes with a facade, which provides an easy way to call the class.

```php
// config/app.php
'aliases' => [
    ...
    'Hashify'    => jorenvanhocht\Hashify\Facades\Hashify::class,
    ...
];
```

You can publish the config file of this package with this command:

```php
php artisan vendor:publish --provider="jorenvanhocht\Hashify\HashifyServiceProvider"
```

The following config file will be published in ```config/hashify.php```

```php
<?php

return [
    'charsets' => [
        'database' => 'ABCDEFGHIJKLMNOPQRSTUVWabcdefghijklmnopqrstuvw0123456789',
    ],
];
```

## Usage

```php
private $hashify;
public function __construct(Hashify $hashify)
{
	$this->hashify = $hashify;
}

public function myMethod()
{
	// random string
	echo $this->hashify->make($minLength, $maxLength);

	// database unique random string
	echo $this->hashify->make()->unqique('users');
	echo $this->hashify->make()->unqique('users', 'colName');
	echo $this->hashify->make(2, 10)->unqique('users', 'colName');
}
```
## To do 
The usage of different char sets.

## License

The MIT License (MIT). Please see License File for more information.