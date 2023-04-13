<?php
$db_host="localhost";		// Host
$db_username="root";		// username
$db_password="";			// password
$db_name="eshop";	// Database

$db_handle = null;

function db_open()
{
	global $db_host;
	global $db_username;
	global $db_password;
	global $db_name;
	global $db_handle;

	$db_handle = mysql_connect($db_host, $db_username, $db_password);
	if($db_handle == false)
		die("cannot connect to '$db_username@$db_host' : " . mysql_error());
	$db = mysql_select_db($db_name);
	if($db == false)
		die($db_name . " Not exist! ");
	
	//use utf8 for support farsi
	mysql_query("SET CHARACTER SET 'utf8'");
}

function db_close()
{
	global $db_handle;

	mysql_close($db_handle);
}

function db_count_row($result)
{
	return mysql_num_rows($result);
}

function db_fetch_row($result)
{
	return mysql_fetch_array($result);
}

function db_insert_user($user,$pass)
{
	global $db_handle;

	$user->username = stripslashes($user->username);
	$user->name = stripslashes($user->name);
	$user->address = stripslashes($user->address);
	$user->telephone = stripslashes($user->telephone);
	$user->email = stripslashes($user->email);
	
	$pass2 = md5($pass);
	$sql="INSERT INTO `users` VALUES ('$user->username', '$pass2', '$user->name', '$user->address', '$user->telephone', '$user->email', '0')";
	mysql_query($sql, $db_handle);
}

function db_can_login($username,$pass)
{
	global $db_handle;

	$username = stripslashes($username);
	
	$pass2 = md5($pass);
	$sql="SELECT * FROM users WHERE username='$username' AND pass='$pass2'";
	$result=mysql_query($sql, $db_handle);
	return (mysql_num_rows($result) == 1);
}

function db_update_user_pass($username,$pass)
{
	global $db_handle;

	$username = stripslashes($username);
	
	$pass2 = md5($pass);
	$sql="UPDATE users SET pass='$pass2' WHERE username='$username'";
	mysql_query($sql, $db_handle);
}

function db_update_user($user)
{
	global $db_handle;
	
	$sql="UPDATE users SET name='$user->name',address='$user->address',telephone='$user->telephone',email='$user->email' WHERE username='$user->username'";
	mysql_query($sql, $db_handle);
}

