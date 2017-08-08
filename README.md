# Paysbuy PayAPI - PHP SDK

`payapi-php` allows you to use the [Paysbuy PayAPI](#linkhere) easily within your PHP projects

## * _IMPORTANT Announcement_ *

PAYSBUY has been acquired by [Omise](http://omise.co). As a result of this, PAYSBUY's online payment services will eventually be shutting down. Merchants should be contacted regarding migration to Omise's online payment services.

Omise has a PHP library for its payment services [here](https://github.com/omise/omise-php), but it is important to note that it is unlikely to be compatible with your existing code that uses the Paysbuy library.

Please direct further questions to the Omise [forum](http://forum.omise.com) or [support@omise.co](mailto:support@omise.co)

[https://www.paysbuy.com/news-226.aspx](https://www.paysbuy.com/news-226.aspx)


## SDK Requirements

* PHP 5.3+ with libcurl 

## Installation

### Using Composer (easiest)

The library is simple to install using [Composer](https://getcomposer.org/). If you've never used Composer(?!) and need to install it, just follow the instructions [here](https://getcomposer.org/doc/00-intro.md#system-requirements). Installing this way makes it simple to update the library to the latest version to get all the latest fixes and improvements.

Once installed, simply add `payapi-php` as a project dependency:

```json
{
  "require": {
    "paysbuy/payapi-php": "dev-master"
  }
}
```

Then run `composer install` to install the library.

Next, make sure you have the `/vendor/autoload.php` file included in your project


### Manual Method

If you don't use Composer, clone this repo and copy the files into your project.

```
git clone https://github.com/paysbuy/payapi-php
```

All you need to do then is to include the `.../path/to/payapi-php/lib/PaysbuyPayAPI.php` file in your project


## Usage

Sample code can be found in [`sample.php`](https://github.com/paysbuy/payapi-php/blob/master/sample.php)

## License

See [LICENSE](https://github.com/paysbuy/payapi-php/blob/master/LICENSE) file
