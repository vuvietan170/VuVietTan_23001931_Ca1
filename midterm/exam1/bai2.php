<?php
class CartItem {
	public $name;
	public $price;
	public $quantity;
	
	function __construct( $name,  $price , $quantity) {
		$this->name = $name;
		$this->price = $price;
		$this->quantity = $quantity;
	}
	function getTotal() {
		return $this->price * $this->quantity;
	}

}
	$item = new CartItem("Sach the thao", 50000,2);
	echo "Gia cua san pham la: " . number_format($item->getTotal()) . " VND";
?>