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
//decrypt messages in message.txt
//display messages

	
?>
