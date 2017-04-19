<?php
/* ----------------------------------------------
	ADD LOG
---------------------------------------------- */
function add_log($date, $user_id, $product_id, $type, $text, $note)
{
	global $database;
	$user_id		=	safety_filter($user_id);
	$product_id		=	safety_filter($product_id);
	$type			=	safety_filter($type);
	$text			=	safety_filter($text);
	$fechain		=	safety_filter($fechain);
	$note			=	safety_filter($note);
	

	
	mysql_query("INSERT INTO $database->log 
	(date, user_id, product_id, type, text, note)
	VALUES
	('$date', '$user_id', '$product_id', '$type', '$text', '$note')");
	if(mysql_affected_rows() > 0)
	{
		return true;	
	}
	else
	{
		echo mysql_error();
		return false;	
	}
}



?>