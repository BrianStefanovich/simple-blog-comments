<?php

require_once("env.php");
class Model
{
	private static $connect = $connect = new mysqli($db_hostname, $db_name, $db_password, $db_name);

	static function getComments($postName)
	{

		$commentQuery = self::$connect->query("SELECT comment_body, comment_date, user_name, post_title FROM comment INNER JOIN post ON post.post_id = comment.post_id INNER JOIN user ON user.user_id = comment.user_id WHERE post_title = '$postName' ORDER BY comment_date DESC");
		$array_result = array();
		while ($row = $commentQuery->fetch_assoc()) {
			$array_result[] = $row;
		}
		mysqli_close(self::$connect);
		return $array_result;
	}

	function setComment($postName, $authName, $authEmail, $comment)
	{

		$isUserQuery = self::$connect->query("SELECT user_id FROM user WHERE user_name = '$authName'");
		if ($isUserQuery->num_rows == 0) {
			self::$connect->query(" INSERT INTO user (user_name, user_email) VALUES ('$authName', '$authEmail')");
		}
		$isPostQuery = self::$connect->query("SELECT post_id FROM post WHERE post_title = '$postName'");
		if ($isPostQuery->num_rows == 0) {
			self::$connect->query("INSERT INTO post (post_title) VALUES ('$postName')");
		}
		$postIdQuery = self::$connect->query("SELECT post_id FROM post WHERE post_title = '$postName'");
		$authIdQuery = self::$connect->query("SELECT user_id FROM user WHERE user_name = '$authName'");
		$postId = $postIdQuery->fetch_array()["post_id"];
		$authId = $authIdQuery->fetch_array()["user_id"];
		$commentQuery = self::$connect->query("INSERT INTO comment (post_id, user_id, comment_body) VALUES ('$postId', '$authId', '$comment')");
		mysqli_close(self::$connect);
		return ($commentQuery);
	}
}
