<?php



/*
use file_get_contents php function to get data from posts.txt; convert to php object
(using json_decode/json_encode php functions)
- loop thru this object and create html rows with a link to update post (that will use
javascript to bring up a prompt to get the message from the user and then make an ajax
call to updatePosts.php to do the update) and then refreshes only the table (and not the
rest of the page).
- can store the post object in the session object.
*/


//get all things from posts.txt
session_start();
$username = $_SESSION["username"];

	$post_html = "";
	$post_html .= '<button onclick="makeNewPost()">Make New Post</button>';
	
	if (strcmp($username, "admin") != 0) {
		$post_html .= '<button onclick="sendMessage()">Send a Message</button>';
	}

	$post_data = json_decode(file_get_contents('posts.txt'), true);
	
	$reversed = array_reverse($post_data);

	foreach($reversed as $post) {
		$post_html .= '<div style="width:75%; background:gray;">';
		$post_html .= '<h3>' . $post['user'] . '</h3>';
		$post_html .= '<p>' . $post['content'] . '</p>'; //onclick="editPost(content, num)">
		$num = $post['num'];
		if ((strcmp($username, "admin") == 0) || (strcmp($username, $post['user']) == 0)) {
			$post_html .= '<button onclick="editExistingPost('.$num.')">Edit</button>';
			$post_html .= '<button onclick="deleteExistingPost('.$num.')">Delete</button>';
		}
		$post_html .= '</div>';
	}
	
	$post_html .= '<button onclick="logout()">Log Out</button>';

	echo $post_html;
	
?>
