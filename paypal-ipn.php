<?php namespace Listener;
/**
* Template Name: Paypal Ipn
* script_name: paypal-ipn.php
* parent_script_name: none
* page_name: WS Paypal Ipn
* application_name: PayPal IPN Validation for PayPal IPN
* business_use: WpApps PayPal Ipn Solutions
* re-authored: Dave Van Abel
* dev_site: wpappsforthat.com
* re-create_date: 2022-10-13
* last_update_date: 2022-10-18
* base_note: Source = https://dopehacker.com/paypal-integration-website-php/ & now from Github.com
* Github 08-28-22 DVA: https://github.com/paypal/ipn-code-samples/blob/master/php/example_usage_advanced.php
* A list of variables is available here:
* https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
* Last Committed: Latest commit 3b21502 on May 4, 2017 
* status: Work-in-progress 
* Listener MUST BE 1ST THING (excluding comments) in the file
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
* 10-17-22 	paypal-ipn-bu-Functinal-StillMinorTweaks-101722-3pm.php
* 10-17-22  paypal-ipn-bu-IpnDbNotSaving-10162288pm.php
*           Backups from last night where IPN Simulator records
*           were not saving. Best I can tell, it has to do with minuplating data
*           foreach loop to accumulate data for saving use //
*               foreach ($_POST as $key => $value) {
*           I will attempt to find the problem and then maybe re-write saved raw data.
*
* 10-15-22 Modified code for LOCAL & SIMULATOR testing
*          1) Added option on local-test.php to select:
*               a) Run Local Test 
*               b) Run Simulator Test
*          2) Explaination of each:
*               a) All data used from local-test.php input
*               b) Still uses local data, but "run_local_test" set to 0.
*                  Still uses local test, but does not compute pay_fee and pay_net
*                  INTENT: Try to emulate data directly from PayPal - IPN and still run locally.
*                  MODIFYING: Once known data from PayPal - IPN is captured, can come back here
*                             and update local-test.php to MATCH PayPal - IPN data.
*                  RESULTS: Can run most testing local and still process / handle PayPal - IPN received data.
* 10-13-22 LOCAL vs SIMULATOR controlled from local-test.php by this: <input type="hidden" name="run_local_test" value="1/2">
*          In PaypalIPN.php 
* 10-11-22 Moved to WS - DEV
* 10-07-22 Adding DB code to Apps
* 10-07-22 Backed up code = paypal-ipn-GoodCode-100722-548pm.php
* 09-27-22 echo print lines have been left in for local debugging & do not affect PP Simulator.
* 09-27-22 DVA re-testing locally, tested Paypal Simulator. Both Good!
* 09-26-22 DVA retested locally.
* 09-09-22 @8:31pm - DVA This is SIMULATOR USE - SANDBOX
*/

if ( ! defined( 'ABSPATH' ) ) {die( '-1' );}    //Removing this or like code can create security risks

?>
    <br>PP->TOP OF LOCAL DEV - IPN TEST PROCESS! -> <a href="/index.php/local-test/"><b>IPN Local Test</b></a><br><br>
<?php

$enable_sandbox = true; // Set this to true to use the sandbox endpoint during testing
// SIMULATOR LOCATION   //
//$test_local = 1;      // 1= Local / Local simulator = 2
//$test_local = ;       // 0 = Paypal Simulator
$test_local = 0;        // 10-13-22 now bet below from local-test.php
//$my_email_addresses = array("my_email_address@gmail.com", "my_email_address2@gmail.com", "my_email_address3@gmail.com");
//$my_email_addresses = array("yourseller@yourdomain.com");
$my_email_addresses = array("omeemail@yahoo.com");

require('PaypalIPN.php');
use PaypalIPN;
$ipn = new PaypalIPN();

echo "PP-1a1->Before New PaypalIPN Function defined<br>";

$location = new PaypalIPN();

echo "PP-1a2->After New PaypalIPN Function defined<br>";

// 10-14-22 Retrieve from local-test.php
$run_local_test =  "";                          // default null if called by PayPal IPN
//$test_local =  $_POST['run_local_test'];      // retrieve from local-test.php (maybe re-write to check if exists)
if (!empty( $_POST['run_local_test'])) {
    $test_local =  $_POST['run_local_test'];    // retrieve from local-test.php (maybe re-write to check if exists)
}
if ($test_local) {
    echo "PP-1a4-> Running as LOCAL SIMULATOR<br>";
}
else {
    echo "PP-1a4-> Running as PayPal - IPN SIMULATOR<br>";

}

echo "PP-2a1->Before set_name Function call<br>";

$location->set_name($test_local);

echo "PP-2a2->After set_name Function call<br>";


list ($local_ver, $local_inv, $sim_ver, $sim_inv) = $location->get_name($test_local);

echo "<br>PP-3a1->Local Valid = $local_ver<br>";
echo "PP-3b1->Local InValid = $local_inv<br>";
echo "PP-3c1->Sim Valid = $sim_ver<br>";
echo "PP-3d1->Sim InValid = $sim_inv<br>";

if ($enable_sandbox) {
    $ipn->useSandbox();
}

list($verified, $logfile, $data_text) = $ipn->verifyIPN(); 

if ($verified) {
    echo "<br>PP-Worked<br>Logfile = $logfile<br>";   // No content for SIMULATOR VERSION
} else {
    echo "<br>PP End -> FAILED<br>";
}
?>
<br>PP->BOTTOM OF LOCAL DEV - IPN TEST PROCESS! -> <a href="/index.php/local-test/"><b>IPN Local Test</b></a><br><br>
<?php
if ($verified) {echo "$data_text<br>";} 
// END //
?>
