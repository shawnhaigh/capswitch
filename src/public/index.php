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

/*
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
*/

// Using GET for simplicity
if ( count($_GET) ) {
  $to = (string) htmlspecialchars($_GET['to']);
  $from = (string) htmlspecialchars($_GET['from']);
  $amount = (integer) htmlspecialchars($_GET['amount']);
} else {
  $to = 'EUR';
  $from = 'EUR';
  $amount = 0.00;
}


// Output HTML
include 'header.inc.php';
?>

  <section>
    <div class="container">
      <div class="col-md-12">
          
          <h1>Programmieraufgabe 2. Runde</h1>
          <h4>Shawn Haigh <small>Mar 7th, 2015</small></h4>
      </div>
    </div>
  </section>

  <hr>

  <section>
    <div class="container">
      <div class="col-md-12">
        <form class="form-inline" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         
          <div class="form-group">
            <label for="sourceCurrency">Source Currency</label>
            <select name="from" id="sourceCurrency"><?php
              foreach ($c->getCurrencies() as $currency) {
                if ( "$from" == "$currency")
                {
                  echo "<option vlaue=\"$currency\" selected>$currency</option>";
                } else {
                  echo "<option vlaue=\"$currency\">$currency</option>";
                }
              }
            ?>
            </select>
          </div>

          <div class="form-group">
            <label for="targetCurrency">Target Currency</label>
            <select name="to" id="sourceCurrency"><?php              
              foreach ($c->getCurrencies() as $currency) {
                if ( "$to" == "$currency")
                {
                  echo "<option vlaue=\"$currency\" selected>$currency</option>";
                } else {
                  echo "<option vlaue=\"$currency\">$currency</option>";
                }
              }
            ?>
            </select>
          </div>

          <div class="form-group">
            <label for="amount">Amount to convert</label>
            <div class="input-group">
              <input name="amount" type="number" class="form-control" id="amount" value="<?php echo (bool) $amount ? $amount : '0.00'; ?>" >
            </div>
          </div>

          <button type="submit" class="btn btn-primary">convert</button>
        </form>
        
        <hr class="half-margins invisible">

        <div class="well">
          <h1><?php 
            echo $c->convert($from, $to, $amount); 
          ?></h1>
        </div>

      </div>
    </div>
  </section>

<?php include 'footer.inc.php'; 
?>