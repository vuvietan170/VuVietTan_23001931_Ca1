<?php
$scores = [8.5, 4.0, 9.0, 5.5, 3.5, 7.0, 6.5];
$newScores = [];

foreach ($scores as $s){
	if($s > 5.0){
		$newScores[] = $s; 
	}
}
echo count($newScores);
?>
