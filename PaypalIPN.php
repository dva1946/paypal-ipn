<?php class PaypalIPN
/**
**************************
* DOC - CONSTANT SECTION *
**************************
* 09-12-12 MAJOR CODE CHANGES FOR CONSTANT DEFINING
*   Need constants  1)  public function set_name: 
*                       Defined in the running code, 
*                       so must use "define" for constants.
*                   2)  public function get_name:
*                       Get a 0 or 1 via if statements
*                       if (..) ){define two CONSTANTS}
*                       else {define two CONSTANTS the opposite way}
*                   3)  Now in main block of code call the constant a new way:
*                       if ($res == self::VALID) {
*                       replaced with:    
*                       if ($res == VALID) {
*                           by definition of "define" the CONSTANT
*                           it is visible EVERYWHERE. 
*                   4)  Therefore, 1) Can define from parent script = paypal_ipn.php
*                       variable: $test_local = 0;   // 1= Local, 0 = Paypal Simulator
*                   5)  Thus put these functions inside this CLASS and 
*                       just Below: const SANDBOX_VERIFY_URI =
*                   6)  Now LOCAL and PP IPN SIMULATOR can be managed with one
*                       variable on line approx line 65 of paypal-ipn.php script!
*                   THE END OF DOC ON THIS TOPIC
*                    
********************
* DOC - CHANGE LOG *
********************
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
* 10-17-22  @8:44pm: Got most everything done (except shop_txn_id for IPN, but it is not real anyway!!)
*           On WS I can pass the real value, which is already done.
* 10-17-22 	paypalIPN-bu-Functinal-StillMinorTweaks-101722-3pm.php
* 10-17-22  paypalIPN-bu-IpnDbNotSaving-10162288pm.php
*           Backups from last night where IPN Simulator records
*           were not saving. Best I can tell, it has to do with minuplating data
*           foreach loop to accumulate data for saving use //
*               foreach ($_POST as $key => $value) {
*           I will attempt to find the problem and then maybe re-write saved raw data.
* 10-15-22 - Modified code for LOCAL & SIMULATOR testing (see notes under paypal-ipn.php for details)
* 10-13-22 - LOCAL vs SIMULATOR controlled from local-test.php by this: <input type="hidden" name="run_local_test" value="1">
*            In PaypalIPN.php 
* 10-11-22 - Moved to WS - DEV
* 10-09-22 - Trying to solve data issue from Simulator
* 10-07-22 - Adding DB code to Apps
* 10-07-22 - Backed up code = PaypalIPN-GoodCode-100722-548pm.php
* 10-04-22 - Integrated documentation notations for accompanying doc in PDF.
* 09-27-22 - echo print lines have been left in for local debugging & do not affect PP Simulator.
* 09-27-22 - DVA re-testing locally, tested Paypal Simulator. Both Good!
* 09-26-22 - DVA re-testing locally
* 09-09-22 @8:31pm - DVA This is SIMULATOR USE - SANDBOX
* 09-09-22 5pm DVA -Starting IPN Simulator Testing
* Simulator URL Used = https://www.wpappsforthat.com/index.php/paypal-ipn/
*   PP Said: IPN was sent and the handshake was verified.
*   DVA commenting out all ECHO STATEMENTS
* 09-09-22 DVA - Now writing to a text file. Still must add DB + test various values for type of transaction
* 09-02-22 DVA - Testing down to line 107 and then seems to call ipn (other script)
* 08-28-22 DVA - this code from here on github, it seems like latest
* https://github.com/paypal/ipn-code-samples/blob/master/php/PaypalIPN.php
* Maybe) Latest commit cb738c4 on Mar 16, 2018
* 09-03-22 -> https://stackoverflow.com/questions/14015144/sample-php-code-to-integrate-paypal-ipn
*/
// ****************************** 
// * DOC - BEGIN ALL CLASS CODE *
// ******************************
{
    /** @var bool Indicates if the sandbox endpoint is used. */
    //private $use_sandbox = false;
    private $use_sandbox = true;
    /** @var bool Indicates if the local certificates are used. */
    private $use_local_certs = true;

    /** Production Postback URL */
    //const VERIFY_URI = 'https://ipnpb.paypal.com/cgi-bin/webscr';
    /** Sandbox Postback URL */
    const SANDBOX_VERIFY_URI = 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr';

    // GET VALUE FOR SIMULATOR USE - LOCAL or IPN SIMULATOR //
        
        // Properties
        public $test_location;
        // Methods - got passed setting from var = $test_local = 0 | 1
        public function set_name($test_location) {
            $this->test_location = $test_location;
        }
        
        // Get value from above function to determine LOCAL or IPN SIMULATOR test condition
// **************
// * DOC - ECHO *
// **************

// **************************
// * DOC - DEFINE CONSTANTS *
// **************************

        function get_name ($test_location) {
            echo "<br>IPN-1a1-> Inside get_name function: $this->test_location<br>";
            // LOCAL - DEFINE CONSTANTS //
            if ($this->test_location >=1) {     //10-18-22 Modifed from == to >= due to using 1 or 2 for versions of local testing
                define("VALID", "INVALID");
                define("INVALID", "VERIFIED");
                $sim_verified = "";
                $sim_invalid = "";
                $local_verified = "INVALID";
                $local_invalid = "VERIFIED";
                echo "IPN-1a2-> Invalid = ";
                echo INVALID;  
                echo "<br>IPN-1a3-> <b> <FONT COLOR='green'>RUN LOCAL TEST</font></b><br>";
            } 
            else {
                // PP SIMULATOR - DEFINE CONSTANTS //
                echo "<br>IPN-1b1->USE SIMULATOR IPN TEST<br>"; 
                define("VALID", "VERIFIED");
                define("INVALID", "INVALID");
                $local_verified = "";
                $local_invalid = "";
                $sim_verified = "VERIFIED";
                $sim_invalid = "INVALID";
                echo "IPN-1b2-> Valid = ";
                echo VALID;  
                echo "<br>IPN-1b3-> <FONT COLOR='red'>USE SIMULATOR TEST</font><br>";
            }
            return array ($local_verified, $local_invalid, $sim_verified, $sim_invalid);
        }    
    // *************************************************** //

// *******************************
// * DOC - GENERAL HOUSEKEEPING  *
// *******************************

    /**
     * Sets the IPN verification to sandbox mode (for use when testing,
     * should not be enabled in production).
     * @return void
     */
    public function useSandbox() {        
        $this->use_sandbox = true;
    }

    /**
     * Sets curl to use php curl's built in certs (may be required in some
     * environments).
     * @return void
     */
    public function usePHPCerts() {
        // 09-04-22 Using certs from wpappsforthat.com
        $this->use_local_certs = false;
        //$this->use_local_certs = true;  
        // if req'd using = "/home1/davelkwd/wpappsforthat.com/wp-includes/certificates/ca-bundle.crt"
    }

    /**
     * Determine endpoint to post the verification data to.
     *
     * @return string
     */
    public function getPaypalUri() {
        if ($this->use_sandbox) {
            return self::SANDBOX_VERIFY_URI;
        } else {
            return self::VERIFY_URI;
        }
    }

    /**
     * Verification Function
     * Sends the incoming post data back to PayPal using the cURL library.
     *
     * @return bool
     * @throws Exception
     */

// **************************************
// * DOC - FUNCTION VERIFYIPN & SAVING  *
// **************************************

    public function verifyIPN() {        
        if ( ! count($_POST)) {
            throw new Exception("Missing POST Data");
        }
        echo "<br>IPN-1c1-> Valid = ";
        echo VALID;
        echo  "<br>";
        echo "IPN-1c2-> Invalid = ";
        echo INVALID;
        echo  "<br>";  
        
        $raw_post_data = file_get_contents('php://input');  // 09-02-22 Seems to want datae. Time to pass real data per example from PP
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2) {
                // Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
                if ($keyval[0] === 'payment_date') {
                    if (substr_count($keyval[1], '+') === 1) {
                        $keyval[1] = str_replace('+', '%2B', $keyval[1]);
                    }
                }
                $myPost[$keyval[0]] = urldecode($keyval[1]);
            }
        }
        // Local test, not processing code //
        if (! $myPost) {
            echo "IPN-1c3-> array myPost empty<br>";     
        }              
        // ******************************* //

        // Build the body of the verification post request, adding the _notify-validate command.
        $req = 'cmd=_notify-validate';
        $logfile = "";
        //$res = null;

        // 10-17-22: Initially Received Raw daata
        foreach ($myPost as $key => $value) {
            $req .= "&$key=$value";
        }

        // ****************************  //
        
        // 09-09-22 DVA REVIEW THIS PP CODE FOR CURL lines https://developer.paypal.com/api/nvp-soap/ipn/ht-ipn/
        //          May have to page down a way.
        //          Also review all that code (even though old) it may have some interesting info to make better code. 
        // Post the data back to PayPal, using curl. Throw exceptions if errors occur.
        $ch = curl_init($this->getPaypalUri());
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                
        if ($this->use_local_certs = "true") {
        echo "IPN-1d1-> Use local cert = $this->use_local_certs<br>";
        echo "IPN-1d2-> In local Cert if clause, and not sure why here!<br>";
            curl_setopt($ch, CURLOPT_CAINFO, "/home1/davelkwd/wpappsforthat.com/wp-includes/certificates/ca-bundle.crt");
        }
        
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: PHP-IPN-Verification-Script',
            'Connection: Close',
        ));
       
        $res = curl_exec($ch);

        echo "IPN-1e-> res = $res: INVALID locally means OK.<br>";
        if ( ! ($res)) {
            $errno = curl_errno($ch);
            $errstr = curl_error($ch);
            curl_close($ch);
            echo "IPN-1e1-> Curl error = $errstr<br>";
            throw new Exception("cURL error: [$errno] $errstr");
        }
        echo "IPN-1e2-> Following further.<br>";

        $info = curl_getinfo($ch);
        $http_code = $info['http_code'];
        echo "IPN-1e3-> http_code = $http_code<br>";
        
        if ($http_code != 200) {
            throw new Exception("PayPal responded with http code $http_code");
        }
        
        curl_close($ch);        

        // ***************************************** //
        // 10-13-22 SHOULD BE END OF IPN HANDSHAKING //
        // ***************************************** //

        $run_local_test = 0;
        $payment_status = "";
        $payment_type   = "";
        $ws_user_id     = "";
        $test_ipn       = "";

        // ********************************* //
        // MAIN BODY OF CODE FOR SAVING DATA //
        // ********************************* //

        if ($res) {
            $i          = 0;
            $data_text  = "";
            $shop_txn_id= "";
            $txn_type   = "";
            $timestamp  = "";
            $mc_gross   = 0;
            $mc_fee     = 0;
            $mc_net     = 0;
            $pay_net    = 0;
     
            echo "IPN-1f1-> In a SAVE DATA.<br>";

            // Loop to accumulate data for saving use //

            foreach ($_POST as $key => $value) {
                $i++;

                // ** ONLY PROCESSING LOCAL TEST DATA ** //
                if (($_POST['run_local_test'] == 1) OR ($_POST['run_local_test'] == 2)) {
                    // 10-18-22 Only added this in case a need to use for controls.
                    if ($i == 1) {
                        $run_local_test = $_POST['run_local_test'];
                        echo "IPN-> run_local_test = $run_local_test<br>"; 
                    }
                    if ($key == "shop_txn_id") {
                        $shop_txn_id = $value;
                        echo "IPN-1f2-> shop_txn_id = $shop_txn_id<br>";
                    }
                    elseif ($key == "payment_status") {
                        list($b, $c) = explode("|", $value);
                        // EX of values = Completed|instant
                        $payment_status = $b;   //Many choices
                        $payment_type = $c;     //instant (for CC) or echeck (for echeck)
                        echo "IPN-1g-> Payment Status = $b<br>"; 
                        echo "IPN-1g-> Payment Type = $c<br>"; 
                        // Special case handling:
                        //  reset $value to $b + payment_type = $c
                        //  add $key =payment_type $key & $value
                        $data_text .= "payment_status" . "=" . $b . "\r\n";
                        $data_text .= "payment_type" . "=" . $c . "\r\n";
                    } 
                    elseif ($key == "user_id") {
                        $ws_user_id = $value;
                        $data_text .= "user_id" . "=" . $ws_user_id . "\r\n";
                        echo "IPN-1g-> user_id = $ws_user_id<br>";
                    } 
                    elseif ($key == "timestamp") {
                        $timestamp	= $value;
                        $data_text .= "$key" . "=" . $value . "\r\n";
                        echo "IPN-1g-> timestamp = $value<br>";
                    }
                    elseif ($key == "mc_gross") {
                        $mc_gross	= $value;
                        $data_text .= "$key" . "=" . $value . "\r\n";
                        echo "IPN-1g-> mc_gross = $mc_gross<br>";
                    }       // ** ONLY PROCESSING LOCAL TEST DATA ** //
                    else {   // All IPN data added here per foreach
                        $data_text .= $key . "=" . $value . "\r\n";
                        //echo "IPN-1g-> $key = $value<br>";
                    }    
                }       // ** END OF ONLY PROCESSING LOCAL TEST DATA ** //               
                // 10-18-22 working on missing stuff for DB IPN routine
                else {  // ** NOW IN IPN DATA HANDLING ** //
                //elseif (($_POST['run_local_test'] != 1) OR ($_POST['run_local_test'] != 2)) {                    // Can use individual if statements, but can not do math (my guess)                    
                    if ($key     == "payment_status")   {$payment_status = $value; }
                    elseif ($key == "payment_type")     {$payment_type = $value; }
                    elseif ($key == "mc_gross")         {$mc_gross = $value; }
                    elseif ($key == "mc_fee")           {$mc_fee = $value; }
                    // No $value changed for said $key, therefore write all of them here 
                    $data_text .= $key . "=" . $value . "\r\n";
                }
            }

            // AFTER FOREACH -> compute + add to exported data and use below in DB save
            //if ($_POST['run_local_test']) {
                //if (($_POST['run_local_test'] == 1) OR ($_POST['run_local_test'] == 2)) {
            if ($mc_net == 0) {
                $payment_fee    = $mc_gross * 0.029;      // cc% charge
                $payment_fee    = $payment_fee + 0.30;                  // flat fee charge
                $mc_fee 	    = (round($payment_fee, 2));             // round it per standards            
                $pay_net        = $mc_gross - $mc_fee;
                $mc_net         = $pay_net;
                //$data_text     .= "mc_fee" . "=" . $mc_fee . "\r\n";        // need for local data
                $data_text     .= "mc_net" . "=" . $mc_net . "\r\n";
                echo "IPN-1g-> pay_net = $pay_net<br>";
                echo "IPN-1g-> mc_net = $mc_net<br>";
            }
            if (!$ws_user_id) {
            //elseif ((empty($_POST['run_local_test'])) && (empty($_POST['user_id']))) {
                $ws_user_id = (rand(5000,9000));
                $data_text     .= "user_id" . "=" . $ws_user_id . "\r\n";
                echo "IPN-1g-> ws_user_id = $ws_user_id<br>";
            }
            // 10-18-22 Test code to see if a variable is populated or even correctly
            $stl = strlen($timestamp);
            if ($stl < 15) {
                echo "IPN-1g IPN-> Timestamp String Length = $stl<br>";
                echo "timestamp = $timestamp<br>";
            }  
               //else {
            if (!$timestamp) {
                date_default_timezone_set("America/Chicago");
                list($year, $month, $day, $hour, $minute, $second, $timezone) = explode(":", date("Y:m:d:H:i:s:T"));
                $timestamp = date_i18n('Ymd-His'); // Grab Time
                //$timestamp = $year. $month. $day-$hour $minute . $second; // Grab Time
                $data_text     .= "timestamp" . "=" . $timestamp . "\r\n";
                echo "IPN-1g-> timestamp = $timestamp<br>";
            }

            // 10-17-22 CAN NOT GET IT, SO STOP at 9pm: Temporary populate $shop_txn_id //
            if (!$shop_txn_id) {
            //if (empty($_POST['shop_txn_id'])) {
                $shop_txn_id 	= $ws_user_id . ":" . "$timestamp"; 
                //$user_id     .= "timestamp" . "=" . $timestamp . "\r\n";
                $data_text     .= "shop_txn_id" . "=" . $shop_txn_id . "\r\n";
            }
            $stl = strlen($timestamp);
            if ($stl < 15) {
                echo "IPN-1g General-> Password String Length = $stl<br>";
            }  

            $write_to_db    = 1;
            $save_log_file  = 1;  // Set this to true to save a log file:
            $wp_content_dir = WP_CONTENT_DIR;
            $log_file_dir   = $wp_content_dir . "/uploads/paypal-ipn-logs/";	// 08-22-22 took (partially) from product.php log directory ($a)
            // 10-16-22: IPN -> payment_type = echeck|instant
            //           LOCAL -> two parts 
            // 0=10-09-22 change 
            $logfile 	    = $timestamp . ":" . "id-$shop_txn_id" . ":". "type-$payment_type" . ":" . "status-$payment_status" . ".txt";
            $filename 	    = "$log_file_dir" . "$logfile";

            // WRITE TO TEXT FILE (temporary process) // //
            
            if (($save_log_file == 1) && ($data_text)) {                
                $fh = fopen($filename, 'w');
                fwrite($fh, $data_text);    //write data
                fclose($fh);                //close file
            } 

// *************************
// * DOC - MySQL & Schema  *
// *************************

// ADD DATABASE SAVING HERE! //

            // 10-07-22 Adding DB code //
            
            global $wpdb;       // For DB connection, etc
            global $tbl_name;   // For DB connection, etc
            $tbl_name 	= $wpdb->prefix.'paypal_transactions';
            $errors     = new WP_Error();   

            if ($write_to_db) {
                $wpdb->query( $wpdb->prepare( 
                    "INSERT INTO $tbl_name
                    (
                    item_number, 			
                    item_name,
                    user_id,
                    timestamp,
                    payer_email,

                    payer_id,
                    payer_status,
                    first_name,
                    last_name,
                    receiver_email,

                    payment_type,
                    payment_status,
                    payment_date,                    
                    mc_gross,
                    mc_fee,

                    mc_net,
                    mc_currency,
                    txn_id,
                    transaction_subject,
                    currency_code,

                    verify_sign,
                    shop_txn_id,
                    test_ipn)				
                    VALUES (%s,   %s, %d,  %s,  %s,  
                            %s,   %s, %s,  %s,   %s,
                            %s,   %s, %s,  %.2f, %.2f,
                            %.2f, %s, %d,  %s,   %s, 
                            %s,   %s, %s) 
                    ",
                    $_POST['item_number'], 
                    $_POST['item_name'], 
                    $ws_user_id,
                    $timestamp,
                    $_POST['payer_email'],

                    $_POST['payer_id'],
                    $_POST['payer_status'],
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['receiver_email'],

                    $payment_type,
                    $payment_status,
                    $_POST['payment_date'],                  
                    $_POST['mc_gross'],
                    $mc_fee,

                    $mc_net,
                    $_POST['mc_currency'],
                    $_POST['txn_id'],
                    $_POST['transaction_subject'],
                    $_POST['currency_code'],

                    $_POST['verify_sign'], 
                    $shop_txn_id,
                    $test_ipn
                ) );			
                if (!$wpdb) {                     
                    echo "IPN-1ga-> ERROR WRITING TO DB, NO RECORD SAVED<br>";
                    $errors = true;
                } else {
                    echo "IPN-1gb-> SUCCESSFULLY WROTE TO DB!<br>";
                    $errors = false;
                }
                $wpdb->flush();                      
            }

            // ** END WRITE TO DB ** //

            echo "IPN-1ha-> return array for logfile + data for screen output.<br>"; 

            return array (1,$logfile,$data_text);   //return
        } 
        else {
            echo "IPN-1hb-> FAILED! Return w/o processing data res=$res.<br>";    // No content for SIMULATOR VERSION            
            return false;
        }
    }       // End of public function verifyIPN() //
}           // END ALL CLASS CODE //

// **************************** 
// * DOC - END ALL CLASS CODE *
// ************************* //
