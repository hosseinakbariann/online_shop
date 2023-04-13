
<?php
	require_once("header1.php");
	
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
	
	if($cat->id == 0)
		redirect_site('./index.php');

	function get_title_page()
	{
		global $cat;
		if($cat->id > 0)
			return ': گروه ' . $cat->title;
		return '';
	}
	require_once("header2.php");
?>

	<p>گروه : <span class="bold"><?php echo $cat->title; ?></span></p>
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
