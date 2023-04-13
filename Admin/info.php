
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'اطلاعات سایت';
	}
	require_once("header2.php");
?>


<?php
$title = $infosite->title;
$slogan = $infosite->slogan;
$copyright = $infosite->copyright;
if(isset($_POST['title']))
{
	$title = $_POST['title'];
	$slogan = $_POST['slogan'];
	$copyright = $_POST['copyright'];
	
	$infosite->title = $title;
	$infosite->slogan = $slogan;
	$infosite->copyright = $copyright;
	db_update_informations($infosite);
}
?>
			<fieldset>
                <legend>اطلاعات سایت</legend>
                <form action="info.php" method="post">
                    <p><label for="title">عنوان:</label>
                    <input name="title" id="title" value="<?php echo $title; ?>" type="text" /></p>
                    <p><label for="slogan">شعار:</label>
                    <input name="slogan" id="slogan" value="<?php echo $slogan; ?>" type="text" /></p>
                    <p><label for="copyright">حقوق سایت:</label>
                    <input name="copyright" id="copyright" value="<?php echo $copyright; ?>" type="text" /></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
