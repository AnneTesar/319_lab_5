<?php

/*
use file_get_contents to get json data from messages.txt. Next, convert json to php
object (json_decode/json_encode)
- loop thru object: If the To part is related to the current username create html rows with
after decrypting the body of the message.
*/

//ui

session_start();
$username = $_SESSION["username"];

//take user's private key
$private_key = $_SESSION["private_key"];

//decrypt messages in message.txt
$file = "messages.txt";
$message_data = json_decode(file_get_contents($file), true);

$messages_html = "";
foreach ($message_data as $message) {
	if (strcmp($message["reciever"], $username) == 0) {
		//decode message
		//display message
		echo $message["body"];
	}
}

echo $messages_html;
	
?>
