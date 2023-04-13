
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'درباره ما';
	}
	require_once("header2.php");
?>


<?php
$about_min = $infosite->about_minimal;
$about_full = $infosite->about_full;
if(isset($_POST['aboutmini']))
{
	$about_min = $_POST['aboutmini'];
	$about_full = $_POST['aboutfull'];
	
	$infosite->about_minimal = $about_min;
	$infosite->about_full = $about_full;
	db_update_informations($infosite);
}
?>
			<fieldset>
                <legend>درباره ما</legend>
                <form action="about.php" method="post">
                    <p><label for="aboutmini">توضیح کوتاه در همه صفحات:</label>
                    <textarea cols="40" rows="5" name="aboutmini" id="aboutmini"><?php echo $about_min; ?></textarea></p>
                    <p><label for="aboutfull">توضیح بلند در صفحه درباره ما:</label>
                    <textarea cols="40" rows="40" name="aboutfull" id="aboutfull"><?php echo $about_full; ?></textarea></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
