<?php
/**
* Template Name: Local Test
* script_name: local-test.php
* parent_script_name: 
* page_name: Local Test
* application_name: PayPal Payment Application
* business_use: Member payment management
* author: Dave Van Abel (modified from Ideal Kamerolli)
* dev_site: wpappsforthat.com
* create_date: 2022-10-11
* last_update_date: 2022-10-18
* base_note: IPN Local Test Suite
* status: Public Release 
*/

/**
*********************************************************************************
* NOTICE: As of 10-18-22 this is fully functional code on my website.			*
* NOTICE: As of 10-18-22 this is fully functional code tested on Paypal Sandbox *
*********************************************************************************

* ****** VALID SANDBOX PAYPAL URL 10-15-22 @ 7:36pm *****************************
* $paypal_url = "https://www.mydomain.com/index.php/paypal-ipn/";               *
* HIDDEN IPN after 12-08-22 https://developer.paypal.com/dashboard/ipnSimulator *
* ****** VALID SANDBOX PAYPAL URL 10-15-22 @ 7:36pm *****************************
*
* 10-18-22	Github distribtuion
* 10-18-22 	Got the code running for LOCAL & IPN SIMULATOR.
* 10-17-22  @8:44pm: Got most everything done
* 10-17-22 	local-test-bu-Functinal-StillMinorTweaks-101722-3pm.php
* 10-17-22  local-test-bu-IpnDbNotSaving-10162288pm.php
*           Backups from last night where IPN Simulator records
*           were not saving. Best I can tell, it has to do with minuplating data
*           foreach loop to accumulate data for saving use //
*               foreach ($_POST as $key => $value) {
*           I will attempt to find the problem and then maybe re-write saved raw data.
 * 10-15-22 - Modified code for LOCAL & SIMULATOR testing (see notes under paypal-ipn.php for details)
 * 10-14-22 Next UP: Re-test IPN Simulator. It should run automatically w/o changes in local settings.
 * 10-14-22 Many changes in data flow from local-test.php thru PaypalIPN.php + database structure
 *			Local processing is close to complete, except computed values are not in saved txt file.
 * 10-13-22 LOCAL vs SIMULATOR controlled from local-test.php by this: <input type="hidden" name="run_local_test" value="1">
 *	        In PaypalIPN.php 
 * 10-11-22 Moved to WS - DEV
 * 10-11-22 Major upgrade to add more functionality to local testing
 * 10-08-22 Correct user_id to wp_user.ID (use a query to get it)
 *	and clean up some hidden names and values.
 * 10-07-22 Adding DB code to Apps
 *	and is stored in DB user_id (but it actuall is wp_user.ID)
 * 10-05-22: removed unnecessary code block below. 
*/

if ( ! defined( 'ABSPATH' ) ) {die( '-1' );}	//Removing this or like code can create security risks
get_header();

//$system_mode = 'live'; // set 'test' for sandbox and 'live' for real payments.
$paypal_seller = 'someemail@yahoo.com'; //Your PayPal account email address

//$timestamp = date_i18n('Ymd-HisT'); // Grab Time -> Another easy way to get timestamp
date_default_timezone_set("America/Chicago");
list($year, $month, $day, $hour, $minute, $second, $timezone) = explode(":", date("Y:m:d:H:i:s:T"));
$timestamp = date_i18n('Ymd-His'); // Grab Time

$txn_id = (rand(500000000,900000000));	//simulates a Paypal Transaction ID

