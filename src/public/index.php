<?php 
/**
 *******************************************************************************
 * File:   index.php
 * Author: Shawn Haigh - Mar 7, 2015
 * 
 * Decsription: Displays form contols to input currencies and and amount to 
 *              convert. Displays the result or any errors.
 *******************************************************************************
 */
define('CAPSWITCH', TRUE);

// define a constant to the lib folder outsite of the public root
define('__LIB__', dirname(dirname(__FILE__)).'/lib'); 

// require the capswtich class
require_once(__LIB__ . '/capswitch.class.php');

// instantiate the class
$c = new capswitch;

// Using GET
if ( count($_GET) ) {
  
  // Do some security checks
  $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_STRING);
  $from = $c->validateCode($from, "Source Currency");

  $to = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_STRING);
  $to = $c->validateCode($to, "Target Currency");

  $amount = filter_input(INPUT_GET, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
  $amount = $c->validateNum($amount);

} else {
  
  // Set some default values
  $to = 'EUR';
  $from = 'EUR';
  $amount = 0;

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
              <input name="amount" type="number" step="any" class="form-control" id="amount" value="<?php echo $amount; ?>" >
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary">convert</button>
        
        </form>
        
        <hr class="half-margins invisible">

        <?php if ($c->errors): ?><div class="alert alert-danger" role="alert"><?php $c->getErrors() ?></div><?php endif; ?>

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