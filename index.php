
<?php
	require_once("base.inc.php");
	
	if(strlen(get_username()) > 0)
	{
		if(get_isAdmin() == true)
		{
			header('Location: ./Admin/index.php');
		}
		else
		{
			header('Location: ./User/index.php');
		}
	}
	else
	{
		header('Location: ./Viewer/index.php');
	}
?>