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
    'JPY' => 164.549847,  // USD * JPY = JPY rate relative to EUR 
    'CAD' => 1.61800557   // GBP * CAD = CAD rate relative to EUR
    );
  public $errors = array();

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
    
    // are there errors?
    if ( count($this->errors) ) {
      return 0;
    }
    
    /** Checks passed, on to main conversion
     ***************************************************************************
     */
    
      if ($to == "EUR") {
        
        // converting to EUR, find inverse of currency
        $value = $amount * ( 1 / $this->_exchrate[$from]) / $this->_exchrate[$to];
        
        } else {
          
          // normal conversion calaulation
          $value= $amount * $this->_exchrate[$to] / $this->_exchrate[$from];
        
        }

      // round up to 2 significant digits
      $value = round($value, 2); 
      
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

  public function validateCode($iso, $orig) 
  {
    // Verify if the exchange rate is valid and exists.
    if (!preg_match('/[A-Z][A-Z][A-Z]/', $iso) || !array_key_exists($iso, $this->_exchrate)) {
      $this->errors[] = "Invalid Exchange Rate ISO code in $orig";
      return "";
    }

    return $iso;
    

  }

  public function validateNum($num)
  {
    
    if (!is_numeric($num))
    {
      $this->errors[] = "Invalid Amount, must be a number like '1.234'";
      return 0;
    }
    
    return $num;

  }

  public function getErrors()
  {
    if ( count($this->errors) ) 
    {
      foreach ($this->errors as $mesage) {
        echo $mesage . "<br/>";
      }
    }
  }
}