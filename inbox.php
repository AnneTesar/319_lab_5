<?php

/*
use file_get_contents to get json data from messages.txt. Next, convert json to php
object (json_decode/json_encode)
- loop thru object: If the To part is related to the current username create html rows with
after decrypting the body of the message.
*/

$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');

session_start();
$username = $_SESSION["username"];

//take user's private key
$private_key = $_SESSION["private_key"];

//decrypt messages in message.txt
$file = "messages.txt";
$message_data = json_decode(file_get_contents($file), true);

$messages_html = "<h3>Private Messages: </h3>";
foreach ($message_data as $message) {
	if (strcmp($message["reciever"], $username) == 0) {
		//echo "Message Body: " . $message["body"];
		$body = base64_decode($message["body"]);
		$decipheredtext = "test"; //rsa_decrypt($body, $private_key); TODO this decryption causes errors.
		//echo "\nDeciphered: " . $decipheredtext;
		$messages_html .= '<div style="width:75%; background:blue;">';
		$messages_html .= '<h3>Message From ' . $message['sender'] . '</h3>';
		$messages_html .= '<p>' . $decipheredtext . '</p>';
	}
}

echo $messages_html;

function rsa_decrypt($string, $private_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($private_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the decrypted version
    return $cipher->decrypt($string);
}
	
?>
