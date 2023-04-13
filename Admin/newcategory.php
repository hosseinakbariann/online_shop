
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'ثبت گروه کالای جدید';
	}
	require_once("header2.php");
?>


<?php
$title = '';
$msg = '';
if(isset($_POST['title']))
{
	$title = $_POST['title'];
	
	if(strlen($title) == 0)
		$msg = 'عنوان را وارد کنید';
	
	if(strlen($msg) == 0)
	{
		$cat = new Category();
		$cat->title = $title;
		
		$res = db_get_category_of_title($title);
		if(db_count_row($res) > 0)
		{
			$msg = 'عنوان تکراری است';
		}
		else
		{
			db_insert_category($cat);
		
			redirect_site('./category.php?id=' . $cat->id);
		}
	}
}
?>
			<fieldset>
                <legend>ثبت گروه کالای جدید</legend>
                <form action="newcategory.php" method="post">
					<p class="msg"><?php echo $msg; ?></p>
                    <p><label for="title">عنوان:</label>
                    <input name="title" id="title" value="" type="text" /></p>
                    <p>
						<input name="send" style="margin-right: 150px;" class="formbutton" value="ثبت" type="submit" />
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
