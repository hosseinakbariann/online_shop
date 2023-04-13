
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'تغییر کلمه عبور';
	}
	require_once("header2.php");
?>


<?php
$pass1 = '';
$pass2 = '';
$msg = '';
if(isset($_POST['pass']))
{
	$pass1 = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	
	if(strlen($pass1) == 0)
		$msg = 'کلمه عبور را وارد کنید';
	
	if(strlen($msg) == 0)
		if(strlen($pass2) == 0)
			$msg = 'تکرار کلمه عبور را وارد کنید';
			
	if(strlen($msg) == 0)
		if($pass1 != $pass2)
			$msg = 'کلمه عبور و تکرارش برابر نیستند';
	
	if(strlen($msg) == 0)
	{		
		$res = db_update_user_pass(get_username(),$pass1);
		$msg = 'بروز رسانی کلمه عبور انجام شد';
	}
}
?>
			<fieldset>
                <legend>تغییر کلمه عبور</legend>
                <form action="changepass.php" method="post">
					<p class="msg"><?php echo $msg; ?></p>
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
