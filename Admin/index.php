
<?php
	require_once("header1.php");
	function get_title_page()
	{
		global $infosite;
		return $infosite->title . " - " . $infosite->slogan;
	}
	require_once("header2.php");
	
	$res = db_information_of_count();
	$infoCount = new InfoCount();
	$infoCount->fill($res);
?>

			<p><span class="bold">اطلاعات کلی سایت</span></p>
            <table cellspacing="0">
				<tbody>
                <tr>
                    <th>عنوان</th>
                    <th>تعداد</th>
                </tr>
                <tr>
                    <td>کاربران</td>
                    <td><?php echo $infoCount->user; ?></td>
                </tr>
                <tr>
                    <td>گروه کالا</td>
                    <td><?php echo $infoCount->category; ?></td>
                </tr>
                <tr>
                    <td>کالا</td>
                    <td><?php echo $infoCount->goods; ?></td>
                </tr>
                <tr>
                    <td>فاکتور</td>
                    <td><?php echo $infoCount->invoice; ?></td>
                </tr>
                <tr>
                    <td>فاکتورهای فعال</td>
                    <td><?php echo $infoCount->invoice_active; ?></td>
                </tr>
				<tbody>
            </table>


<?php require_once("footer.php"); ?>
