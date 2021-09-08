# Library for access to Keitaro Admin API

![GitHub](https://img.shields.io/github/license/wirgen/keitaro)
![Packagist Version](https://img.shields.io/packagist/v/wirgen/keitaro)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/wirgen/keitaro)
![Packagist Downloads](https://img.shields.io/packagist/dt/wirgen/keitaro)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/wirgen/keitaro)

The `wirgen/keitaro` package provides a wrapper for ease of use of the [Keitaro](https://keitaro.io) [Admin API](https://demo-ru.keitaro.io/admin/?object=adminApi) methods.

> **Important!**
> This feature is available only for Business license.

To get started, you need to initialize the connection by specifying the domain and key:

```php
$keitaro = new \Wirgen\Keitaro\Keitaro('https://demo-ru.keitaro.io', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
