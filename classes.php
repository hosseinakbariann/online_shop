<?php
class User
{
	public $username = "";
	public $name = "";
	public $address = "";
	public $telephone = "";
	public $email = "";
	public $isAdmin = false;
	
	public function fill($row)
	{
		$this->username = $row['username'];
		$this->name = $row['name'];
		$this->address = $row['address'];
		$this->telephone = $row['telephone'];
		$this->email = $row['email'];
		$this->isAdmin = ($row['isAdmin'] == 1);
	}
}
class Category
{
	public $id = 0;
	public $title = "";
	
	public function fill($row)
	{
		$this->id = $row['id'];
		$this->title = $row['title'];
	}
}
class Info
{
	public $title = "";
	public $slogan = "";
	public $copyright = "";
	public $about_full = "";
	public $about_minimal = "";
	public $guid = "";
	public $faq = "";
	
	public function fill($result)
	{
		while($row = mysql_fetch_array($result))
		{
			switch($row['id'])
			{
			case 1: $this->title = $row['data']; break;
			case 2: $this->slogan = $row['data']; break;
			case 3: $this->copyright = $row['data']; break;
			case 4: $this->about_full = $row['data']; break;
			case 5: $this->about_minimal = $row['data']; break;
			case 6: $this->guid = $row['data']; break;
			case 7: $this->faq = $row['data']; break;
			}
		}
	}
}
class Goods
{
	public $id = 0;
	public $code = 0;
	public $idcategory = 0;
	public $name = "";
	public $description = "";
	public $price = "";
	public $image = "";
	
	public function fill($row)
	{
		$this->id = $row['id'];
		$this->code = $row['code'];
		$this->idcategory = $row['idcategory'];
		$this->name = $row['name'];
		$this->description = $row['description'];
		$this->price = $row['price'];
		$this->image = $row['image'];
	}
}
class Invoice
{
	public $id = 0;
	public $username = "";
	public $status = 0;
	public $datetime = "";
	public $total = 0;
	
	//status : 
	//		1 : оя мгА │М░МяМ
	//		2 : гясгА тоЕ
	//		3 : АшФ тоЕ
	
	public function fill($row)
	{
		$this->id = $row['id'];
		$this->username = $row['username'];
		$this->status = $row['status'];
		$this->datetime = $row['date'];
		$this->total = $row['total'];
	}
}
class InvoiceItem
{
	public $id = 0;
	public $invoiceid = 0;
	public $goodscode = 0;
	public $goodsname = '';
	public $amount = 0;
	public $unitprice = 0;
	public $total = 0;
	
	public function fill($row)
	{
		$this->id = $row['id'];
		$this->invoiceid = $row['invoiceid'];
		$this->goodscode = $row['goodscode'];
		$this->goodsname = $row['goodsname'];
		$this->amount = $row['amount'];
		$this->unitprice = $row['unitprice'];
		$this->total = $row['total'];
	}
	
	public function save()
	{
		return "".$this->goodscode.",".$this->amount.",".$this->unitprice.",".$this->goodsname;
	}
	
	public function restore($str,$invoice_id)
	{
		$arr = explode (",",$str);
		$this->id = 0;
		$this->invoiceid = $invoice_id;
		$this->goodscode = (int)$arr[0];
		$this->amount = (float)$arr[1];
		$this->unitprice = (float)$arr[2];
		$this->goodsname = $arr[3];
		$this->total = $this->amount*$this->unitprice;
	}
}
class InfoCount
{
	public $user = 0;
	public $category = 0;
	public $goods = 0;
	public $invoice = 0;
	public $invoice_active = 0;
	
	public function fill($result)
	{
		while($row = mysql_fetch_array($result))
		{
			if($row['tbl'] == 'users') $this->user = $row['cnt'];
			if($row['tbl'] == 'category') $this->category = $row['cnt'];
			if($row['tbl'] == 'goods') $this->goods = $row['cnt'];
			if($row['tbl'] == 'invoice') $this->invoice = $row['cnt'];
			if($row['tbl'] == 'invoiceactive') $this->invoice_active = $row['cnt'];
		}
	}
}
?>