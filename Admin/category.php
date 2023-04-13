
<?php
	require_once("header1.php");
	
	$msg = '';
	
	$cat = new Category();
	$cat->id = 0;
	if(isset($_GET['id']))
	{		
		$cat->id = (int)$_GET['id'];
		
		$res = db_get_category($cat->id);
		while($row = db_fetch_row($res))
		{
			$cat->fill($row);
		}
	}
	else if(isset($_POST['id']))
	{
		$cat->id = (int)$_POST['id'];
		
		$res = db_get_category($cat->id);
		while($row = db_fetch_row($res))
		{
			$cat->fill($row);
		}
	}
	
	if($cat->id == 0)
		redirect_site('./index.php');
	
	if(isset($_POST['id']))
	{
		$cat->title = $_POST['title'];
		
		if(strlen($cat->title) == 0)
			$msg = "عنوان را وارد کنید";
		else
		{
			$action = $_POST['actionfield'];
			if($action == 'delete')
			{
				$res = db_get_goods_of_category($cat->id);
				if(db_count_row($res) == 0)
				{
					db_delete_category($cat->id);
					redirect_site('./index.php');
					db_delete_goods($g->id);
					redirect_site('./index.php');
				}
				else
				{
					$msg = "این گروه دارای محصول است- نمی توایند حذف کنید";
				}
			}
			else
			{
				db_update_category($cat);
			}
		}
	}
	
	function get_title_page()
	{
		global $cat;
		if($cat->id > 0)
			return ': گروه ' . $cat->title;
		return '';
	}
	require_once("header2.php");
?>

	<fieldset>
		<legend>گروه : <?php echo $cat->title; ?></legend>
		<form action="category.php" method="post" name="CatForm">
			<p class="msg"><?php echo $msg; ?></p>
			<input type="hidden" name="id" id="id" value="<?php echo $cat->id; ?>" />
			<input type="hidden" name="actionfield" id="actionfield" value="" />
			<p><label for="title">عنوان:</label>
			<input name="title" id="title" value="<?php echo $cat->title; ?>" type="text" /></p>
			<p>
				<input name="update" style="margin-right: 150px;" class="formbutton" value="بروزرسانی" type="submit"  onclick="document.CatForm.actionfield.value = 'update';" />
				<input name="delete" style="margin-right: 10px;" class="formbutton" value="حذف" type="submit"  onclick="document.CatForm.actionfield.value = 'delete';" />
			</p>
		</form>
	</fieldset>
	<br />
	<hr />
	<br />
	<div id="prd">
<?php
	$res = db_get_goods_of_category($cat->id);
	$g = new Goods();
	while($row = db_fetch_row($res))
	{
		$g->fill($row);
		echo "<a href='goods.php?id=$g->code'><div><img src='../pic/$g->image' /><div><span>$g->name</span></div></div></a>" . ENDLINE;
	}
?>
	</div>
<?php require_once("footer.php"); ?>
