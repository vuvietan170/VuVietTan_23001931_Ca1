<?php

class TaiKhoan {
	public $ten;
	private $soDu; 
	
	public function __construct($ten, $soDuBanDau) { 
		$this->ten = $ten; 
		$this->soDu = $soDuBanDau; 
	} 
	public function getSoDu(){
		return $this->soDu;
	}
	public function naptien($soTien){
		if ($soTien > 0){
			$this->soDu += $soTien;
		}
	}
	public function rutTien($soTien){
		if ($soTien > 0 && $soTien <= $this->soDu){
			$this->soDu -= $soTien;
			return true;
		}
		else {
			echo "So du khong du";
			return false;
		}
	}
}
$tk = new Taikhoan("Vu Viet Nam", 50000);

$tk->rutTien(20000);
echo "so du con lai " . $tk->ten . " la: " . $tk->getSodu();
?>