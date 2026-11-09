const bai2 = {
  data() { return { catalog: [
    {id:101,name:'Tai nghe Bluetooth',price:299000,stock:10,image:'https://placehold.co/600x400/e0e7ff/3730a3?text=Tai+nghe',description:'Tai nghe không dây, thiết kế gọn nhẹ, phù hợp học tập và giải trí.'},
    {id:102,name:'Sổ tay A5',price:35000,stock:18,image:'https://placehold.co/600x400/dcfce7/166534?text=So+tay+A5',description:'Sổ tay A5 giấy dày, thích hợp ghi chú hằng ngày.'},
    {id:103,name:'Đèn học để bàn',price:220000,stock:5,image:'https://placehold.co/600x400/fef3c7/92400e?text=Den+hoc',description:'Đèn LED để bàn với nhiều mức độ sáng.'},
    {id:104,name:'Loa mini',price:180000,stock:0,image:'https://placehold.co/600x400/fee2e2/991b1b?text=Loa+mini',description:'Loa nhỏ gọn dễ mang theo, hiện đã hết hàng.'}
  ] }; },
  methods: {
    buyCatalog(p) {
      if(p.stock<=0) return;
      const existing=this.cart.find(item=>item.id===p.id);
      if(existing) {
        if(existing.quantity>=99 || existing.quantity>=p.stock) { this.notify('Không thể thêm vượt quá số lượng cho phép hoặc tồn kho.');return; }
        this.updateQuantity(p.id,existing.quantity+1);
      } else { this.cart.push({id:p.id,name:p.name,price:p.price,quantity:1}); }
      this.notify('Đã thêm '+p.name+' vào giỏ hàng.');
    }
  }
};
