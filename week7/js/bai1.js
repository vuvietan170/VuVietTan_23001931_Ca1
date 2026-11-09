// Dữ liệu và logic Bài 1 (Options API)
const bai1 = {
  data() { return {
    products: [
      {id:1,name:'Bút bi xanh',price:5000,category:'Văn phòng phẩm',stock:30},
      {id:2,name:'Vở kẻ ngang',price:12000,category:'Văn phòng phẩm',stock:25},
      {id:3,name:'Chuột không dây',price:189000,category:'Điện tử',stock:8},
      {id:4,name:'Bàn phím cơ',price:650000,category:'Điện tử',stock:0},
      {id:5,name:'Bình nước giữ nhiệt',price:99000,category:'Gia dụng',stock:12},
      {id:6,name:'Đèn bàn LED',price:175000,category:'Gia dụng',stock:0}
    ],
    keyword:'', category:'', sortOrder:'none', formError:'',
    newProduct:{name:'',price:null,category:'Văn phòng phẩm',stock:0}
  }; },
  computed: {
    categories() { return [...new Set(this.products.map(p=>p.category).concat(['Văn phòng phẩm','Điện tử','Gia dụng']))]; },
    filteredProducts() {
      const q = this.keyword.trim().toLocaleLowerCase('vi');
      const result = this.products.filter(p => p.name.toLocaleLowerCase('vi').includes(q) && (!this.category || p.category===this.category));
      if (this.sortOrder==='asc') result.sort((a,b)=>a.price-b.price);
      if (this.sortOrder==='desc') result.sort((a,b)=>b.price-a.price);
      return result;
    },
    visibleStockValue() { return this.filteredProducts.reduce((sum,p)=>sum+p.price*p.stock,0); }
  },
  watch: {
    keyword(newValue) { this.searchWarning = newValue.trim().length===1 ? 'Vui lòng nhập ít nhất 2 ký tự để tìm kiếm chính xác hơn.' : ''; }
  },
  methods: {
    addProduct() {
      const p=this.newProduct;
      if (!p.name.trim()) { this.formError='Tên sản phẩm không được để trống.'; return; }
      if (!Number.isFinite(p.price)||p.price<=0) { this.formError='Giá phải lớn hơn 0.'; return; }
      if (!Number.isInteger(p.stock)||p.stock<0) { this.formError='Tồn kho phải là số nguyên không âm.'; return; }
      this.products.push({id:Math.max(0,...this.products.map(x=>x.id))+1,name:p.name.trim(),price:p.price,category:p.category,stock:p.stock});
      this.newProduct={name:'',price:null,category:'Văn phòng phẩm',stock:0};this.formError='';this.notify('Đã thêm sản phẩm.');
    },
    removeProduct(id) { if(window.confirm('Bạn có chắc muốn xóa sản phẩm này?')) { this.products=this.products.filter(p=>p.id!==id);this.notify('Đã xóa sản phẩm.'); } }
  }
};
