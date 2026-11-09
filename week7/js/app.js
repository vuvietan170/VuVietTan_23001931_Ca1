// Gộp logic từng bài vào một ứng dụng, đăng ký component trước khi mount.
const app = Vue.createApp({
  data() { return {...bai1.data(),...bai2.data(),...bai3.data(),activeTab:1,tabs:[{id:1,label:'Bài 1 · Quản lý'},{id:2,label:'Bài 2 · Component'},{id:3,label:'Bài 3 · Giỏ hàng'}],status:'Đang tải',searchWarning:'',toast:''}; },
  computed: {...bai1.computed,...bai3.computed},
  watch: {...bai1.watch},
  methods: {
    ...bai1.methods,...bai2.methods,...bai3.methods,
    money(value) { return new Intl.NumberFormat('vi-VN',{style:'currency',currency:'VND',maximumFractionDigits:0}).format(value); },
    notify(message) { this.toast=message; }
  },
  mounted() { this.status='Sẵn sàng'; }
});
app.component('the-san-pham',TheSanPham);
app.component('dong-gio-hang',DongGioHang);
app.mount('#app');
