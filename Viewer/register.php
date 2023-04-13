
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'ثبت نام';
	}
	require_once("header2.php");
?>


<?php
$username = '';
$pass1 = '';
$pass2 = '';
$name = '';
$email = '';
$telephone = '';
$address = '';
$msg = '';
if(isset($_POST['username']))
{
	$username = $_POST['username'];
	$pass1 = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$name = $_POST['fullname'];
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	$address = $_POST['address'];
	
	if(strlen($username) == 0)
		$msg = 'نام را وارد کنید';
	
	if(strlen($msg) == 0)
		if(strlen($pass1) == 0)
			$msg = 'کلمه عبور را وارد کنید';
	
	if(strlen($msg) == 0)
		if(strlen($pass2) == 0)
			$msg = 'تکرار کلمه عبور را وارد کنید';
			
	if(strlen($msg) == 0)
		if(strlen($name) == 0)
			$msg = 'نام و نام خانوادگی را وارد کنید';
			
	if(strlen($msg) == 0)
		if(strlen($email) == 0)
			$msg = 'ایمیل را وارد کنید';
			
	if(strlen($msg) == 0)
		if(!email_validating($email))
			$msg = 'ایمیل ورودی،معتبر نمی باشد';
			
	if(strlen($msg) == 0)
		if(strlen($telephone) == 0)
			$msg = 'شماره تلفن را وارد کنید';
			
	if(strlen($msg) == 0)
		if(strlen($address) == 0)
			$msg = 'آدرس را وارد کنید';
			
	if(strlen($msg) == 0)
		if($pass1 != $pass2)
			$msg = 'کلمه عبور و تکرارش برابر نیستند';
			
	if(strlen($msg) == 0)
		if(strlen($pass1) < 5)
			$msg = 'کلمه عبور باید حداقل 5 کاراکتر باشد';
	
	if(strlen($msg) == 0)
	{
		$userinfo = new User();
		$userinfo->username = $username;
		$userinfo->name = $name;
		$userinfo->address = $address;
		$userinfo->telephone = $telephone;
		$userinfo->email = $email;
		
		$res = db_get_user($username);
		if(db_count_row($res) > 0)
		{
			$msg = 'این نام کاربری،قبلا ثبت شده است';
		}
		else
		{
			db_insert_user($userinfo,$pass1);
			
			set_username($userinfo->username);
			set_isAdmin(false);
			set_fullname($userinfo->name);
			
			redirect_site('../index.php');
		}
	}
}
?>
			<fieldset>
                <legend>ثبت نام</legend>
                <form action="register.php" method="post">
					<p class="msg"><?php echo $msg; ?></p>
                    <p><label for="username">نام کاربری:</label>
                    <input name="username" id="username" value="<?php echo $username; ?>" type="text" /></p>
                    <p><label for="pass">کلمه عبور:</label>
                    <input name="pass" id="pass" value="" type="password" /></p>
                    <p><label for="pass2">تکرار کلمه عبور:</label>
                    <input name="pass2" id="pass2" value="" type="password" /></p>
                    <p><label for="fullname">نام و نام خانوادگی:</label>
                    <input name="fullname" id="fullname" value="<?php echo $name; ?>" type="text" /></p>
                    <p><label for="email">ایمیل:</label>
                    <input name="email" id="email" value="<?php echo $email; ?>" type="text" /></p>
                    <p><label for="telephone">تلفن:</label>
                    <input name="telephone" id="telephone" value="<?php echo $telephone; ?>" type="text" /></p>
                    <p><label for="address">آدرس:</label>
                    <textarea cols="37" rows="11" name="address" id="address"><?php echo $address; ?></textarea></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="ثبت" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
