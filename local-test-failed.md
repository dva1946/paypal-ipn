local-test-failed.md

PP->TOP OF LOCAL IPN TEST PROCESS! -> IPN Local Test

PP-1a1->Before New PaypalIPN Function defined
PP-1a2->After New PaypalIPN Function defined
PP-2a1->Before set_name Function call
PP-2a2->After set_name Function call

IPN-1a1-> Inside get_name function: 0

IPN-1b1->USE SIMULATOR IPN TEST
IPN-1b2-> Valid = VERIFIED
IPN-1b3-> USE SIMULATOR TEST

PP-3a1->Local Valid = 
PP-3b1->Local InValid = 
PP-3c1->Sim Valid = VERIFIED
PP-3d1->Sim InValid = INVALID

IPN-1c1-> Valid = VERIFIED
IPN-1c2-> Invalid = INVALID
IPN-1d1-> Use local cert = true
IPN-1d2-> In local Cert if clause, and not sure why here!
IPN-1e-> res = INVALID 

PP End -> FAILED

PP->BOTTOM OF LOCAL IPN TEST PROCESS! -> IPN Local Test
