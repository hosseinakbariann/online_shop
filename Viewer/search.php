
<?php
	require_once("header1.php");
$search = '';
if(isset($_POST['search']))
{
	$search = $_POST['search'];
}

	function get_title_page()
	{
		global $search;
		if(isset($_POST['search']))
			return 'نتیجه جستجو برای : ' . $search;
		return 'جستجو';
	}
	require_once("header2.php");
?>

<?php
if(isset($_POST['search']))
{
	$search = $_POST['search'];
?>

	<p>نتیجه جستجو برای : <span class="bold"><?php echo $search; ?></span></p>
	<div id="prd">
<?php
	$res = db_search_goods($search);
	$g = new Goods();
	while($row = db_fetch_row($res))
	{
		$g->fill($row);
		echo "<a href='goods.php?id=$g->code'><div><img src='../pic/$g->image' /><div><span>$g->name</span></div></div></a>" . ENDLINE;
	}
	echo "</div>";
}
?>
<?php require_once("footer.php"); ?>
