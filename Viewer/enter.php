
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'ورود';
	}
	require_once("header2.php");
?>


<?php
$user = '';
$pass = '';
$msg = '';
if(isset($_POST['user']))
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	if(strlen($user) > 0)
	{
		if(strlen($pass) > 0)
		{
			if(db_can_login($user,$pass)==true)
			{
				$res = db_get_user($user);
				$userinfo = new User();
				while($row = db_fetch_row($res))
				{
					$userinfo->fill($row);
				}
				
				set_username($userinfo->username);
				set_isAdmin($userinfo->isAdmin);
				set_fullname($userinfo->name);
				
				redirect_site('../index.php');
			}
			else
				$msg = 'نام کاربری یا کلمه عبور اشتباه است';
		}
		else
			$msg = 'رمز را وارد کنید';
	}
}
?>
			<fieldset>
                <legend>ورود</legend>
                <form action="enter.php" method="post">
					<p class="msg"><?php echo $msg; ?></p>
					<p>
						<label for="user">کاربر:</label>
						<input type="text" size="15" value="<?php echo $user; ?>" name="user" />
					</p>
					<p>
						<label for="pass">رمز:&nbsp;&nbsp;</label>
						<input type="password" size="15" value="" name="pass" />
					</p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="ورود" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
