const bai3 = {
  data() { return { cart: [
    {id:201,name:'Bút bi',price:5000,quantity:2},
    {id:202,name:'Quyển vở',price:12000,quantity:3}
  ] }; },
  computed: {
    totalQuantity() { return this.cart.reduce((sum,p)=>sum+p.quantity,0); },
    totalPrice() { return this.cart.reduce((sum,p)=>sum+p.price*p.quantity,0); }
  },
  methods: {
    updateQuantity(id,newQuantity) {
      if(!Number.isInteger(newQuantity)||newQuantity<1||newQuantity>99) return;
      const p=this.cart.find(x=>x.id===id);
      if(!p) return;
      const catalogItem=this.catalog.find(x=>x.id===id);
      if(catalogItem && newQuantity>catalogItem.stock) { this.notify('Số lượng vượt quá tồn kho.');return; }
      p.quantity=newQuantity;
    },
    removeCartItem(id) { this.cart=this.cart.filter(p=>p.id!==id);this.notify('Đã xóa khỏi giỏ hàng.'); }
  }
};
