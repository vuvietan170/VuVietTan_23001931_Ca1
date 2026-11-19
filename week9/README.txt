BÀI THỰC HÀNH 9 — MVP PHP + VUE CDN

CÁCH CHẠY
1. Bật Apache và MySQL trong XAMPP.
2. Vào http://localhost/phpmyadmin, import week9/database.sql MỘT LẦN.
   Script tạo database riêng vue_products_week9 với 12 sản phẩm mẫu,
   không thay đổi database của week8.
3. Mở http://localhost/ptudweb/VuVietTan_23001931_Ca1/week9/
4. Nếu tài khoản MySQL khác root / mật khẩu trống, sửa api/common.php.
5. Đảm bảo Apache có quyền ghi thư mục week9/uploads.
   XAMPP Linux chạy Apache bằng daemon: từ thư mục gốc bài tập, chạy
   setfacl -m u:daemon:rwx week9/uploads
   Máy hiện tại đã được cấp quyền này và đã thử upload thành công.
   PHP cần bật pdo_mysql và fileinfo; upload_max_filesize >= 2M,
   post_max_size >= 3M. Vue CDN cần Internet. Không mở bằng file://.

CHỨC NĂNG
- Thêm, sửa, xóa sản phẩm qua JSON api/products.php.
- Ảnh không bắt buộc; xem trước JPG/JPEG/PNG, tối đa 2 MB.
- Upload riêng bằng FormData (id, image) tới api/upload.php sau khi lưu.
- PHP kiểm tra dung lượng và MIME/nội dung ảnh, tạo tên ngẫu nhiên.
- Upload lỗi: giữ thông tin đã lưu và ảnh cũ, bấm Thử lại upload;
  có thể chọn lại ảnh hoặc Đóng để tiếp tục. Thử lại không thêm trùng sản phẩm.
- GET api/products.php?page=1&limit=5 phân trang ở PHP, id giảm dần.
- Trang vượt giới hạn tự về trang cuối; danh sách rỗng ở trang 1/1.
- File ảnh cũ được giữ trong uploads khi thay ảnh hoặc xóa sản phẩm.

KIỂM TRA THỦ CÔNG
- 12 sản phẩm mẫu: ba trang lần lượt 5, 5, 2 sản phẩm.
- Thêm kèm PNG: về trang 1, hiển thị ảnh thu nhỏ.
- Sửa không chọn ảnh: giữ ảnh hiện tại.
- Chọn file sai loại hoặc lớn hơn 2 MB: Vue báo lỗi.
- Gửi trực tiếp file giả ảnh hoặc lớn hơn 2 MB tới API: PHP từ chối.
- Làm upload thất bại: thông tin vẫn lưu, ảnh cũ vẫn còn; thử lại được.
- Xóa hết sản phẩm trên trang cuối: tự về trang hợp lệ.
- Xóa hết danh sách: tổng 0, trang 1/1, khóa Trước/Sau.
- Gọi ?page=0, ?page=abc hoặc ?limit=10: success=false.
