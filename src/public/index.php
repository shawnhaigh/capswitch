<?php 
/**
 *******************************************************************************
 * File:   index.php
 * Author: Shawn Haigh - Mar 7, 2015
 * 
 * Decsription: 
 *******************************************************************************
 */
define('CAPSWITCH', TRUE);

// Define a constant to the lib folder
define('__LIB__', dirname(dirname(__FILE__)).'/lib'); 

// require the capswtich class
require_once(__LIB__ . '/capswitch.class.php');

// Instantiate the class
$c = new capswitch;

echo $c->convert('EUR', 'USD', 100) . PHP_EOL;
echo $c->convert('USD', 'EUR', 100) . PHP_EOL;
echo $c->convert('EUR', 'CHF', 100) . PHP_EOL;
echo $c->convert('EUR', 'GBP', 100) . PHP_EOL;
echo $c->convert('USD', 'JPY', 100) . PHP_EOL;
echo $c->convert('CHF', 'USD', 100) . PHP_EOL;
echo $c->convert('GBP', 'CAD', 100) . PHP_EOL;

echo "---" . PHP_EOL;

echo $c->convert('PEP', 'USD', 100) . PHP_EOL;

