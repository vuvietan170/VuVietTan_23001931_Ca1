BÀI THỰC HÀNH 8 - PHP + VUE CDN (KHÔNG VITE)

1. Copy thư mục vue_php_mvp vào /opt/lampp/htdocs/ (Linux XAMPP), hoặc htdocs/ (Windows XAMPP).
2. Bật Apache và MySQL trong XAMPP.
3. Vào http://localhost/phpmyadmin, chọn Import và nhập database.sql (chạy một lần).
4. Mở http://localhost/vue_php_mvp/

Nếu MySQL có tài khoản/mật khẩu khác root / trống, sửa trong api/products.php.
Vue CDN cần kết nối Internet ở lần tải trang. Không mở index.html trực tiếp bằng file://.

TEST:
- Thêm sản phẩm, F5: vẫn tồn tại.
- Sửa đơn giá: bảng đổi.
- Xóa, F5: không còn.
- Dùng Postman gửi POST http://localhost/vue_php_mvp/api/products.php với JSON:
  {"name":"Bút thử","price":5000,"stock":-1}
  Kết quả: success:false và không có bản ghi mới.
