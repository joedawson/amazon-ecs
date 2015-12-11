# Amazon ECS (E-Commerce Services) Package for Laravel

If you need the ability to search Amazon's catalog of products or lookup an individual item with Laravel, then this may be the package for you.

**Please note, you'll need to ensure you have an associate tag before using this package.**

## Installation

```
composer require dawson/amazon-ecs
```

After you have successfully installed, add the follow Service Provider to your `config/app.php`.

```php
Dawson\AmazonECS\AmazonECSServiceProvider::class,
```

And the following facade, also in `config/app.php`.

```php
'Amazon' => Dawson\AmazonECS\AmazonECSFacade::class
```

Now we'll go ahead and publish the `amazon.php` configuration file.

```
php artisan vendor:publish --provider="Dawson\AmazonECS\AmazonECSServiceProvider"
```

Open up the `amazon.php` configuration file and enter your credentials or leverage the use of environment variables which're used by default.

When it comes to choosing a `locale`, you have a choice of the following:

|Locale    |Country           |
|----------|------------------|
|`co.uk`   |United Kingdom    |
|`com`     |United States     |
|`ca`      |Canada            |
|`com.br`  |Brazil            |
|`de`      |Germany           |
|`es`      |Spain             |
|`fr`      |France            |
|`in`      |India             |
|`co.jp`   |Japan             |
|`com.mx`  |Mexico            |

**You should now be correctly configured!**

## Usage

Currently, there are two methods available which are `search` and `lookup`.

### Search

```php
$results = Amazon::search('Home Alone')->json();
```

**It's that simple!**


*Please note*, this currently searches the entire Amazon catalog. I plan on adding the ability to search within a given category *soon* so keep an eye out  for that.

### Lookup

You can also lookup any given item, assuming it's availble on your configure locale and is a valid **ASIN**, of which is possible by doing the following:

```php
$product = Amazon::lookup('B004VLKY8M')->json();
```

This will simply return the product, it's attributes and item links.

## Responses

Currently, there are two available response methods. The default `xml` method, or my preferred - `json`.

The following returns an XML string.

```php
$xml = Amazon::search('Call of Duty')->xml();
```

And as you can probably assume, the following returns a JSON string.

```php
$json = Amazon::search('Halo')->json();
```

## Questions & Issues

Should you have any questions or come across a problem, please feel free to submit an issue.

## License

This package is open-sourced software licensed under the MIT license.

---

## Planned

- [X] Finish Documentation
- [X] Locales
- [ ] Better Exception Handling
- [ ] Cart abilities, such as modifying, adding, clearing etc.
- [X] XML to JSON (the ECS API returns an XML response, I myself would like to have the ability to convert this to JSON - but optional)
