# paypal-ipn
  NEW CLOSING NOTE: Sept 27, 2022 BELOW!
  
  Advanced instructions for installation of WpAppsForThat.Com Paypal Ipn App.
  1) Must should know and understand basics of writing applications for Wordpress.
  2) Have a child theme for your website, else you will be really upset down-the-road.
  3) Upload all php files to your theme child folder.
  4) Create Page Templates for these files:
    a. local-test.php (Page name = Local Test)
      a.1 Add Template name to the page = Local Test
    b. paypal-ipn.php (Page name = Paypal Ipn)
      b.1 Add Template name to the page = Paypal Ipn
  5) Add to your menu: Local Test.
  6) Get a paypal business account & setup a developer.paypal.com account
  7) Now read and study these pages:
    a. https://developer.paypal.com/api/nvp-soap/ipn/IPNIntro/
    b. https://developer.paypal.com/api/nvp-soap/ipn/IPNTesting/#local-development-testing
  8) IPN Listener testing from Paypal sandbox:
    a. https://developer.paypal.com/developer/ipnSimulator

  Theory of using the App:
    1) There is a local page interface (local-test.php) who's intent is the App locally.
    2) If you happened to read Paypal's sandbox notes, you will have noticed IPN can 
       be complex. Yes it can, and that is why a there is a local interface.
    3) That said, start to read every single line of paypal-ipn.php and paypalIPN.php
    4) Over time you will learn what Paypal said is true!
    5) Lastly, you can the the App my sending simulator messages to your website.

  IPN handler URL:
    1) This is not simple.
    2) What Paypal shows and what works here are different.
    3) Mine turns out to be: https://www.wpappsforthat.com/index.php/paypal-ipn/
      a. This also shows up in local-test.php:
        a.1 <form name="localtest" id="localtest" method="post" action="https://www.wpappsforthat.com/index.php/paypal-ipn/"  >
      b. How yours really works is a guessing game. This alone is important to have working code
         before going to the IPN simulator.

PHP Scripts:
  1. Each script can or already does contain lots of notes.
  2. There can be heavy use of "echo" in paypal-ipn.php and PalpalIPN.php
  3. From my experience, the echo lines will not affect the IPN Simulator.

CLOSING NOTE: Sept 26, 2022:
  I started work on IPN for Wordpress May of 2020 and finally got back to 
  it around mid August 2022. 

CLOSING NOTE: Sept 27, 2022:
  paypal-ipn.php and PalpalIPN.php both have minor changes from previous updates.
  Paypal Simulator can be very fussy.
  Local testing can be very fussy.
  Once I fully tie down these conditions, more infomation will be added.

  Expect to see updates to this doc as I continue work with IPN for Wordpress.
 