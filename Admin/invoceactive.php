
<?php
	require_once("header1.php");
	function get_title_page()
	{
		return 'فاکتورهای فعال';
	}
	
	$actionfield = '';
	$statechange = 0;
	if(isset($_POST['actionfield']))
	{
		$actionfield = $_POST['actionfield'];
		if(isset($_POST['statechange']))
			$statechange = (int)$_POST['statechange'];
		if(substr($actionfield, 0, 6) === 'update')
		{
			$actionfield = (int)substr($actionfield, 6);
			if(($statechange==2 || $statechange==3) && $actionfield>0)
			{
				db_update_invoice_status($actionfield,$statechange);
			}
		}
	}
	require_once("header2.php");
?>
			<p><span class="bold">فاکتورهای فعال</span></p>
			<form action="invoceactive.php" method="post" name="InvForm">
			<input type="hidden" name="actionfield" id="actionfield" value="" />
				<table cellspacing="0">
					<tbody>
					<tr>
						<th>ردیف</th>
						<th>کاربر</th>
						<th>تاریخ صدور</th>
						<th>مبلغ کل</th>
						<th></th>
					</tr>
<?php
	$res = db_get_invoices_active();
	$inv = new Invoice();
	$i = 0;
	while($row = db_fetch_row($res))
	{
		$i++;
		$inv->fill($row);
		echo "<tr><td>$i</td><td>$inv->username</td><td>$inv->datetime</td><td>$inv->total</td>";
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
		$actionfield = $_POST['actionfield'];
		if(substr($actionfield, 0, 6) != 'update')
		{
		$actionfield = (int)$actionfield;
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
				$user = new User();
				$res = db_get_user($inv->username);
				$user->username = '';
				while($row = db_fetch_row($res))
				{
					$user->fill($row);
				}
				if($user->username != '')
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
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;کاربر : <span><?php echo $inv->username; ?></span></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تاریخ : <span><?php echo $inv->datetime; ?></span></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;مبلغ : <span><?php echo $inv->total; ?></span></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ایمیل : <span><?php echo $user->email; ?></span></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تلفن : <span><?php echo $user->telephone; ?></span></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;آدرس : <span><?php echo $user->address; ?></span></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="Option">وضعیت:</label>
				<select name="statechange">
				  <option value="2">ارسال شده</option>
				  <option value="3">لغو شده</option>
				</select>
				<input name="update" style="margin-right: 10px;" class="formbutton" value="بروز رسانی" type="submit" onclick='document.InvForm.actionfield.value = "update<?php echo $inv->id; ?>";' />
				</p>
				<br />
<?php
				}
			}
		}
		}
	}
?>
			</form>


<?php require_once("footer.php"); ?>
