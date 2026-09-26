<?php
class CartItem{
    private $name;
    private $price;
    private $quantity;
    function __construct(string $name, float $price, int $quantity){
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getPrice(): float{
        return $this->price;
    }
    public function getQuantity() : int {
        return $this->quantity;
    }
    function getTotal(){
        return "Tổng giá trị của sp: " . $this->price * $this->quantity;
    }
}

class ShoppingCart{
    private array $items = [];

    public function addItem(CartItem $item) : bool 
    {
        if($item->getPrice() <= 0 ){
            echo "Price phai la so duong!" . "<br>";
            return false;
        }
        if($item->getQuantity()<=0){
            echo "quantity phai la 1 so duong! " . "<br>";
            return false;
        }
        $this->items[] = $item;
        echo "Da them san pham {$item->getName()} " . "<br>";
        return true;
    } 
    public function removeItem(string $name) : bool{
        // duyệt qua từng phần tử trong this-> item lấy key của ptu vào index và value và item
        foreach($this->items as $index=> $item){
            if($item->getName() === $name){
                unset($this->items[$index]); // xóa phần tử tại vị trí index
                $this->items = array_values($this->items); // đánh lại chỉ số của array
                echo "Đã xóa sản phẩm: $name" . "<br>";
                return true;
            }             
        }
         echo "Không tìm thấy sản phẩm $name" ."<br>";
         return false;
    }

    public function calculateTotal():float {
        $total = 0;
        foreach($this->items as $item){
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }
    public function displayCart() : void{
        if(empty($this->items)){
            echo "Gio hang rong";
            return;
        }

        foreach ($this->items as $item){
            $subtotal = $item->getPrice() * $item->getQuantity();
            echo "<br>";
            echo "Ten: " . $item->getName() ."<br>";
            echo "Don Gia: " . $item->getPrice() . "<br>";
            echo "So luong: " . $item->getQuantity() . "<br>";
            echo "Thannh tien: " . $subtotal . "<br>";
            echo "<br>";
            
           
        }
         echo "<strong>Tong tien:" . $this->calculateTotal() . "</strong>" . "<hr>";
    }
}

$cart = new ShoppingCart();

$item1 = new CartItem("TV", 99, 3);
$item2 = new CartItem("May quay" , 69 , 4);
$item3 = new CartItem("Dua chuot" , 12, 2);
$item4 = new CartItem("Bup be cho nam",1000,12);

//test loi gio hang
const invalidItem1 = new CartItem("Gay cho nu", -36, 2);
const invalidItem2 = new CartItem("Vay JK cho Nam", 18, -2);

$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);
$cart->addItem($item4);
$cart->addItem(invalidItem1);
$cart->addItem(invalidItem2);

// gio hang
$cart->displayCart();

// remove
echo "\n xoa san pham TV" . "<br>";
$cart->removeItem("TV");

echo "\n San pham Gay cho nu  khong ton tai" . "<br>";
$cart->removeItem("Gay cho nu \n");

//state cart
$cart->displayCart();


?>