
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'سابقه کاربر';
	}
	
	$username = '';
	if(isset($_POST['username']))
		$username = $_POST['username'];
		
	$user = new User();
	$res = db_get_user($username);
	$user->username = '';
	while($row = db_fetch_row($res))
	{
		$user->fill($row);
	}
	if($user->username == '')
		redirect_site('./index.php');
	
	require_once("header2.php");
?>

			<form action="usershistory.php" method="post" name="InvForm">
			<input type="hidden" name="username" id="username" value="<?php echo $username; ?>" />
			<input type="hidden" name="actionfield" id="actionfield" value="" />
			<p>کاربر : <span class="bold"><?php echo $user->username; ?></span></p>
			<p>نام : <span class="bold"><?php echo $user->name; ?></span></p>
			<p>ایمیل : <span class="bold"><?php echo $user->email; ?></span></p>
			<p>تلفن : <span class="bold"><?php echo $user->telephone; ?></span></p>
			<p>آدرس : <span class="bold"><?php echo $user->address; ?></span></p>
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
	$res = db_get_invoices_for_user($username);
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
	$actionfield = '';
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
?>
			</form>

<?php require_once("footer.php"); ?>
