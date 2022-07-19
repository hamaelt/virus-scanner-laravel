Virus Scanner
==========


A validation rule for validating MIME type of zip files for Laravel to validate that the zip file only contains the allowed file types.


# Requirement

- PHP 8+
- PHP Extension `socket`
- Laravel 8+

# Installation

```bash
composer require hamaelt/virus-scanner
```

# Publish config files
```bash
php artisan vendor:publish --provider="Hamaelt\VirusScanner\Providers\ServiceProvider"
```

The service provider will automatically be registered.
However , you can manually add the service provider to your app/config.php file

``` 
  'providers' => [
      //...
      "Hamaelt\VirusScanner\Providers\ServiceProvider::class"
  ];

```