$pht 			= new DateTime('now', new DateTimeZone('America/Chicago')); // create an object
$now_time 		= $pht->format('Y-m-d@His');	// format the datetime: Hi => hhmm
$payment_date	= $pht->format('Y-m-d');

	/* SELECT USERNAME that is active and expires on 01-01-2023 */
	// 10-18-22 leaving here if anyone wants to use it.
	//$theuser = "";
	//if (!$theuser) {
	//	$theuser = $wpdb->get_results( "
	//	SELECT wp_users.ID 			AS user_id
	//		,wp_users.user_login 	AS user_login
	//		,metaln.meta_value		AS lastname
	//		,metafn.meta_value		AS firstname
	//		,metaact.meta_value 	AS user_active
	//		,metapdt.meta_value		AS paid_through
	//		,metapt.meta_value 		AS 'Expires'
	//		,metamyp.meta_value 	AS wp_pro
	//		,metaass.meta_value 	AS wp_assoc
	//		,metwpact.meta_value 	AS wp_full
	//		,metapex.meta_value 	AS wp_expired
	//			
	//	FROM wp_users 
	//		LEFT JOIN wp_usermeta metaact 	ON (wp_users.ID = metaact.user_id 	AND metaact.meta_key 	= 'active')
	//		LEFT JOIN wp_usermeta metapdt 	ON (wp_users.ID = metapdt.user_id 	AND metapdt.meta_key 	= 'paid_through')	
	//		LEFT JOIN wp_usermeta metaln  	ON (wp_users.ID = metaln.user_id  	AND metaln.meta_key = 'last_name')
	//		LEFT JOIN wp_usermeta metafn  	ON (wp_users.ID = metafn.user_id  	AND metafn.meta_key = 'first_name')
	//		LEFT JOIN wp_usermeta metapt  	ON (wp_users.ID = metapt.user_id 	AND metapt.meta_key 	= 'expires')
	//		LEFT JOIN wp_usermeta metamyp 	ON (wp_users.ID = metamyp.user_id 	AND metamyp.meta_key 	= '_wpmem_products_myprofile') 
	//		LEFT JOIN wp_usermeta metaass 	ON (wp_users.ID = metaass.user_id 	AND metaass.meta_key 	= '_wpmem_products_associate') 
	//		LEFT JOIN wp_usermeta metwpact 	ON (wp_users.ID = metwpact.user_id 	AND metwpact.meta_key 	= '_wpmem_products_full-membership') 
	//		LEFT JOIN wp_usermeta metapex 	ON (wp_users.ID = metapex.user_id 	AND metapex.meta_key 	= '_wpmem_products_expired') 			
	//		WHERE 
	//				(wp_users.ID = metaact.user_id 	AND (metaact.meta_key = 'active' AND metaact.meta_value = '1'))
	//   			AND (wp_users.ID = metapdt.user_id 	AND (metapdt.meta_key = 'paid_through' AND metapdt.meta_value = '2023-01-01'))
	//		LIMIT 1", 
	//	OBJECT);
	//}
	///* RETRIEVE VALUES FROM SELECT STATEMENT */
//
	//if ($theuser)  { 
	//	foreach ( $theuser as $theuser ) {
	//		$ID 			= $theuser->user_id;
	//		$ws_user_id 	= $theuser->user_login;
	//		$first_name 	= $theuser->firstname;
	//		$last_name 		= $theuser->lastname;
	//		$paid_through	= $theuser->paid_through;	// date
	//		$ws_expires 	= $theuser->Expires;		// date
	//	}
	//}
	$first_name 	= "Don";
	$last_name 		= "Lemon";

	// 10-17-22 For Genertic testing, will use a 4 digit random number
	$ws_user_id = (rand(5000,9000));
	$shop_txn_id 	= "$ws_user_id" . ":" . "$now_time";	// Only for the Wood Shop
	//$shop_txn_id 	= (rand(5000,9000)) . ":" . "$now_time";
	/**************
 * 
*/

