local-test-output.md

PP->TOP OF LOCAL IPN TEST PROCESS! -> IPN Local Test

PP-1a1->Before New PaypalIPN Function defined
PP-1a2->After New PaypalIPN Function defined
PP-2a1->Before set_name Function call
PP-2a2->After set_name Function call

IPN-1a1-> Inside get_name function: 1
IPN-1a2-> Invalid = VERIFIED
IPN-1a3-> RUN LOCAL TEST

PP-3a1->Local Valid = INVALID
PP-3b1->Local InValid = VERIFIED
PP-3c1->Sim Valid = 
PP-3d1->Sim InValid = 

IPN-1c1-> Valid = INVALID
IPN-1c2-> Invalid = VERIFIED
IPN-1d1-> Use local cert = true
IPN-1d2-> In local Cert if clause, and not sure why here!
IPN-1e-> res = INVALID

PP-Worked
Logfile = 20220927-202752:id-61E67681CH3238416:txntyp-express_checkout.txt

PP->BOTTOM OF LOCAL IPN TEST PROCESS! -> IPN Local Test

item_one=GeorgeBeGood amount=1.00 timestamp=20220927-202749CDT business=dva1946@yahoo.com cmd=_xclick currency_code=USD user_id=199628 mc_gross=19.95 protection_eligibility=Eligible address_status=confirmed payer_id=LPLWNMTBWMFAY tax=0.00 address_street=1+Main+St payment_date=20%3A12%3A59+Jan+13%2C+2009+PST payment_status=Completed charset=windows-1252 address_zip=95131 first_name=Test mc_fee=0.88 address_country_code=US address_name=Test+User notify_version=2.6 custom=199628 payer_status=verified address_country=United+States address_city=San+Jose quantity=1 verify_sign=AtkOfCXbDm2hu0ZELryHFjY-Vb7PAUvS6nMXgysbElEn9v-1XcmSoGtf payer_email=gpmac_1231902590_per%40paypal.com txn_id=61E67681CH3238416 payment_type=instant last_name=User address_state=CA receiver_email=gpmac_1231902686_biz%40paypal.com payment_fee=0.88 receiver_id=S8XGHLYDW9T3S txn_type=express_checkout item_name=mc_currency=USD item_number= residence_country=US test_ipn=1 handling_amount=0.00 transaction_subject= payment_gross=19.95 shipping=0.00 submit=Local Test 