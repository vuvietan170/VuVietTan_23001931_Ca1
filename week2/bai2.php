<?php
class Movie{
    private $id;
    private $title;
    private $price;

    private $totalSeats;
    private $availableSeats;

    function __construct(int $id, string $title, float $price, int $totalSeats ){
         $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }
    public function getId(): int
    {
        return $this->id;
    }
 
    public function getTitle(): string
    {
        return $this->title;
    }
 
    public function getPrice(): float
    {
        return $this->price;
    }
 
    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }
 
    public function getAvailableSeats(): int
    {
        return $this->availableSeats;
    }

    //dat ve
    public function bookTicket(int $quantity) : bool{
        if ($quantity <= 0){
            echo "[{$this->title}]: So luong phai lon hon 0! <br>";
            return false;
        }
        if($quantity > $this->availableSeats){
            echo "[{$this->title}]: het cho ngoi roi. <br>";
            return false;
        }

        $this->availableSeats -= $quantity;
        echo "[{$this->title}]: Dat ve thanh cong, ve con lai {this->availableSeats}. <br>" ;
        return true;
    }

    //get soldSeats(so ve da ban)
    public function getSoldSeats() : int{
        return $this->totalSeats - $this->availableSeats;
    }

    //huy ve
    public function cancelTicket(int $quantity) : bool {
         if ($quantity <= 0){
            echo "[{$this->title}]: So luong ve huy phai lon hon 0! <br>";
            return false;
        }
        $soldSeats = $this->getSoldSeats();
        if($quantity > $soldSeats){
            echo "[{$this->title}]: Khong the huy qua so ve da ban (so ve da ban $soldSeats}) .<br>";
            return false;
        }
        $this->availableSeats += $quantity;
        echo "[{$this->title}]: Da huy ve, so ve con lai: $this->availableSeats. <br>";
        return true;
    }

    // tra ve doanh thu
    public function getRevenue(): float {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo(): void
    {
        printf(
            "ID: %-3d | %-10s | Giá vé: %10s | Tổng ghế: %4d | Còn lại: %4d | Đã bán: %4d | Doanh thu: %14s <br>",
            $this->id,
            $this->title,
            number_format($this->price, 0, ',', '.'),
            $this->totalSeats,
            $this->availableSeats,
            $this->getSoldSeats(),
            number_format($this->getRevenue(), 0, ',', '.')
        );
    }


   
}

 // tim phim theo id 
    function findMovieById(array $movie, int $id) : ?Movie {
        foreach ($movie as $m){
            if($m->getID() == $id){
                return $m;
            }
        }
        return null;
    }

    //ham tinh tong doang thu danh sach
    function getTotalRevenue(array $movies) : float {
        if(empty($movies)){
            return 0;
        }
        $total = 0;
        foreach ($movies as $m){
            $total += $m->getRevenue();
        }
        return $total;
    }

    // tim phim co so ve ban ra nhieu nhat
    function getBestSellingMovie(array $movies) : ?Movie{
        if(empty($movies)){
            return null;
        }
        $best = $movies[0];
        foreach ($movies as $m){
            if($m->getSoldSeats() > $best->getSoldSeats()){
                $best = $m;
            }
        }
        return $best;
    }


$movies = [
    new Movie(1, "Avengers", 100000, 100),
    new Movie(2, "Avatar", 120000, 80),
    new Movie(3, "Batman", 90000, 120),
];
// test case AI
echo ">> Đặt vé cho phim Avengers (id = 1), số lượng: 40<br>";
$avengers = findMovieById($movies, 1);
if ($avengers !== null) {
    $avengers->bookTicket(40);
}
 
echo "<br>>> Đặt vé cho phim Avatar (id = 2), số lượng: 30<br>";
$avatar = findMovieById($movies, 2);
if ($avatar !== null) {
    $avatar->bookTicket(30);
}
 
echo "<br>>> Hủy 10 vé đã đặt của phim Avengers<br>";
if ($avengers !== null) {
    $avengers->cancelTicket(10);
}
 
// Các trường hợp không hợp lệ để kiểm tra xử lý lỗi
echo "<br>>> Kiểm tra các trường hợp không hợp lệ:<br>";
if ($avengers !== null) {
    $avengers->bookTicket(0);       // số vé <= 0
    $avengers->bookTicket(1000);    // vượt quá số ghế còn lại
    $avengers->cancelTicket(-5);    // số vé hủy <= 0
    $avengers->cancelTicket(1000);  // hủy nhiều hơn số vé đã bán
}
 
$notFound = findMovieById($movies, 999);
if ($notFound === null) {
    echo "Không tìm thấy phim có id = 999.<br>";
}
 
echo "<br>>> Thông tin tất cả các phim:<br>";
foreach ($movies as $movie) {
    $movie->displayInfo();
}
 
echo "<br>>> Tổng doanh thu tất cả các phim: " . number_format(getTotalRevenue($movies), 0, ',', '.') . " VND<br>";
 
$bestSeller = getBestSellingMovie($movies);
if ($bestSeller !== null) {
    echo "<br>>> Phim bán chạy nhất: {$bestSeller->getTitle()} (đã bán {$bestSeller->getSoldSeats()} vé)<br>";
}
 
// Kiểm tra danh sách phim rỗng
echo "<br>>> Kiểm tra function xử lý với danh sách phim rỗng:<br>";
$emptyMovies = [];
echo "Tổng doanh thu (danh sách rỗng): " . number_format(getTotalRevenue($emptyMovies), 0, ',', '.') . " VND<br>";
$bestOfEmpty = getBestSellingMovie($emptyMovies);
echo "Phim bán chạy nhất (danh sách rỗng): " . ($bestOfEmpty === null ? "Không có (danh sách rỗng)" : $bestOfEmpty->getTitle()) . "<br>";
?>