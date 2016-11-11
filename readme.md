#Doctype Validator
Test to see if an HTML doctype is valid according to the W3C specifications.

See more at:
https://beutnagel.github.io/Doctype-Validator/

![](https://codeship.com/projects/ff65d870-8a55-0134-9eb2-5a7c9acf56e8/status?branch=master)


[![Latest Stable Version](https://img.shields.io/packagist/v/beutnagel/doctype-validator.svg)](https://packagist.org/packages/beutnagel/doctype-validator)
[![Total Downloads](https://img.shields.io/packagist/dt/beutnagel/doctype-validator.svg)](https://packagist.org/packages/beutnagel/doctype-validator)
[![Reference Status](https://www.versioneye.com/php/beutnagel:doctype-validator/reference_badge.svg)](https://www.versioneye.com/php/beutnagel:doctype-validator/references)
[![GitHub issues](https://img.shields.io/github/issues/beutnagel/Doctype-Validator.svg)](https://github.com/beutnagel/Doctype-Validator/issues)

##Installation##

Install with Composer

`$ composer require beutnagel/doctype-validator`

For the current alpha release

```javascript
{
	"require": {
        "beutnagel/doctype-validator": "^0.1.1@alpha"
    },
    "minimum-stability": "alpha"
}
```

##Basic Usage
```php
<?php
  $doctype = "<!DOCTYPE html>";
  $dt = new Doctype_Validator();
  $valid = $dt->validate($doctype)->isValid();
```

