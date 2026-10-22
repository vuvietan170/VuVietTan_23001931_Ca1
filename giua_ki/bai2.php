<?php
//rename
$price = [50000,60000,100000,200000,30000];
function calculateTotal($price) {
	$total = 0 ;
	foreach($price as $p){
		$total += $p;
	}
	return $total;
}
function findMaxPrice($price){
    $maxPrice = 0;
    foreach($price as $p){
        if($p > $maxPrice){
            $maxPrice = $p;
        }
    }
    return $maxPrice;

}
echo "Tổng tiền giỏ hàng: " . number_format(calculateTotal($price)) . " VND" . "<br>";
echo "Max Price: " . number_format(findMaxPrice($price)) . " VND";
?>