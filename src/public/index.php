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

// define a constant to the lib folder
define('__LIB__', dirname(dirname(__FILE__)).'/lib'); 

// require the capswtich class
require_once(__LIB__ . '/capswitch.class.php');

// instantiate the class
$c = new capswitch;

echo $c->convert('EUR', 'USD', 100);
echo $c->convert('USD', 'EUR', 100);
echo $c->convert('EUR', 'CHF', 100);
echo $c->convert('EUR', 'GBP', 100);
echo $c->convert('USD', 'JPY', 100);
echo $c->convert('CHF', 'USD', 100);
echo $c->convert('GBP', 'CAD', 100);

echo "Example of an invalid SOURCE currency" . PHP_EOL;
echo $c->convert('GPL', 'USD', '100');

echo "Example of an invalid TARGET currency" . PHP_EOL;
echo $c->convert('EUR', 'GPL', '100');

 echo $c->convert('GBP', 'CAD', "F00");