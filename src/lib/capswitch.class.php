<?php 
/**
 *******************************************************************************
 * File:   capswitch.php
 * Author: Shawn Haigh
 *  
 * Decsription:  Implements a simple currencly converter - PHP 5.4.36
 *******************************************************************************
 */


/**
* 
*/
class capswitch
{

  // Rates relative to the EUR
  private $_exchrate = array(
    'EUR' => 1,         //base rate
    'USD' => 1.5897,
    'CHF' => 1.6135,
    'GBP' => 0.8031,
    'JPY' => 164.5498,  // USD rate multiplied given JPY rate equals rate relative to EUR 
    'CAD' => 1.6201     // GBP rate multiplied by given CAD rate equals rate relative to EUR
    );

  public function convert($from, $to, $amount) 
  {

    if ($to == "EUR") {
      $value = $amount * ( 1 / $this->_exchrate[$from]) / $this->_exchrate[$to];
    } else {
      $value= $amount * $this->_exchrate[$to] / $this->_exchrate[$from];
    }

    $value = round($value, 4);
    $value = number_format($value, 2, ".", ","); // english number format
    $value = $value . ' ' . $to;
    return $value;
  }

}