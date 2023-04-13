
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'راهنما';
	}
	require_once("header2.php");
?>


<?php
$guid = $infosite->guid;
if(isset($_POST['guid']))
{
	$guid = $_POST['guid'];
	
	$infosite->guid = $guid;
	db_update_informations($infosite);
}
?>
			<fieldset>
                <legend>راهنما</legend>
                <form action="guid.php" method="post">
                    <p><textarea cols="40" rows="20" name="guid" id="guid"><?php echo $guid; ?></textarea></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
