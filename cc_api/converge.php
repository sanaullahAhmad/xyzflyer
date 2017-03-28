<?php  
//Uncomment the endpoint desired. 
//Production URL //$url = 'https://www.myvirtualmerchant.com/VirtualMerchant/process.do'; 
//Demo URL 
error_reporting(1);
$url = 'https://api.demo.convergepay.com/VirtualMerchantDemo/process.do';  

//Configuration parameters. 
$ssl_merchant_id = '007982'; 
$ssl_user_id = 'webpage'; 
$ssl_pin = 'IWJGHM'; 
$ssl_show_form = 'false'; 
$ssl_result_format = 'HTML'; 
$ssl_test_mode = 'false'; 
$ssl_receipt_link_method = 'REDG'; 
$ssl_receipt_link_url = 'https://xyzflyers.com/cc_api/receipt.php'; 
$ssl_transaction_type = 'CCSALE'; 
$ssl_cvv2cvc2_indicator = '9';  //0,1,2,9
$ssl_card_number = '5300721113696477';
$ssl_exp_date = '1220';
$ssl_cvv2cvc2 = '111';
$ssl_amount = '0.1';
$ssl_invoice_number = '001';

//Declares base URL in the event that you are using the VM payment form. 
if($ssl_show_form == 'true') 
	{echo "<html><head><base href='" . $url . "'></base></head>"; }  
//Dynamically builds POST request based on the information being passed into the script. 
$queryString = ""; 
foreach($_REQUEST as $key => $value) 
{     
	if($queryString != "")     
	{         
		$queryString .= "&";     
	}     
	$queryString .= $key . "=" . urlencode($value); 
}  
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString .          
"&ssl_merchant_id=$ssl_merchant_id".         
"&ssl_user_id=$ssl_user_id".         
"&ssl_pin=$ssl_pin".                                 
"&ssl_transaction_type=$ssl_transaction_type".                                 
"&ssl_cvv2cvc2_indicator=$ssl_cvv2cvc2_indicator".         
"&ssl_show_form=$ssl_show_form".         
"&ssl_result_format=$ssl_result_format".         
"&ssl_test_mode=$ssl_test_mode".         
"&ssl_receipt_link_method=$ssl_receipt_link_method".                                 
"&ssl_receipt_link_url=$ssl_receipt_link_url".
"&ssl_card_number=$ssl_card_number".
"&ssl_exp_date=$ssl_exp_date".
"&ssl_cvv2cvc2=$ssl_cvv2cvc2".
"&ssl_amount=$ssl_amount".
"&ssl_invoice_number=$ssl_invoice_number"

); 

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_VERBOSE, true);  
$result = curl_exec($ch); curl_close($ch);  
?> 