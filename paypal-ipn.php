<?php namespace Listener;
/**
* Template Name: Paypal Ipn
* script_name: paypal-ipn.php
* parent_script_name: 
* page_name: Paypal Ipn
* application_name: PayPal IPN Validation for PayPal IPN
* business_use: WpApps PayPal Ipn Solutions
* re-authored: Dave Van Abel
* dev_site: wpappsforthat.com
* re-create_date: 2022-08-22
* last_update_date: 2022-09-26
* base_note: Source = https://dopehacker.com/paypal-integration-website-php/ & now from Github.com
* Github 08-28-22 DVA: https://github.com/paypal/ipn-code-samples/blob/master/php/example_usage_advanced.php
* Last Committed: Latest commit 3b21502 on May 4, 2017 
* status: Work-in-progress 
* WithDBCode: paypal-ipn-08-28-22-withDBsavedCode.php
* Listener MUST BE 1ST THING (excluding comments) in the file
*/
 
/**
* 09-26-22 DVA retested locally.
* 09-09-22 @8:31pm - DVA This is SIMULATOR USE - SANDBOX
* 09-08-22 DVA - Added if ($le) { code and also had to pass $le + retrieve on some functions (PaypalIPN.php).
*                As of now, can not pass to "public function usePHPCerts()" as not called from paypal-ipn.php script
* GENERAL RULLE ON pass to function & retrieve: 
* Pass to: $ipn = new PaypalIPN($le);
* Retrieve from: public function useSandbox($le)
* UNABLE TO MANAGE:
*       public function usePHPCerts(), as not called from paypal-ipn.php
*       but never called
* IF EVER NECESSARY !!
 * How to create cert files?
 * Use this command from a terminal on the Mac Mini:
 * $openssl req -newkey rsa:2048 -new -nodes -x509 -days 3650 -keyout key.pem -out cert.pem<cr>
 * Follow all commands and two files created for the cert!
 * Outputs: 
 * 1) Location = /Users/davevanabel
 * 2) cert.pem and key.pem
 * 3) Now more out each file and
 * 4) Save to 0-wpappsforthat.com/cert
 * 5) Copy over to wpappsforthat.com website: <wp-content>
 * 6) Now should have valid certs for PaypalIPN use!
 */
//
if ( ! defined( 'ABSPATH' ) ) {die( '-1' );}

?>
    <br>PP->TOP OF LOCAL IPN TEST PROCESS! -> <a href="index.php/local-test/"><b>IPN Local Test</b></a><br><br>
<?php

$enable_sandbox = true; // Set this to true to use the sandbox endpoint during testing

//$my_email_addresses = array("my_email_address@gmail.com", "my_email_address2@gmail.com", "my_email_address3@gmail.com");
$my_email_addresses = array("my_email_address@gmail.com");

require('PaypalIPN.php');
use PaypalIPN;
$ipn = new PaypalIPN();

//SIMULATOR LOCATION //
$test_local = 1;   // 1= Local, 0 = Paypal Simulator

echo "PP-1a1->Before New PaypalIPN Function defined<br>";

$location = new PaypalIPN();

echo "PP-1a2->After New PaypalIPN Function defined<br>";
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

//$verified = $ipn->verifyIPN($test_local); 
//list($verified, $logfile, $data_text) = $ipn->verifyIPN($test_local); // don't think need to pass value
list($verified, $logfile, $data_text) = $ipn->verifyIPN(); 

if ($verified) {
    echo "<br>PP-Worked<br>Logfile = $logfile<br>";   // No content for SIMULATOR VERSION
} else {
    echo "<br>PP End -> FAILED<br>";
}
    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     */
?>
<br>PP->BOTTOM OF LOCAL IPN TEST PROCESS! -> <a href="index.php/local-test/"><b>IPN Local Test</b></a><br><br>
<?php
if ($verified) {echo "$data_text<br>";} 
// END //
?>
