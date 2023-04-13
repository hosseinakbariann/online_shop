
<?php
	require_once("header1.php");
	
	$g = new Goods();
	$cat = new Category();
	
	$g->code = 0;
	if(isset($_GET['id']))
	{
		$g->code = (int)$_GET['id'];
		
		$res = db_get_goods($g->code);
		while($row = db_fetch_row($res))
		{
			$g->fill($row);
		}
		
		$res = db_get_category($g->idcategory);
		while($row = db_fetch_row($res))
		{
			$cat->fill($row);
		}
	}
	
	if($g->code == 0 || $cat->id == 0)
		redirect_site('./index.php');

	function get_title_page()
	{
		global $g;
		if($g->code > 0)
			return $g->name;
		return '';
	}
	require_once("header2.php");
?>

			<h1><?php echo $g->name; ?></h1>
			<p><img id="img" src='../pic/<?php echo $g->image; ?>' /></p>
			<p>کد کالا: <span class="bold"><?php echo $g->code; ?></span></p>
			<p>گروه : <span class="bold"><?php echo $cat->title; ?></span></p>
			<p>قیمت : <span class="bold"><?php echo $g->price; ?></span> ریال</p>
			<p><?php echo $g->description; ?></p>
<?php require_once("footer.php"); ?>
