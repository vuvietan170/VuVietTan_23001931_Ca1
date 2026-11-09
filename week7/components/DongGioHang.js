// Component con không thay đổi props, chỉ phát sự kiện cho cha.
const DongGioHang = {
  props: { sanPham: { type: Object, required: true } },
  emits: ['doi-so-luong', 'yeu-cau-xoa'],
  methods: {
    money(value) { return new Intl.NumberFormat('vi-VN', {style:'currency',currency:'VND'}).format(value); },
    change(amount) { this.$emit('doi-so-luong', this.sanPham.id, this.sanPham.quantity + amount); }
  },
  template: `<tr><td><b>{{sanPham.name}}</b></td><td>{{money(sanPham.price)}}</td><td><div class="quantity"><button :disabled="sanPham.quantity<=1" @click="change(-1)">−</button><span>{{sanPham.quantity}}</span><button :disabled="sanPham.quantity>=99" @click="change(1)">+</button></div></td><td><b>{{money(sanPham.price*sanPham.quantity)}}</b></td><td><button class="danger" @click="$emit('yeu-cau-xoa',sanPham.id)">Xóa</button></td></tr>`
};
