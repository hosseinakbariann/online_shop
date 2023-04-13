
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'پرسش و پاسخ های متداول';
	}
	require_once("header2.php");
	
	echo "<p>$infosite->faq</p>";
	
	require_once("footer.php");
?>
