
<?php
	require_once("header1.php");
	
	$msg = '';
	$inbasket = '';
	$totalprice = 0;
	$code = 0;
	$amount = 0;
	$actionfield = '';
	
	if(isset($_POST['inbasket']))
	{
		$inbasket = $_POST['inbasket'];
		$actionfield = $_POST['actionfield'];
		
		$code = $_POST['goodscode'];
		$amount = (float)$_POST['amount'];
		
		if($inbasket == '' || md5($inbasket) == get_invoice_signature())
		{
			if($actionfield == 'add')
			{
				$res = db_get_goods($code);
				$g = new Goods();
				$g->id = 0;
				while($row = db_fetch_row($res))
				{
					$g->fill($row);
				}
				if($g->id == 0)
				{
					$msg = 'کد کالا معتبر نیست';
				}
				else
				{
					if($amount > 0)
					{
						$ii = new InvoiceItem();
						$ii->goodscode = $g->code;
						$ii->amount = $amount;
						$ii->unitprice = $g->price;
						$ii->goodsname = $g->name;
						
						if($inbasket != '')
							$inbasket .= ';';
						$inbasket .= $ii->save();
						
						set_invoice_signature(md5($inbasket));
						$code = 0;
						$amount = 0;
					}
					else
					{
						$msg = 'مقدار معتبر نیست';
					}
				}
			}else if($actionfield == 'final')
			{
				$arr = explode (";",$inbasket);
				$arr_count = 0;
				if(strlen($inbasket) > 0)
					$arr_count = count($arr);
				
				if($arr_count > 0)
				{					
					$i = 0;
					$ii = new InvoiceItem();
					$totalprice = 0;
					while($i < $arr_count)
					{
						$ii->restore($arr[$i],0);
						$i++;						
						$totalprice += $ii->total;
					}
					
					$inv = new Invoice();
					$inv->id = 0;
					$inv->username = get_username();
					$inv->status = 1;
					$inv->datetime = date_now();
					$inv->total = $totalprice;
					
					db_insert_invoice($inv);

					$i = 0;
					$ii = new InvoiceItem();
					$totalprice = 0;
					while($i < $arr_count)
					{
						$ii->restore($arr[$i],$inv->id);
						$i++;
						db_insert_invoice_item($ii);
					}
					
					redirect_site('./index.php');
				}
			}else
			{
				$del = (int)$actionfield;
				$i = 0;
				
				$arr = explode (";",$inbasket);
				$arr_count = 0;
				if(strlen($inbasket) > 0)
					$arr_count = count($arr);
				$inbasket = '';
				while($i < $arr_count)
				{
					$i++;
					if($i != $del)
					{
						if($inbasket != '')
							$inbasket .= ';';
						$inbasket .= $arr[$i-1];
					}
				}
				set_invoice_signature(md5($inbasket));
			}
		}
		else
		{
			$msg = 'داده های نامعتبر.لطفا ثبت فاکتور را دوباره انجام دهید';
			$inbasket = '';
		}
	}
	
	function get_title_page()
	{
		return 'ثبت فاکتور';
	}
	require_once("header2.php");
?>
			<fieldset>
            <form method="post" action="invoice.php" name="InvForm">
			<input type="hidden" name="inbasket" id="inbasket" value="<?php echo $inbasket; ?>" />
			<input type="hidden" name="actionfield" id="actionfield" value="" />
			<p><span class="bold">فاکتور جدید</span></p>
            <table cellspacing="0">
				<tbody>
                <tr>
                    <th>ردیف</th>
                    <th>کد</th>
                    <th>نام</th>
                    <th>تعداد</th>
                    <th>قیمت واحد</th>
                    <th>قیمت کل</th>
                    <th></th>
                </tr>
<?PHP
	$arr = explode (";",$inbasket);
	$arr_count = 0;
	if(strlen($inbasket) > 0)
		$arr_count = count($arr);
	$i = 0;
	$ii = new InvoiceItem();
	$totalprice = 0;
	while($i < $arr_count)
	{
		$ii->restore($arr[$i],0);
		$i++;
		echo "<tr><td>$i</td><td>$ii->goodscode</td><td>$ii->goodsname</td><td>$ii->amount</td><td>$ii->unitprice</td><td>$ii->total</td>";
		echo ENDLINE;
		echo "<td><input type='submit' name='del$i' class='searchsubmit formbutton' value='حذف' onclick='document.InvForm.actionfield.value = \"$i\";'/></td></tr>";
		echo ENDLINE;
		
		$totalprice += $ii->total;
	}
?>
				<tbody>
            </table>
			<br />
			<p>مجموع : <span class="bold"><?php echo $totalprice; ?></span>
				<input name="finalregister" style="margin-right: 150px;" class="formbutton" value="ثبت نهایی فاکتور" type="submit" onclick="document.InvForm.actionfield.value = 'final';"/>
			</p>
			<br />
			<p class="msg"><?php echo $msg; ?></p>
			<p><label for="goodscode">کد کالا:</label>
			<input name="goodscode" id="goodscode" value="<?php echo $code; ?>" type="text" /></p>
			<p><label for="amount">تعداد:</label>
			<input name="amount" id="amount" value="<?php echo $amount; ?>" type="text" /></p>
			<p>
				<input name="add" style="margin-right: 150px;" class="formbutton" value="به فاکتور اضافه کن" type="submit" onclick="document.InvForm.actionfield.value = 'add';"/>
			</p>
			</form>
            </fieldset>
<?php require_once("footer.php"); ?>
