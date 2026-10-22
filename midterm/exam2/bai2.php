<?php
class MovieTicket {
	public $movieName;
	public $price;
	public $isStudent;
	function __construct($movieName , $price, $isStudent) {
		$this->movieName = $movieName;
		$this->price = $price;
		$this->isStudent = $isStudent;
	}
	function calculateFinalPrice(){
		if($this->isStudent == true){
			return $this->price * 0.8;
		}
		else{
			return $this->price;
		}
	}
}
$movie = new MovieTicket("Cuop bien", 36000, true);
echo $movie->calculateFinalPrice();
?>
