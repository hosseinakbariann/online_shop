
<?php
	require_once("header1.php");
	function get_title_page()
	{
		global $infosite;
		return $infosite->title . " - " . $infosite->slogan;
	}
	require_once("header2.php");
?>

			<p><span class="bold">وضعیت فاکتورها</span></p>
			<form action="index.php" method="post" name="InvForm">
			<input type="hidden" name="actionfield" id="actionfield" value="" />
            <table cellspacing="0">
				<tbody>
                <tr>
                    <th>ردیف</th>
                    <th>تاریخ صدور</th>
                    <th>وضعیت</th>
                    <th>مبلغ کل</th>
                    <th></th>
                </tr>
<?php
	$res = db_get_invoices_for_user(get_username());
	$inv = new Invoice();
	$i = 0;
	while($row = db_fetch_row($res))
	{
		$i++;
		$inv->fill($row);
		$st = '';
		switch($inv->status)
		{
			case 1: $st = 'در حال پيگيري'; break;
			case 2: $st = 'ارسال شده'; break;
			case 3: $st = 'لغو شده'; break;
		}
		echo "<tr><td>$i</td><td>$inv->datetime</td><td>$st</td><td>$inv->total</td>";
		echo "<td><input name='show$inv->id' style='margin-right: 10px;' class='formbutton' value='نمایش' type='submit' onclick='document.InvForm.actionfield.value = \"$inv->id\";'/></td></tr>";
		echo ENDLINE;
	}
?>
				<tbody>
            </table>
<?php
	$actionfield = 0;
	if(isset($_POST['actionfield']))
	{
		$actionfield = (int)$_POST['actionfield'];
		if($actionfield > 0)
		{
			$inv = new Invoice();
			$res = db_get_invoice($actionfield);
			while($row = db_fetch_row($res))
			{
				$inv->fill($row);
			}
			if($inv->id > 0)
			{
				if($inv->username == get_username())
				{
?>
			<br />
			<hr />
			<br />
			<p></p>
			<h4>اقلام</h4>
			<table cellspacing="0">
				<tbody>
				<tr>
					<th>ردیف</th>
					<th>کد</th>
					<th>نام</th>
					<th>تعداد</th>
				</tr>
<?php
			$ii = new InvoiceItem();
			$res = db_get_invoice_items_for_invoice($inv->id);
			$i = 0;
			while($row = db_fetch_row($res))
			{
				$i++;
				$ii->fill($row);
				echo "<tr><td>$i</td><td>$ii->goodscode</td><td>$ii->goodsname</td><td>$ii->amount</td></tr>";
			}
?>
				<tbody>
			</table>
			<br />
			<br />
			<h4>اطلاعات جانبی</h4>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تاریخ : <span><?php echo $inv->datetime; ?></span></p>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;مبلغ : <span><?php echo $inv->total; ?></span></p>
			<br />
<?php
				}
			}
		}
	}
?>
			</form>

<?php require_once("footer.php"); ?>
