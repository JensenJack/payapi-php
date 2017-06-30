# Paysbuy PayAPI - PHP SDK

`payapi-php` allows you to use the [Paysbuy PayAPI](#linkhere) easily within your PHP projects

## Requirements

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
