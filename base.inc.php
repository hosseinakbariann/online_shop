
<?php
if(!isset($_SESSION))
	session_start();

date_default_timezone_set("Asia/Tehran");
define('ENDLINE' , "\r\n");

require_once("date.php");

function get_username()
{
	if(isset($_SESSION['username']))
		return $_SESSION['username'];
	return '';
}

function set_username($username)
{
	$_SESSION['username'] = $username;
}

function get_invoice_signature()
{
	if(isset($_SESSION['invoice_signature']))
		return $_SESSION['invoice_signature'];
	return '';
}

function set_invoice_signature($signature)
{
	$_SESSION['invoice_signature'] = $signature;
}

function get_isAdmin()
{
	if(isset($_SESSION['isadmin']))
		return (strlen($_SESSION['isadmin']) > 0);
	return false;
}

function set_isAdmin($isAdmin)
{
	if($isAdmin == true)
		$_SESSION['isadmin'] = 'true';
	else
		$_SESSION['isadmin'] = '';
}

function get_fullname()
{
	if(isset($_SESSION['fullname']))
		return $_SESSION['fullname'];
	return '';
}

function set_fullname($fullname)
{
	$_SESSION['fullname'] = $fullname;
}

function date_now()
{
	return jgmdate("Y/m/d H:i");
}

function redirect_site($url)
{
	header('Location: '.$url);
	exit();
}

function email_validating($email)
{
	return preg_match("/[_\.0-9a-z-]+@[0-9a-z][0-9a-z-]+\.+[a-z]{2,3}/",$email);
}

require_once("classes.php");
require_once("db.php");
?>