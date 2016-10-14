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

//ui

session_start();
$username = $_SESSION["username"];
$reciever = $_REQUEST["reciever"];
$body = $_REQUEST["body"];

//get reciever's public key
//encrypt message
//put in messages.txt


	
?>
