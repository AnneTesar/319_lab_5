<?php

/*
Create a simple UI with a text file for Receiver part, User(fill with current username) and
Body part, with submit button.
- When User clicks on submit, the message should be encrypted by Receiver PublicKey
and store information (contain Sender username, Receiver and body of message) in
messages.txt file. Each item should contain the information as in this example User:
Alice; Receiver: BOB; Body: dshgkfjsghfjksghjkf
- Make sure that you store the encrypted message in messages.txt file
*/

$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');

session_start();
$username = $_SESSION["username"];
$reciever = $_REQUEST["reciever"];
$body = $_REQUEST["body"];

$public_key = -1;

//get reciever's public key
	$all_users = $_SESSION["all_users"];
	foreach ($all_users as $user) {
		if (strcmp($user["username"], $reciever) == 0) {
			$public_key = $user["public_key"];
		}
	}
	//find matchign username
	//get that public key

if ($public_key == -1) {
	echo "FAILED SOMEWHERE";
}
else {
	echo "GOT KEY WHAT UP \n";
	echo $public_key;
}

//encrypt message
$encrypted_body = rsa_encrypt($body, $public_key);

echo "\Encrypted String: " . $encrypted_body;

//put in messages.txt
$file = "messages.txt";
$message_data = json_decode(file_get_contents($file), true);

$new_message = array('sender' => $username, 'reciever' => $reciever, 'body' => base64_encode($encrypted_body));
echo $new_message['body'];
//$new_message = array_map('utf8_encode', $new_message);
//$new_message = base64_encode($new_message);
array_push($message_data, $new_message);

$json = json_encode($message_data);
		
file_put_contents($file, $json);







//Function for encrypting with RSA
function rsa_encrypt($string, $public_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($public_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the encrypted version
    return $cipher->encrypt($string);
}
	
?>
