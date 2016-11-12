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
The `Doctype_Validator` can be used to check the validity of a doctype, find errors and match it with existing official doctypes.

1) First create an instance of the validator:

```php
$dtv = new Doctype_Validator();
```

2) Assign the doctype you want to validate:

```php
$doctype = "<!DOCTYPE html>";
```

#### Is it a valid doctype?
Checking to see if a doctype is valid.

```php

$valid = $dtv->validate($doctype)->isValid();
```

*@return boolean TRUE or FALSE.*

#### Does it match an official doctype?

A check can be performed with `isMatch()` to see if there is a match.

```php
$match = $dtv->validate($doctype)->isMatch();
```


Returns which official doctype it mathces with or NULL if none.

```php
$matches = $dtv->validate($doctype)->matches();
```

*@return string of name of match, or NULL if no match.*

#### Errors
If a doctype is not valid, `Doctype_Validator` will try to analyse why it is not valid. A list of errors can be found in `Doctype_Error.php`.

A simple check if a doctype has errors in it can be performed by the `hasError()` function.

```php
$error = $dtv->validate($doctype)->hasError();
```
*@return boolean TRUE or FALSE.*


You can retrieve errors with the `getErrors()` method.

```php
$result  = $dtv->validate($doctype);
if($result->hasErrors())
{
  $errors = $result->getErrors();
}
```
*@return array of errors.*

#### Fragments
The doctype will be dissected into smaller fragments and these can be access with `getFragments()`.

```php
$fragments = $dtv->validate($doctype)->getFragments();
```
*@return array of fragmentens*
### License

Doctype Validator is licensed under the MIT License - see the `LICENSE` file for details

### Author
Jarne W. Beutnagel - <jarne@beutnagel.dk> - [beutnagel.dk](http://beutnagel.dk)