function db_get_user($username)
{
	global $db_handle;

	$username = stripslashes($username);
	
	$sql="SELECT * FROM users WHERE username='$username'";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_users_no_admin()
{
	global $db_handle;
	
	$sql="SELECT * FROM users WHERE isAdmin=0";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_insert_category($category)
{
	global $db_handle;

	$category->title = stripslashes($category->title);
	
	$sql="INSERT INTO `category` VALUES ('0', '$category->title')";
	mysql_query($sql, $db_handle);
	
	$sql="SELECT LAST_INSERT_ID() as id;";
	$result = mysql_query($sql, $db_handle);
	while($row = db_fetch_row($result))
		$category->id = $row['id'];
}

function db_update_category($category)
{
	global $db_handle;

	$category->title = stripslashes($category->title);
	
	$sql="UPDATE `category` SET title='$category->title' WHERE id=$category->id";
	mysql_query($sql, $db_handle);
}

function db_delete_category($id)
{
	global $db_handle;
	
	$sql="DELETE FROM category WHERE id=$id";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_category($id)
{
	global $db_handle;
	
	$sql="SELECT * FROM category WHERE id=$id";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_category_of_title($title)
{
	global $db_handle;
	
	$sql="SELECT * FROM category WHERE title='$title'";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_categories()
{
	global $db_handle;
	
	$sql="SELECT * FROM category";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_informations()
{
	global $db_handle;
	
	$sql="SELECT * FROM infosite";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_update_informations($info)
{
	global $db_handle;
			
	$sql="UPDATE infosite SET data='$info->title' WHERE id=1";mysql_query($sql, $db_handle);
	$sql="UPDATE infosite SET data='$info->slogan' WHERE id=2";mysql_query($sql, $db_handle);
	$sql="UPDATE infosite SET data='$info->copyright' WHERE id=3";mysql_query($sql, $db_handle);
	$sql="UPDATE infosite SET data='$info->about_full' WHERE id=4";mysql_query($sql, $db_handle);
	$sql="UPDATE infosite SET data='$info->about_minimal' WHERE id=5";mysql_query($sql, $db_handle);
	$sql="UPDATE infosite SET data='$info->guid' WHERE id=6";mysql_query($sql, $db_handle);
	$sql="UPDATE infosite SET data='$info->faq' WHERE id=7";mysql_query($sql, $db_handle);
	
}

function db_information_of_count()
{
	global $db_handle;
	
	$sql=" select 'users' as tbl,count(*) as cnt from users";
	$sql.=" union";
	$sql.=" select 'category' as tbl,count(*) as cnt from category";
	$sql.=" union";
	$sql.=" select 'goods' as tbl,count(*) as cnt from goods";
	$sql.=" union";
	$sql.=" select 'invoice' as tbl,count(*) as cnt from invoice";
	$sql.=" union";
	$sql.=" select 'invoiceactive' as tbl,count(*) as cnt from invoice where status=1";
	
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_insert_goods($goods)
{
	global $db_handle;

	$goods->name = stripslashes($goods->name);
	$goods->description = stripslashes($goods->description);
	$goods->image = stripslashes($goods->image);
	
	$sql="INSERT INTO `goods` VALUES (0,$goods->code,$goods->idcategory,'$goods->name','$goods->description','$goods->price','$goods->image')";
	mysql_query($sql, $db_handle);
}

function db_update_goods($goods)
{
	global $db_handle;

	$goods->name = stripslashes($goods->name);
	$goods->description = stripslashes($goods->description);
	$goods->image = stripslashes($goods->image);
	
	$sql="UPDATE `goods` SET code=$goods->code,idcategory=$goods->idcategory,name='$goods->name',description='$goods->description',price='$goods->price',image='$goods->image' WHERE id=$goods->id";
	mysql_query($sql, $db_handle);
}

function db_get_goods($code)
{
	global $db_handle;
	
	$sql="SELECT * FROM goods WHERE code=$code";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_goods_of_category($idcategory)
{
	global $db_handle;
	
	$sql="SELECT * FROM goods WHERE idcategory=$idcategory";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_last_goods($count)
{
	global $db_handle;
	
	$sql="SELECT * FROM goods ORDER BY id DESC LIMIT $count";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_search_goods($subname)
{
	global $db_handle;
	
	$sql="SELECT * FROM goods WHERE name LIKE '%$subname%'";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_insert_invoice($invoice)
{
	global $db_handle;

	$invoice->username = stripslashes($invoice->username);
	$invoice->datetime = stripslashes($invoice->datetime);
	
	$sql="INSERT INTO `invoice` VALUES (0,'$invoice->username',1,'$invoice->datetime',$invoice->total)";
	mysql_query($sql, $db_handle);
	
	$sql="SELECT LAST_INSERT_ID() as id;";
	$result = mysql_query($sql, $db_handle);
	while($row = db_fetch_row($result))
		$invoice->id = $row['id'];
}

function db_get_invoice($id)
{
	global $db_handle;
	
	$sql="SELECT * FROM invoice WHERE id=$id";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_invoices_for_user($username)
{
	global $db_handle;
	
	$sql="SELECT * FROM invoice WHERE username='$username'";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_get_invoices_active()
{
	global $db_handle;
	
	$sql="SELECT * FROM invoice WHERE status=1";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_update_invoice_status($id,$status)
{
	global $db_handle;
	
	$sql="UPDATE invoice SET status=$status WHERE id=$id";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

function db_insert_invoice_item($invoiceItem)
{
	global $db_handle;
	
	$sql="INSERT INTO `invoiceitem` VALUES (0,$invoiceItem->invoiceid,$invoiceItem->goodscode,'$invoiceItem->goodsname',$invoiceItem->amount,$invoiceItem->unitprice,$invoiceItem->total)";
	mysql_query($sql, $db_handle);
	
	$sql="SELECT LAST_INSERT_ID() as id;";
	$result = mysql_query($sql, $db_handle);
	while($row = db_fetch_row($result))
		$invoiceItem->id = $row['id'];
}

function db_get_invoice_items_for_invoice($invoice_id)
{
	global $db_handle;
	
	$sql="SELECT * FROM invoiceitem WHERE invoiceid=$invoice_id";
	$result=mysql_query($sql, $db_handle);
	return $result;
}

?>