
<?php
	require_once("base.inc.php");
	
	db_open();
	
	// $res = db_get_user('admin');
	// $user = new User();
	// while($row = db_fetch_row($res))
	// {
		// $user->fill($row);
		// echo $user->username . ENDLINE . $user->name . ENDLINE . $user->isAdmin;
		// echo ENDLINE;
	// }
	// echo ENDLINE . "count = ";
	// echo db_count_row($res);
	
	// $user->username = "ali";
	// $user->name = "علی";
	// $user->address = "add2";
	// $user->telephone = "0915";
	// db_insert_user($user,"1");
	
	
	// $cat = new Category();
	// $cat->title = "تلویزیون";
	// db_insert_category($cat);
	
	
	// $res = db_get_categories();
	// $cat = new Category();
	// while($row = db_fetch_row($res))
	// {
		// $cat->fill($row);
		// echo $cat->id . ENDLINE . $cat->title;
		// echo ENDLINE;
	// }
	
	
	// $res = db_get_informations();
	// $info = new Info();
	// $info->fill($res);
	// echo $info->title . ENDLINE;
	// echo $info->slogan . ENDLINE;
	// echo $info->copyright . ENDLINE;
	// echo $info->about_full . ENDLINE;
	// echo $info->about_minimal . ENDLINE;
	// echo $info->guid . ENDLINE;
	// echo $info->faq . ENDLINE;
	// echo ENDLINE;
	
	
	// $res = db_information_of_count();
	// $infoCount = new InfoCount();
	// $infoCount->fill($res);
	// echo $infoCount->user . ENDLINE;
	// echo $infoCount->category . ENDLINE;
	// echo $infoCount->goods . ENDLINE;
	// echo $infoCount->invoice . ENDLINE;
	// echo $infoCount->invoice_active . ENDLINE;
	// echo ENDLINE;
	
	// $info->title .= "A";
	// $info->slogan .= "B";
	// $info->copyright .= "C";
	// $info->about_full .= "D";
	// $info->about_minimal .= "E";
	// $info->guid .= "F";
	// $info->faq .= "I";
	// db_update_informations($info);
	
	// $g = new Goods();
	// $g->code = 1001;
	// $g->idcategory = 2;
	// $g->name = "تلویزیون";
	// $g->description = "AAAAA";
	// $g->price = 360;
	// $g->image = "IMAG1";
	// db_insert_goods($g);
	
	// $g = new Goods();
	// $g->code = 1002;
	// $g->idcategory = 3;
	// $g->name = "بابا";
	// $g->description = "BBB";
	// $g->price = 9600;
	// $g->image = "IMAG2";
	// db_insert_goods($g);
	
	// $g = new Goods();
	// $g->code = 1003;
	// $g->idcategory = 2;
	// $g->name = "TV";
	// $g->description = "CCCC";
	// $g->price = 1010;
	// $g->image = "IMAG3";
	// db_insert_goods($g);
	
	
	// $res = db_get_goods(1002);
	// $g = new Goods();
	// while($row = db_fetch_row($res))
	// {
		// $g->fill($row);
		// echo $g->code . ENDLINE;
		// echo $g->idcategory . ENDLINE;
		// echo $g->name . ENDLINE;
		// echo $g->description . ENDLINE;
		// echo $g->price . ENDLINE;
		// echo $g->image . ENDLINE;
		// echo ENDLINE;
	// }
	// echo ENDLINE;
	
	
	// $res = db_get_goods_of_category(2);
	// $g = new Goods();
	// while($row = db_fetch_row($res))
	// {
		// $g->fill($row);
		// echo $g->code . ENDLINE;
		// echo $g->idcategory . ENDLINE;
		// echo $g->name . ENDLINE;
		// echo $g->description . ENDLINE;
		// echo $g->price . ENDLINE;
		// echo $g->image . ENDLINE;
		// echo ENDLINE;
	// }
	// echo ENDLINE;
	
	
	// $res = db_get_last_goods(2);
	// $g = new Goods();
	// while($row = db_fetch_row($res))
	// {
		// $g->fill($row);
		// echo $g->code . ENDLINE;
		// echo $g->idcategory . ENDLINE;
		// echo $g->name . ENDLINE;
		// echo $g->description . ENDLINE;
		// echo $g->price . ENDLINE;
		// echo $g->image . ENDLINE;
		// echo ENDLINE;
	// }
	// echo ENDLINE;
	
	
	// $res = db_search_goods('a');
	// $g = new Goods();
	// while($row = db_fetch_row($res))
	// {
		// $g->fill($row);
		// echo $g->code . ENDLINE;
		// echo $g->idcategory . ENDLINE;
		// echo $g->name . ENDLINE;
		// echo $g->description . ENDLINE;
		// echo $g->price . ENDLINE;
		// echo $g->image . ENDLINE;
		// echo ENDLINE;
	// }
	// echo ENDLINE;
	
	// $invoice = new Invoice();
	// $invoice->id = 0;
	// $invoice->username = "admin";
	// $invoice->status = 0;
	// $invoice->datetime = date_now();
	// $invoice->total = 600;
	// db_insert_invoice($invoice);
	// echo $invoice->id;
	
	//db_update_invoice_status(21,2);
	
	
	// $res = db_get_invoices_active();
	// $invoice = new Invoice();
	// while($row = db_fetch_row($res))
	// {
		// $invoice->fill($row);
		// echo $invoice->id . ENDLINE;
		// echo $invoice->username . ENDLINE;
		// echo $invoice->status . ENDLINE;
		// echo $invoice->datetime . ENDLINE;
		// echo $invoice->total . ENDLINE;
		// echo ENDLINE;
	// }
	// echo ENDLINE;
	
	// $invoice = new InvoiceItem();
	// $invoice->id = 0;
	// $invoice->invoiceid = 20;
	// $invoice->goodscode = 1002;
	// $invoice->amount = 5;
	// $invoice->unitprice = 100;
	// $invoice->total = 500;
	// db_insert_invoice_item($invoice);
	// echo $invoice->id;
	
	// $invoice2 = new InvoiceItem();
	// $str = $invoice->save();
	// $invoice2->restore($str,21);
	// db_insert_invoice_item($invoice2);
	// echo $invoice2->id;
	
	
	// $res = db_get_invoice_items_for_invoice(21);
	// $invoice = new InvoiceItem();
	// while($row = db_fetch_row($res))
	// {
		// $invoice->fill($row);
		// echo $invoice->id . ENDLINE;
		// echo $invoice->invoiceid . ENDLINE;
		// echo $invoice->goodscode . ENDLINE;
		// echo $invoice->amount . ENDLINE;
		// echo $invoice->unitprice . ENDLINE;
		// echo $invoice->total . ENDLINE;
		// echo ENDLINE;
	// }
	// echo ENDLINE;
	
	//EMAIL regex : http://snipplr.com/view/1781/
	function check_email_demo($email)
	{
		$emailOK = preg_match("/[_\.0-9a-z-]+@[0-9a-z][0-9a-z-]+\.+[a-z]{2,3}/",$email);
		if($emailOK)
			echo "OK # : " . $email . ENDLINE;
		else
			echo "NO # : " . $email . ENDLINE;
	}
	check_email_demo('');
	check_email_demo('a');
	check_email_demo('abc');
	check_email_demo('a.a');
	check_email_demo('abc.a');
	check_email_demo('abc.abc');
	check_email_demo('abc@bc.com');
	check_email_demo('abc.a@bc.com');
	check_email_demo('abc.a@bc.d.com');
	check_email_demo('bc.com');
	check_email_demo('@bc.com');
	check_email_demo('abc@.com');
	check_email_demo('abc@bc.');
	
	db_close();
?>