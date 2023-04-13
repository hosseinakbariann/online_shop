
<?php
	require_once("header1.php");
	function get_title_page()
	{
		global $infosite;
		return $infosite->title . " - " . $infosite->slogan;
	}
	require_once("header2.php");
?>
			<h2>آخرین کالا های افزوده شده به سایت</h2>
			<div id="prd">
<?php
	$res = db_get_last_goods(12);
	$g = new Goods();
	while($row = db_fetch_row($res))
	{
		$g->fill($row);
		echo "<a href='goods.php?id=$g->code'><div><img src='../pic/$g->image' /><div><span>$g->name</span></div></div></a>" . ENDLINE;
	}
?>

</div>
<?php require_once("footer.php"); ?>
