<?php

/*
if the user is admin, he/she can delete any message.
- if the post information sent by the current user (except admin) is already in the posts
file
o then modify it
o else create a new entry
- use file_put_contents php function to store the
*/

//special permissions for admin

session_start();
$user = $_SESSION["username"];
$content = $_REQUEST["content"];
$num = $_REQUEST["num"];

$file = 'posts.txt';
$all_posts = json_decode(file_get_contents($file), true);

if ($num != -1) {
	if (strcmp($content, "") == 0) { //deleting post
		echo "deleting post " . $num;
		foreach($all_posts as $key => &$post) {
			$number = $post['num'];
			if ($number == $num) {
				unset($all_posts[$key]);
			}
		}
	}
	else { //editing post
		foreach($all_posts as &$post) {
			$number = $post['num'];
			if ($number == $num) {
				$post['content'] = $content;
			}
		}
	}
	
}
else {
	$new_num = end($all_posts)['num'];
	$new_num = $new_num+1;
	$new_post = array('user' => $user, 'content' => $content, 'num' => $new_num);
	array_push($all_posts, $new_post);
}

	$json = json_encode($all_posts);
		
	file_put_contents($file, $json);

	
?>
