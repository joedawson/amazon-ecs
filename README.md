# Amazon ECS for Laravel

Whilst working on a project, I need the ability to search for products on Amazon as well as lookup individual products based on their ASIN which led me to make a dedicated package for that as *sometimes*, the process to authorise with Amazon is a little awkward. To say the least.

## Installation

```
composer require dawson/amazon-ecs
```

After you have successfully installed, add the follow Service Provider and Facade to your `config/app.php`.

```
Dawson\AmazonECS\AmazonECSServiceProvider::class,
```

```
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

```
$response = Amazon::search('Home Alone');
```

**It's that simple!** The request should return an XML response.


*Please note*, this currently searches the entire Amazon catalog. I plan on adding the ability to search within a given category *soon* so keep an eye out  for that.

### Lookup

You can also lookup any given item, assuming it's availble on your configure locale and is a valid **ASIN**, of which is possible by doing the following:

```
$product = Amazon::product('B004VLKY8M');

```

This will simply return the product, it's attributes and item links.

## Questions & Issues

Should you have any questions or come across a problem, please feel free to submit an issue.

---

## Planned

- [X] Finish Documentation
- [X] Locales
- [ ] Better Exception Handling
- [ ] Cart abilities, such as modifying, adding, clearing etc.
- [ ] XML to JSON (the ECS API returns an XML response, I myself would like to have the ability to convert this to JSON - but optional)