
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'پرسش و پاسخ های متداول';
	}
	require_once("header2.php");
?>


<?php
$faq = $infosite->faq;
if(isset($_POST['faq']))
{
	$faq = $_POST['faq'];
	
	$infosite->faq = $faq;
	db_update_informations($infosite);
}
?>
			<fieldset>
                <legend>پرسش و پاسخ های متداول</legend>
                <form action="faq.php" method="post">
                    <p><textarea cols="40" rows="40" name="faq" id="faq"><?php echo $faq; ?></textarea></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
