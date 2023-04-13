
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'درباره ما';
	}
	require_once("header2.php");
	
	echo "<p>$infosite->about_full</p>";
	
	require_once("footer.php");
?>
