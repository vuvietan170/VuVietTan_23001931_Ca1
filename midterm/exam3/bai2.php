<?php
class Product {
	public $name;
	public $price;
	public $quantity;
	function __construct($name,$price,$quantity){
		$this->name = $name;
		$this->price = $price;
		$this->quantity = $quantity; 
	}
	function checkStock(){
		if($this->quantity > 0){
			return "Còn hàng (Số lượng" . $this->quantity . " )";
		}
		else {
			return "hết hàng";
		}
	}
}
$product = new Product("man hinh " , 890000, 3);
echo $product->checkStock();
?>