?>
<head>
<link rel=”stylesheet” type=”text/css” href=”style.css”>
</head>
<h2>DEV - IPN Local Test</h2>
<table name="localtest" id="customers" >
	<form name="localtest" id="localtest" method="post" action="https://wpappsforthat.com/index.php/paypal-ipn/"  >
	
		<div class="row">		
			<!-- GVRNO - Name -->	
			<tr> 
			     <div class="col-25">
			     	<td>User Login - Name</td>
			     </div>			     
			     <div class="col-50">
					<td>
					<?php echo "$ws_user_id - $first_name $last_name"; ?>
					</td> 
			     </div>			     
			     <div class="col-25">
					<td>No real value beyond user_login and name</td>
			     </div>			     
			</tr>	
			<!-- Transaction Type -->	
			<tr> 
			     <div class="col-25">
					<td>Transaction / Type</td>
			     </div>			     
			     <div class="col-50">
					<td> 
						<!-- Changing this design will greatly ness up PaypalIPN.php code -->
						<select name="payment_status" required>
							<!-- <option value="">--Select--</option> -->
							<option value="Verified|instant">Completed - credit card</option>
							<option value="Pending|echeck">Pending - echeck</option>
							<option value="Declined|instant">Declined - credit card</option>
							<option value="Expired|instant">Expired - credit card</option>
							<option value="Failed|instant">Failed - credit card</option>
							<option value="Failed|echeck">Failed - echeck</option>
							<option value="Refunded|instant">Refunded - credit card</option>
							<option value="Refunded|echeck">Refunded - echeck</option>
							<option value="Reversed|instant">Reversed - credit card</option>
							<option value="Reversed|echeck">Reversed - echeck</option>
							<option value="Partially-Refunded|instant">Partially Refunded - credit card </option>
							<option value="Partially-Refunded|echeck">Partially Refunded - echeck </option>
						</select> 
					</td>
			     </div>			     
			     <div class="col-25">
					<td>Transaction / Type</td>
			     </div>			     
			</tr>
			<tr> 
			     <div class="col-25">
			     	<td>Select Membership Option</td>
			     </div>			     
			     <div class="col-50">
					<td> 
						<select name="mc_gross" required>
							<!-- <option value="">--Select--</option> -->
							<option value="40.00">$40 - Membership</option>
							<option value="50.00">$50 - Membership + One Drawer</option>
							<option value="60.00">$60 - Membership + Two Drawers</option>
							<option value="70.00">$70 - Membership + Locker</option>
							<option value="90.00">$90 - Membership + Two Drawers + Locker</option>
						</select> 
					</td>
			     </div>			     
			     <div class="col-25">
					<td>YOU CAN MAKE ANOTHER SELECTION IN PULLDOWN.</td>
			     </div>			     
			</tr>	
			<tr> 
			     <div class="col-25">
					<td>Payment</td>
			     </div>			     
			     <div class="col-50">
				 <td> 
						<select name="item_name" required>
							<!-- <option value="">--Select--</option> -->
							<option value="membership">Membership, Drawers & Lockers</option>
							<!-- 
							<option value="sawblade">Stop Saw</option>
							<option value="coffeefund">Coffee Fund</option>
							<option value="sandpaper">Sandpapger</option>
							-->
						</select> 
					</td>
					<div class="col-25">
					<td>No real value in the App.</td>
			     </div>			     
			</tr>
			<tr> 
			     <div class="col-25">
			     	<td>Local or IPN Simulator</td>
			     </div>			     
			     <div class="col-50">
					<td> 
						<!-- 10-18-22 modified to 1 or 2 -->
						<select name="run_local_test" required>
							<!-- <option value="">--Select--</option> -->
							<option value="1">Run Local Test</option>
							<option value="2">Run Local Simulator Test</option>
						</select> 
					</td>
			     </div>			     
			     <div class="col-25">
					<td>Exercise as LOCAL or LOCAL SIMULATOR.</td>
			     </div>			     
			</tr>	
			<!-- Submit -->
			<tr>  
			<div class="row">
				<td colspan="2" style="text-align: center;">
					<input type="hidden" name="business" value="<?php echo $paypal_seller; ?>">				
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>"> 					
					<!-- LOCAL PAYPAL IPN HIDDEN DATA PASSING FOR TESTING PURPOSES -->
					<input type="hidden" name="user_id" value="<?php echo $ws_user_id; ?>">
					<input type="hidden" name="mc_currency" value="USD">						
					<input type="hidden" name="protection_eligibility" value="Eligible">
					<input type="hidden" name="address_status" value="confirmed">
					<input type="hidden" name="payer_id" value="LPLWNMTBWMFAY">
					<input type="hidden" name="tax" value="0.00">
					<input type="hidden" name="address_street" value="1+Main+St">
					<input type="hidden" name="payment_date" value="20%3A12%3A59+Jan+13%2C+2009+PST">
					<input type="hidden" name="charset" value="windows-1252">
					<input type="hidden" name="address_zip" value="95131">
					<input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
					<input type="hidden" name="address_country_code" value="US">
					<input type="hidden" name="address_name" value="Test+User">
					<input type="hidden" name="notify_version" value="2.6">
					<input type="hidden" name="custom" value="199628">
					<input type="hidden" name="payer_status" value="verified">
					<input type="hidden" name="address_country" value="United+States">
					<input type="hidden" name="address_city" value="San+Jose">
					<input type="hidden" name="quantity" value="1">
					<input type="hidden" name="verify_sign" value="AtkOfCXbDm2hu0ZELryHFjY-Vb7PAUvS6nMXgysbElEn9v-1XcmSoGtf">
					<input type="hidden" name="payer_email" value="buyer%40paypalsandbox.com">
					<input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
					<input type="hidden" name="address_state" value="CA">
					<input type="hidden" name="receiver_email" value="gpmac_1231902686_biz%40paypal.com">
					<input type="hidden" name="receiver_id" value="S8XGHLYDW9T3S">
					<input type="hidden" name="txn_type" value="express_checkout">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="item_number" value="">
					<input type="hidden" name="residence_country" value="US">
					<input type="hidden" name="test_ipn" value="1">
					<input type="hidden" name="handling_amount" value="0.00">
					<input type="hidden" name="transaction_subject" value="">
					<input type="hidden" name="shipping" value="0.00">
					<input type="hidden" name="shop_txn_id" value="<?php echo $shop_txn_id; ?>">			
					<input type="hidden" name="txn_id" value="<?php echo $txn_id; ?>">			
					<!-- Local Tests Suite -->
					<input value="Local Test" name="submit" type="submit" /> 
				</td>  
			</div>
			</tr>
		</div>
	</form>
</table> 
