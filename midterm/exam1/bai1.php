<?php
$products = [["name"=> "Sách PHP","price" => 50000 , "quantity" => 2],
["name"=> "Sách MySQL" ,"price" => 60000, "quantity" => 3],
["name"=> "Sách HTML","price" => 40000 , "quantity" => 1]
];
function calculateTotal($products) {
	$total = 0 ;
	foreach($products as $key => $value){
		$total += $key->price;
	}
	return $total;
}
echo "Tổng tiền giỏ hàng: " . number_format(calculateTotal($products)) . " VND";
?>