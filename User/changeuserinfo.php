
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'تغییر اطلاعات شخصی';
	}
	require_once("header2.php");
	
	$res = db_get_user(get_username());
	$u = new User();
	while($row = db_fetch_row($res))
	{
		$u->fill($row);
	}
	
$pass1 = '';
$pass2 = '';
$msg2 = '';
$address = $u->address;
$telephone = $u->telephone;
$email = $u->email;
$name = $u->name;
$msg1 = '';
if(isset($_POST['pass']))
{
	$pass1 = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	
	if(strlen($pass1) == 0)
		$msg2 = 'کلمه عبور را وارد کنید';
	
	if(strlen($msg2) == 0)
		if(strlen($pass2) == 0)
			$msg2 = 'تکرار کلمه عبور را وارد کنید';
			
	if(strlen($msg2) == 0)
		if($pass1 != $pass2)
			$msg2 = 'کلمه عبور و تکرارش برابر نیستند';
			
	if(strlen($msg2) == 0)
		if(strlen($pass1) < 5)
			$msg2 = 'کلمه عبور باید حداقل 5 کاراکتر باشد';
	
	if(strlen($msg2) == 0)
	{		
		$res = db_update_user_pass(get_username(),$pass1);
		$msg2 = 'بروز رسانی کلمه عبور انجام شد';
	}
}
else if(isset($_POST['fullname']))
{
	$name = $_POST['fullname'];
	$address = $_POST['address'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	
	if(strlen($name) == 0)
		$msg1 = 'نام را وارد کنید';
	
	if(strlen($msg1) == 0)
		if(strlen($email) == 0)
			$msg1 = 'ایمیل را وارد کنید';
			
	if(strlen($msg1) == 0)
		if(!email_validating($email))
			$msg1 = 'ایمیل ورودی،معتبر نمی باشد';
	
	if(strlen($msg1) == 0)
		if(strlen($telephone) == 0)
			$msg1 = 'تلفن را وارد کنید';
	
	if(strlen($msg1) == 0)
		if(strlen($address) == 0)
			$msg1 = 'آدرس را وارد کنید';
	
	if(strlen($msg1) == 0)
	{
		$u->address = $address;
		$u->telephone = $telephone;
		$u->name = $name;
		$u->email = $email;
		$res = db_update_user($u);
		$msg1 = 'بروز رسانی اطلاعات انجام شد';
	}
}
?>
			<fieldset>
                <legend>اطلاعات اصلی</legend>
                <form action="changeuserinfo.php" method="post">
					<p class="msg"><?php echo $msg1; ?></p>
                    <p><label for="fullname">نام و نام خانوادگی:</label>
                    <input name="fullname" id="fullname" value="<?php echo $name; ?>" type="text" /></p>
                    <p><label for="email">ایمیل:</label>
                    <input name="email" id="email" value="<?php echo $email; ?>" type="text" /></p>
                    <p><label for="telephone">تلفن:</label>
                    <input name="telephone" id="telephone" value="<?php echo $telephone; ?>" type="text" /></p>
                    <p><label for="address">آدرس:</label>
                    <textarea cols="37" rows="11" name="address" id="address"><?php echo $address; ?></textarea></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit" />
					</p>
                </form>
            </fieldset>
			<fieldset>
                <legend>تغییر کلمه عبور</legend>
                <form action="changeuserinfo.php" method="post">
					<p class="msg"><?php echo $msg2; ?></p>
                    <p><label for="pass">کلمه عبور:</label>
                    <input name="pass" id="pass" value="" type="password" /></p>
                    <p><label for="pass2">تکرار کلمه عبور:</label>
                    <input name="pass2" id="pass2" value="" type="password" /></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
