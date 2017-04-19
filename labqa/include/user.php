<?php
if(@$_SESSION["management_login"] == true)
{
	$x_query_user = mysql_query("SELECT * FROM $database->users WHERE id='".$_SESSION['user_id']."'");
	while($x_list_user = mysql_fetch_assoc($x_query_user))
	{
		$user['id'] 		= $x_list_user['id'];
		$user['status']		= $x_list_user['status'];
		$user['user_name']	= $x_list_user['user_name'];
		$user['password'] 	= $x_list_user['password'];
		$user['level'] 		= $x_list_user['level'];
	}
	
	$user_id = $user['id'];
	
	function get_the_current_user($value)
	{
		global $user;
		return $user[$value];
	}
	
	function the_current_user($value)
	{
		echo get_the_current_user($value);
	}
}
else
{
	echo '<script>window.location = "'.get_url('').'/login.php"; </script>';
	exit;
}
?>
<?php
/* ----------------------------------------------
	ADD USER
---------------------------------------------- */
function add_user($user_name, $password, $password_again, $level)
{
	global $database;
	$continue = true;
	$user_name		=	safety_filter($user_name);
	$password		=	safety_filter($password);
	$password_again	=	safety_filter($password_again);
	$level			=	safety_filter($level);
	
	if(strlen($user_name) < 3) 	{	$continue = false;	alert_box('alert', get_lang('User Name').' 3 '.get_lang('Minimum Characters'));	}
	if(strlen($user_name) > 20) {	$continue = false;	alert_box('alert', get_lang('User Name').' 20 '.get_lang('Maximum Characters'));	}
	if(preg_match("/[^A-Za-z1-9]/i",$user_name))  {	$continue = false;	alert_box('alert', get_lang('User name incorrect'));	}
	if(strlen($password) < 3) 	{	$continue = false;	alert_box('alert', get_lang('Password').' 3 '.get_lang('Minimum Characters'));	}
	if(strlen($password) > 20) 	{	$continue = false;	alert_box('alert', get_lang('Password').' 20 '.get_lang('Maximum Characters'));	}			
	if($password != $password_again)	{ $continue = false;	alert_box('alert', get_lang('Passwords do not match'));	}
	if(mysql_num_rows(mysql_query("SELECT * FROM $database->users WHERE user_name='$user_name'")) > 0)
		{	$continue = false;	alert_box('alert', get_lang('User name database found'));	}
	
	$password	=	md5($password);
	
	if($continue == true)
	{
		mysql_query("INSERT INTO $database->users 
		(status, user_name, password, level)
		VALUES
		('publish', '$user_name', '$password', '$level')
		");
		if(mysql_affected_rows() > 0)
		{
			return mysql_insert_id();	
		}
		else
		{
			return false;	
		}
	}
}

/* ----------------------------------------------
	UPDATE USER
---------------------------------------------- */
function update_user($user_id, $status, $user_name, $password, $level)
{
	global $database;
	$continue = true;
	$user_name		=	safety_filter($user_name);
	$password		=	safety_filter($password);
	$level			=	safety_filter($level);
	
	if(strlen($user_name) < 3) 		{	$continue = false;	alert_box('alert', get_lang('User Name').' 3 '.get_lang('Minimum Characters'));	}
	if(strlen($user_name) > 20) {	$continue = false;	alert_box('alert', get_lang('User Name').' 20 '.get_lang('Maximum Characters'));	}
	if(preg_match("/[^A-Za-z1-9]/i",$user_name))  			{	$continue = false;	alert_box('alert', get_lang('User name incorrect'));	}
	if(strlen($password) > 20) 		{	$continue = false;	alert_box('alert', get_lang('Password').' 20 '.get_lang('Maximum Characters'));	}			
	
	if($password == '')
	{
		$password	=	get_user(get_the_user('id'), 'password');
	}
	else
	{
		$password	=	md5($password);
	}
	
	if($continue == true)
	{
		mysql_query("UPDATE $database->users SET
		status='$status',
		user_name='$user_name',
		password='$password',
		level='$level'
		WHERE
		id='$user_id'
		");
		if(mysql_affected_rows() > 0)
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
}

/* ----------------------------------------------
	DELETE USER
---------------------------------------------- */
function delete_user($user_id)
{
	global $database;
	$user_id	=	safety_filter($user_id);
	
	mysql_query("UPDATE $database->users SET status='delete' WHERE id='$user_id'");	
	if(mysql_affected_rows() > 0)
	{
		return true;
	}
}


/* ----------------------------------------------
	GET USER
---------------------------------------------- */
if(isset($_GET['user_id']) or isset($_POST['user_id']))
{
	if(isset($_GET['user_id']))			{ $user_id = safety_filter($_GET['user_id']);	}
	else if(isset($_POST['user_id']))	{ $user_id = safety_filter($_POST['user_id']);	}
	
	$query_users = mysql_query("SELECT * FROM $database->users WHERE id='$user_id'");
	while($list_users = mysql_fetch_assoc($query_users))
	{
		$users['id']				=	$list_users['id'];
		$users['status']			=	$list_users['status'];
		$users['user_name']			=	$list_users['user_name'];
		$users['password']			=	$list_users['password'];
		$users['level']				=	$list_users['level'];
	}
	
	function get_the_user($value)
	{
		global $users;
		return	$users[$value];
	}
	
	function the_user($value)
	{
		echo get_the_user($value);
	}
}


/* ----------------------------------------------
	USER
---------------------------------------------- */
function get_user($user_id, $value)
{	
	global $database;
	$query_users = mysql_query("SELECT * FROM $database->users WHERE id='$user_id'");
	while($list_users = mysql_fetch_assoc($query_users))
	{
		$users['id']				=	$list_users['id'];
		$users['status']			=	$list_users['status'];
		$users['user_name']			=	$list_users['user_name'];
		$users['password']			=	$list_users['password'];
		$users['level']				=	$list_users['level'];
	}
	
	return $users[$value];
}

function user($user_id, $value)
{
	echo get_user($user_id, $value);
}
?>