#Doctype Validator
Test to see if an HTML doctype is valid according to the W3C specifications.

See more at:
https://beutnagel.github.io/Doctype-Validator/

![](https://codeship.com/projects/ff65d870-8a55-0134-9eb2-5a7c9acf56e8/status?branch=master)

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

