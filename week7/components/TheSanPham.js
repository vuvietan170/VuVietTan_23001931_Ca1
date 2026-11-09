// Component của Bài 2: trạng thái mô tả nằm riêng trong từng thẻ.
const TheSanPham = {
  props: {
    ten: { type: String, required: true },
    gia: { type: Number, required: true },
    anh: { type: String, default: 'https://placehold.co/600x400?text=San+pham' },
    moTa: { type: String, default: 'Chưa có mô tả.' },
    soLuongTon: { type: Number, default: 0 }
  },
  emits: ['mua'],
  data() { return { moMoTa: false }; },
  methods: { money(value) { return new Intl.NumberFormat('vi-VN', {style:'currency',currency:'VND'}).format(value); } },
  template: `
    <article class="product-card">
      <img :src="anh" :alt="ten" loading="lazy">
      <div class="product-content">
        <div class="product-title"><h3>{{ten}}</h3><span class="pill" :class="soLuongTon>0?'ok':'out'">{{soLuongTon>0?'Còn hàng':'Hết hàng'}}</span></div>
        <strong class="price">{{money(gia)}}</strong><p class="muted">Tồn kho: {{soLuongTon}}</p>
        <p v-if="moMoTa" class="description">{{moTa}}</p>
        <div class="actions"><button @click="moMoTa=!moMoTa">{{moMoTa?'Ẩn mô tả':'Xem mô tả'}}</button><button class="primary" :disabled="soLuongTon===0" @click="$emit('mua')">Mua</button></div>
      </div>
    </article>`
};
