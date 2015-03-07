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
    'JPY' => 164.5498,  // USD * JPY = JPY rate relative to EUR 
    'CAD' => 1.6201     // GBP * CAD = CAD rate relative to EUR
    );
  private $errors = array();

  public function __construct() {
    // class construct
  }

  /*
    Function to convert one currency to another.
    Accepts three arguments:

    from: (string) an ISO 4217 currency code
    to: (string) an ISO 4217 currency code
    amount: (float) amount to convert
    returns a string
  */
  public function convert($from, $to, $amount) 
  {
    
    /** Do some error checking
     ***************************************************************************
     */
      
      // // Check if the source currency exisits in _exchrate
      // if ( !array_key_exists($from, $this->_exchrate) )
      // {
      //   $this->errors[] = "ERROR: unable to retrieve SOURCE exchange rate" . PHP_EOL;
      // }

      // // Check if the target currency exisits in _exchrate
      // if ( !array_key_exists($to, $this->_exchrate) )
      // {
      //   $this->errors[] = "ERROR: unable to retrieve TARGET exchange rate". PHP_EOL;
      // }

      // // Check is amount is a number
      // if ( !is_numeric($amount) ) 
      // {
      //   $this->errors[] = "ERROR: Ammount is not a number.". PHP_EOL;
      // }
    
      // // If there are errors, return messages
      // if ( count($this->errors) ) 
      // {
      //   $messages = implode($this->errors);
      //   $this->errors = array(); // reset the array
      //   return $messages;
      // }

    /** Checks passed, on to main conversion
     ***************************************************************************
     */
    
      if ($to == "EUR")
      {
        // converting to EUR, find inverse of currency
        $value = $amount * ( 1 / $this->_exchrate[$from]) / $this->_exchrate[$to];
      } else {
        // normal conversion calaulation
        $value= $amount * $this->_exchrate[$to] / $this->_exchrate[$from];
      }

      // round up to 4 significant digits
      $value = round($value, 4); 
      
      // english number format, truncate to two decimal places
      $value = number_format($value, 2, ".", ",");
      
      // Append target Currentcy code
      $value = $value . ' ' . $to . PHP_EOL; 

      return $value;

  }

  public function getCurrencies()
  {
    return array_keys($this->_exchrate);
  }

}