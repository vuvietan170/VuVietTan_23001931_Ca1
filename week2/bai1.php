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
        return "Tổng giá trị của sp: " . $this->getPrice() * $this->getQuantity();
    }
}

class ShoppingCart{
    private array $items = [];

    public function addItem(CartItem $item){
        return $this->items[] = $item;
    } 
    public function removeItem(string $name){
        // duyệt qua từng phần tử trong this-> item lấy key của ptu vào index và value và item
        foreach($this->items as $index=> $item){
            if($item->getName() === $name){
                unset($this->items[$index]); // xóa phần tử tại vị trí index
                $this->items = array_values($this->items); // đánh lại chỉ số của array
                echo "Đã xóa sản phẩm: $name<br>";
                return;
            }             
        }
         echo "Không tìm thấy sản phẩm $name";
    }
    public function calculateTotal():float {
        $total = 0;
        foreach($this->items as $item){
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }
    public function displayCart(){
        if(empty($this->items)){
            echo "Gio hang rong";
            return;
        }

        foreach ($this->items as $item){
            $subtotal = $item->getPrice() * $item->getQuantity();

            echo "Ten: " . $item->getName() ."<br>";
            echo "Don Gia: " . $item->getPrice() . "<br>";
            echo "So luong: " . $item->getQuantity() . "<br>";
            echo "Thannh tien: " . $subtotal . "<br>";
            echo "<hr>";
            
           
        }
         echo "<strong>Tong tien:" . $this->calculateTotal() . "</strong>";
    }
}

$cart = new ShoppingCart();

$item1 = new CartItem("TV", 99, 3);
$item2 = new CartItem("May quay" , 69 , 4);
$item3 = new CartItem("Dua chuot" , 12, 2);

$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);

$cart->displayCart();


?>