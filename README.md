# Access User Log

[![Latest Stable Version](https://img.shields.io/packagist/v/pragmarx/tracker.svg?style=flat-square)](https://packagist.org/packages/pragmarx/tracker) 
[![License](https://img.shields.io/badge/license-BSD_3_Clause-brightgreen.svg?style=flat-square)](LICENSE)

This package provides tool to track user access

## Installation

Via Composer

```bash
$ composer require zoy/accessuser
```

Then add the service provider in `config/app.php`:

```php
Zoy\Accessuser\AccessUserLogServiceProvider::class,
```

And run the above commented command  
```php
php artisan vendor:publish
```
Migrate table to database 
```php
php artisan migrate
```

update
```php
php artisan vendor:publish --force
```


[//]: <> ( ## Changelog )
[//]: <> (## )

## Contributing


## Credits


## License

MIT License  [license.md](LICENSE) for more information.

    