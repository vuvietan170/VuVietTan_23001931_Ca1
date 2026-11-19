const { createApp } = Vue;

createApp({
  data() {
    return {
      products: [],
      pagination: { page: 1, limit: 5, total: 0, total_pages: 1 },
      form: { name: '', price: '', stock: 0 },
      editingId: null,
      selectedFile: null,
      preview: '',
      currentImage: '',
      pendingUpload: false,
      busy: false,
      loading: false,
      message: ''
    };
  },
  methods: {
    async request(url, options = {}) {
      const response = await fetch(url, options);
      let result;
      try { result = await response.json(); }
      catch { throw new Error('Máy chủ không trả JSON hợp lệ. Kiểm tra PHP và cấu hình upload.'); }
      if (!response.ok || !result.success) throw new Error(result.message || 'Có lỗi xảy ra');
      return result;
    },
    async load(page = this.pagination.page) {
      this.loading = true;
      try {
        const result = await this.request('api/products.php?page=' + page + '&limit=5');
        this.products = result.data;
        this.pagination = result.pagination;
      } catch (e) {
        this.message = e.message;
      } finally {
        this.loading = false;
      }
    },
    setPreview(url) {
      if (this.preview.startsWith('blob:')) URL.revokeObjectURL(this.preview);
      this.preview = url;
    },
    chooseImage(event) {
      const file = event.target.files[0];
      this.selectedFile = null;
      this.setPreview(this.currentImage);
      if (!file) return;
      if (!['image/jpeg', 'image/png'].includes(file.type) || !/\.(jpe?g|png)$/i.test(file.name) || file.size > 2 * 1024 * 1024) {
        this.message = 'Chỉ nhận ảnh JPG, JPEG, PNG có dung lượng tối đa 2 MB.';
        event.target.value = '';
        return;
      }
      this.selectedFile = file;
      this.setPreview(URL.createObjectURL(file));
      this.message = '';
    },
    edit(p) {
      this.reset();
      this.editingId = Number(p.id);
      this.form = { name: p.name, price: Number(p.price), stock: Number(p.stock) };
      this.currentImage = p.image || '';
      this.setPreview(this.currentImage);
      this.message = '';
    },
    reset() {
      this.editingId = null;
      this.form = { name: '', price: '', stock: 0 };
      this.selectedFile = null;
      this.currentImage = '';
      this.setPreview('');
      this.pendingUpload = false;
      this.$refs.imageInput.value = '';
    },
    async upload() {
      const body = new FormData();
      body.append('id', this.editingId);
      body.append('image', this.selectedFile);
      await this.request('api/upload.php', { method: 'POST', body });
    },
    async save() {
      if (this.busy || this.pendingUpload) return;
      this.busy = true;
      this.message = '';
      const editing = this.editingId !== null;
      let saved = false;
      try {
        const result = await this.request('api/products.php' + (editing ? '?id=' + this.editingId : ''), {
          method: editing ? 'PUT' : 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(this.form)
        });
        saved = true;
        if (!editing) this.editingId = result.id;
        if (this.selectedFile) {
          this.pendingUpload = true;
          await this.upload();
        }
        this.reset();
        this.message = 'Đã lưu sản phẩm.';
      } catch (e) {
        this.message = (saved ? 'Thông tin sản phẩm đã lưu, upload ảnh thất bại: ' : '') + e.message;
      } finally {
        if (saved) await this.load(editing ? this.pagination.page : 1);
        this.busy = false;
      }
    },
    async retryUpload() {
      if (this.busy || !this.pendingUpload || !this.selectedFile) return;
      this.busy = true;
      try {
        await this.upload();
        this.reset();
        this.message = 'Upload ảnh thành công.';
        await this.load();
      } catch (e) {
        this.message = 'Upload ảnh thất bại: ' + e.message;
      } finally {
        this.busy = false;
      }
    },
    async remove(id) {
      if (this.busy || !confirm('Bạn có chắc muốn xóa sản phẩm?')) return;
      this.busy = true;
      this.message = '';
      try {
        await this.request('api/products.php?id=' + id, { method: 'DELETE' });
        if (this.editingId === Number(id)) this.reset();
        this.message = 'Đã xóa sản phẩm.';
        await this.load();
      } catch (e) {
        this.message = e.message;
      } finally {
        this.busy = false;
      }
    }
  },
  mounted() { this.load(1); },
  beforeUnmount() { this.setPreview(''); }
}).mount('#app');
