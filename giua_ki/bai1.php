<?php
$name = "Nguyen Van A";
$score = 9.0;
function getRank($score){
    if($score >= 8){
        return "Giỏi";
    } elseif ($score >= 6.5){
        return "Khá";
    } elseif ($score >= 5) {
        return "Trung Bình";
    } else {
        return "Yếu";
    }
}


echo "Tên: " . $name ."<br>"
. " Điểm: " . $score ."<br>"
. "  Xếp loại: " . getRank($score);
?>