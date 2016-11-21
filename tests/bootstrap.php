<?php

$root    = realpath(dirname(dirname(__FILE__)));

if (!file_exists($root . '/vendor/autoload.php')) {
    throw new Exception(
        'Please run "php composer.phar install --dev" in root directory '
        . 'to setup unit test dependencies before running the tests'
    );
}
require_once(realpath($root).'/vendor/autoload.php');
require_once(realpath($root).'/src/doctype_validator.php');
require_once(realpath($root).'/src/doctype_result.php');
require_once(realpath($root).'/src/Doctype_Error.php');
