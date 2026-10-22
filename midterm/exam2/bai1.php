<?php
$students = [["id"=> "SV01", "name"=> "Nuya van a", "gpa" => 8.6],
["id"=> "SV02", "name"=> "Tran thi C", "gpa" => 9.0],
["id"=> "SV03", "name"=> "Le Van D", "gpa" => 8.0 ]
];
function getTopStudent($students){
	$bestStudent = $students[0];
	foreach ($students as $stu){
		if($stu["gpa"] > $bestStudent["gpa"]){
			$bestStudent = $stu;
		}
	}
	return $bestStudent;
}
echo getTopStudent($students)["name"];
?>
