# Numeration-Bundle

[![Latest Stable Version](https://poser.pugx.org/flexphp/numeration-bundle/v/stable)](https://packagist.org/packages/flexphp/numeration-bundle)
[![Total Downloads](https://poser.pugx.org/flexphp/numeration-bundle/downloads)](https://packagist.org/packages/flexphp/numeration-bundle)
[![Latest Unstable Version](https://poser.pugx.org/flexphp/numeration-bundle/v/unstable)](https://packagist.org/packages/flexphp/numeration-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/flexphp/flex-numeration-bundle/badges/quality-score.png)](https://scrutinizer-ci.com/g/flexphp/flex-numeration-bundle)
[![Code Coverage](https://scrutinizer-ci.com/g/flexphp/flex-numeration-bundle/badges/coverage.png)](https://scrutinizer-ci.com/g/flexphp/flex-numeration-bundle)
[![License](https://poser.pugx.org/flexphp/numeration-bundle/license)](https://packagist.org/packages/flexphp/numeration-bundle)
[![composer.lock](https://poser.pugx.org/flexphp/numeration-bundle/composerlock)](https://packagist.org/packages/flexphp/numeration-bundle)

Numeration bundle for Symfony

Change between frameworks when you need. Keep It Simple, SOLID and DRY with FlexPHP.

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
composer require numeration-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require flexphp/numeration-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    FlexPHP\Bundle\FlexPHPNumerationBundle::class => ['all' => true],
];
```

## License

Numeration-bundle is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
