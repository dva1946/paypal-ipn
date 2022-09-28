<?php
/**
* Template Name: Local Test
* script_name: local-test.php
* parent_script_name: 
* page_name: Local Test
* application_name: WS / MS PayPal Payment Application
* business_use: Member payment management
* author: Dave Van Abel (modified from Ideal Kamerolli)
* dev_site: gvaz.org
* create_date: 2022-09-03
* last_update_date: 2022-09-27
* base_note: IPN Local Test Suite
* status: Public Release 
*/

get_header();
if ( ! defined( 'ABSPATH' ) ) {die( '-1' );}

//$system_mode = 'live'; // set 'test' for sandbox and 'live' for real payments.
$paypal_seller = 'yourseller@yourdomain.com'; //Your PayPal account email address

//$paypal_url = "https://www.wpappsforthat.com/index.php/paypal-ipn.php";	// 09-27-22 This url works

$timestamp = date_i18n('Ymd-HisT'); // Grab Time

// understanding passing to class and more //

class Fruit {
	// Properties
	public $name;
	public $color;
  
	// Methods
	function set_name($name) {
	  $this->name = $name;
	}
	function get_name() {
	  return $this->name;
	}
  }
  
  $apple = new Fruit();
  $banana = new Fruit();
  $apple->set_name('Apple');
  $banana->set_name('Banana');
// *************************************** //
    
?>
<head>
<link rel=”stylesheet” type=”text/css” href=”style.css”>
</head>
<h2>IPN Local Test</h2>
<table name="localtest" id="customers" >
	<form name="localtest" id="localtest" method="post" action="https://www.yourdomain.com/index.php/paypal-ipn/"  >
	
		<div class="row">		
			<!-- Specify product details -->
			<tr> 
			     <div class="col-25">
					<td>Item Name</td>
			     </div>			     
			     <div class="col-75">
					<td> 
						<input maxlength="40" size="40" title="item_one"  value = "GeorgeBeGood" id="item_one" name="item_one" type="text" />
					</td>
			</tr>
			<tr> 
			     <div class="col-25">
			     	<td>Item Amount</td>
			     </div>			     
			     <div class="col-75">
					<td>
						<input maxlength="40" size="20" title="amount" value = "1.00" id="amount" name="amount" type="number"  />
					</td> 
			     </div>			     
			</tr>	
			<tr> 
			     <div class="col-25">
			     	<td>Timestamp</td>
			     </div>			     
			     <div class="col-75">
					<td>
						<input maxlength="40" size="40" title="timestamp" value = "<?php echo $timestamp; ?>" id="timestamp" name="timestamp" type="text"  />
					</td> 
			     </div>			     
			</tr>	
			<!-- Submit -->
			<tr>  
			<div class="row">
				<td colspan="2" style="text-align: center;">
					<!-- Get paypal email address from core_config.php -->
					<input type="hidden" name="business" value="<?php echo $paypal_seller; ?>">
					
					<input type="hidden" name="cmd" value="_xclick">
					
					<!-- WORK REQUIRED HERE -Specify product details -->
					<!-- 04-21-20 removed "item_name", "amount" because in form -->
					
					<!-- <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>"> -->

					<input type="hidden" name="currency_code" value="USD">
					
					<!-- WS / MS custom data -->
					<input type="hidden" name="user_id" value="199628">
					<!-- WS / MS custom data -->
					<input type="hidden" name="user_id" value="199628">
					
					<!-- LOCAL PAYPAL IPN HIDDEN DATA PASSING FOR TESTING PURPOSES -->

					<input type="hidden" name="user_id" value="199628">
						<input type="hidden" name="mc_gross" value="19.95">
						<input type="hidden" name="protection_eligibility" value="Eligible">
						<input type="hidden" name="address_status" value="confirmed">
						<input type="hidden" name="payer_id" value="LPLWNMTBWMFAY">
						<input type="hidden" name="tax" value="0.00">
						<input type="hidden" name="address_street" value="1+Main+St">
						<input type="hidden" name="payment_date" value="20%3A12%3A59+Jan+13%2C+2009+PST">
						<input type="hidden" name="payment_status" value="Completed">
						<input type="hidden" name="charset" value="windows-1252">
						<input type="hidden" name="address_zip" value="95131">
						<input type="hidden" name="first_name" value="Test">
						<input type="hidden" name="mc_fee" value="0.88">
						<input type="hidden" name="address_country_code" value="US">
						<input type="hidden" name="address_name" value="Test+User">
						<input type="hidden" name="notify_version" value="2.6">
						<input type="hidden" name="custom" value="199628">
						<input type="hidden" name="payer_status" value="verified">
						<input type="hidden" name="address_country" value="United+States">
						<input type="hidden" name="address_city" value="San+Jose">
						<input type="hidden" name="quantity" value="1">
						<input type="hidden" name="verify_sign" value="AtkOfCXbDm2hu0ZELryHFjY-Vb7PAUvS6nMXgysbElEn9v-1XcmSoGtf">
						<input type="hidden" name="payer_email" value="gpmac_1231902590_per%40paypal.com">
						<input type="hidden" name="txn_id" value="61E67681CH3238416">
						<input type="hidden" name="payment_type" value="instant">
						<input type="hidden" name="last_name" value="User">
						<input type="hidden" name="address_state" value="CA">
						<input type="hidden" name="receiver_email" value="gpmac_1231902686_biz%40paypal.com">
						<input type="hidden" name="payment_fee" value="0.88">
						<input type="hidden" name="receiver_id" value="S8XGHLYDW9T3S">
						<input type="hidden" name="txn_type" value="express_checkout">
						<input type="hidden" name="item_name" value="mc_currency=USD">
						<input type="hidden" name="item_number" value="">
						<input type="hidden" name="residence_country" value="US">
						<input type="hidden" name="test_ipn" value="1">
						<input type="hidden" name="handling_amount" value="0.00">
						<input type="hidden" name="transaction_subject" value="">
						<input type="hidden" name="payment_gross" value="19.95">
						<input type="hidden" name="shipping" value="0.00">			
					<!-- ********************************************************* -->
					 
					<!-- Local Tests Suite -->
					<!-- <input type="hidden" name="action" value="submit" >  -->
					<input value="Local Test" name="submit" type="submit" /> 
				</td>  
			</div>
			</tr>
	</form>
</table> 
