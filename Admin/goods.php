
<?php
	require_once("header1.php");
	
	$msg = '';
	
	$g = new Goods();
	$g->code = 0;
	if(isset($_GET['id']))
	{		
		$g->code = (int)$_GET['id'];
		
		$res = db_get_goods($g->code);
		$g->code = 0;
		while($row = db_fetch_row($res))
		{
			$g->fill($row);
		}
	}
	else if(isset($_POST['id']))
	{
		$g->code = (int)$_POST['id'];
		$res = db_get_goods($g->code);
		$g->code = 0;
		while($row = db_fetch_row($res))
		{
			$g->fill($row);
		}
	}
	
	if($g->code == 0)
		redirect_site('./index.php');
		
	$name = $g->name;
	$code = $g->code;
	$price = $g->price;
	$description = $g->description;
	$categoryid = $g->idcategory;
	
if(isset($_POST['name']))
{
	$name = $_POST['name'];
	$code = (int)$_POST['code'];
	$price = (int)$_POST['price'];
	$description = $_POST['description'];
	$categoryid = (int)$_POST['category'];
	
	if(strlen($name) == 0)
		$msg = 'نام را وارد کنید';
	
	if(strlen($msg) == 0)
		if($code == 0)
			$msg = 'کد را وارد کنید';
	
	if(strlen($msg) == 0)
		if($price == 0)
			$msg = 'قیمت را وارد کنید';
			
	if(strlen($msg) == 0)
		if(strlen($description) == 0)
			$msg = 'توضیحات را وارد کنید';
			
	if(strlen($msg) == 0)
	{
		$res = db_get_category($categoryid);
		if(db_count_row($res) == 0)
			$msg = 'گروه کالا را انتخاب کنید';
	}
	
	if(strlen($msg) == 0 && $g->code != $code)
	{
		$res = db_get_goods($code);
		if(db_count_row($res) > 0)
			$msg = 'کد کالا تکراری است';
	}
	
	if(strlen($msg) == 0)
	{
		if ((($_FILES["image"]["type"] == "image/gif")
			|| ($_FILES["image"]["type"] == "image/jpeg")
			|| ($_FILES["image"]["type"] == "image/jpg")
			|| ($_FILES["image"]["type"] == "image/pjpeg")
			|| ($_FILES["image"]["type"] == "image/x-png")
			|| ($_FILES["image"]["type"] == "image/png")))
		{
			if(($_FILES["image"]["size"] < 500*1024))
			{
				if(($_FILES["image"]["size"] > 100))
				{
					if ($_FILES["image"]["error"] > 0)
						$msg = 'خطا در بارگذاری کنید : ' . $_FILES["image"]["error"];
					else
					{
						$image = uniqid("", true) . ".png";
						while (file_exists("../pic/" . $image))
							$image = uniqid("", true) . ".png";
						move_uploaded_file($_FILES["image"]["tmp_name"],"../pic/" . $image);
					}
				}
				else
					$image = '';
			}
			else
				$msg = 'حداکثر حجم مجاز برای فایل به کیلو بایت : 500';
		}
		else
			$image = '';
	}
	
	if(strlen($msg) == 0)
	{
		$g->code = $code;
		$g->idcategory = $categoryid;
		$g->name = $name;
		$g->price = $price;
		$g->description = $description;
		if(strlen($image) > 0)
			$g->image = $image;
		
		db_update_goods($g);
	}
}
	
	function get_title_page()
	{
		global $g;
		if($g->code > 0)
			return $g->name;
		return '';
	}
	require_once("header2.php");
?>

			<fieldset>
                <legend><?php echo $name; ?></legend>
                <form action="goods.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="id" value="<?php echo $g->code; ?>" />
					<p><img id="img" src="../pic/<?php echo $g->image; ?>" /></p>
					<p class="msg"><?php echo $msg; ?></p>
                    <p><label for="name">عنوان:</label>
                    <input name="name" id="name" value="<?php echo $name; ?>" type="text" /></p>
                    <p><label for="code">کد:</label>
                    <input name="code" id="code" value="<?php echo $code; ?>" type="text" /></p>
                    <p><label for="category">گروه:</label>
                    <select name="category">
<?php
	$res = db_get_categories();
	$cat = new Category();
	while($row = db_fetch_row($res))
	{
		$cat->fill($row);
		if($categoryid != $cat->id)
			echo "<option value='$cat->id'>$cat->title</option>";
		else
			echo "<option value='$cat->id' selected>$cat->title</option>";
		echo ENDLINE;
	}
?>
					</select>
					</p>
                    <p><label for="price">قیمت:</label>
                    <input name="price" id="price" value="<?php echo $price; ?>" type="text" /></p>
                    <p><label for="price">توضیحات:</label>
					<textarea cols="40" rows="20" name="description" id="description"><?php echo $description; ?></textarea></p>
                    <p><label for="image">تصویر:</label>
					<input type="file" name="image" id="image"></p>
                    <p>
					   
						<input name="send" style="margin-right: 150px;" class="formbutton" value="ثبت" type="submit" />
						 <input name=hazv style="margin-right:150px" class="formbutton" value="حذف" type="submit"/>
					</p>
                </form>
            </fieldset>

<?php require_once("footer.php"); ?>
