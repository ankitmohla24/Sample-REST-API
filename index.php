<?php

if ($_SERVER['REQUEST_METHOD'] == "GET"){
	if (auth_apikey($_POST['api_key']){
			http_response_code(200);
		}else {
			http_response_code(401); 				
		}

}else if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (auth_apikey($_POST['api_key']) {
		$json = file_get_contents("php://input");
		$data = json_decode($json);
		$customer_details[firstname] = $data->firstname;
		$customer_details[lastname] = $data->lastname;
		$customer_details[order_details] = $data->order_details;
		$customer_details[email] = $data->email_address;
		if(send_email($customer_details)){
			http_response_code(200);
		}else {
			http_response_code(501); 				
		}
    } else {
		http_response_code(401);
	}

} else {
    http_response_code(405);
}

function auth_apikey($key){
	
	// code to authenticate the API key sent by the user.
	
}



function send_email($customer_details){
	$template = "Dear ".$customer_details[firstname]." ".$customer_details[lastname].",<p>
	Thank you for ordering! We're working to fulfill your order ASAP. Standard shipment orders can be canceled up to 1 hour </br>
	after placement by either calling Customer Service. Overnight and Second Day orders cannot be canceled. No additional </br>
	changes can be made to your order at this time. To ensure prompt delivery, some items may ship separately.";
	
	$subject = "Order:".$customer_details[order_details];
	$body = $template;
	$header = "From: SampleRestAPI";
	return mail($customer_details[email], $subject, $body, $header);
}

?>
