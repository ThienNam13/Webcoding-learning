# KFJoli - Website Đặt Đồ Ăn Trực Tuyến

## Giới thiệu
KFJoli là hệ thống website đặt đồ ăn trực tuyến được xây dựng trong môn học Lập Trình Web.  
Dự án hỗ trợ người dùng xem thực đơn, thêm món vào giỏ hàng, đặt món và theo dõi đơn hàng trực tuyến.  
Hệ thống cũng cung cấp trang quản trị dành cho admin để quản lý món ăn, đơn hàng và tài khoản người dùng.

---

## Mục tiêu dự án
- Xây dựng website đặt món ăn đơn giản, dễ sử dụng
- Hỗ trợ quản lý đơn hàng hiệu quả
- Áp dụng kiến thức lập trình web vào thực tế
- Rèn luyện kỹ năng làm việc nhóm và thiết kế hệ thống

---

## Chức năng chính

### Người dùng
- Đăng ký / Đăng nhập tài khoản
- Xem danh sách món ăn
- Tìm kiếm món ăn
- Xem chi tiết món ăn
- Thêm / xóa món khỏi giỏ hàng
- Đặt món và thanh toán
- Xem lịch sử đơn hàng
- Theo dõi trạng thái đơn hàng

### Quản trị viên (Admin)
- Quản lý món ăn
  - Thêm / sửa / cập nhật trạng thái món ăn
- Quản lý đơn hàng
  - Xem chi tiết đơn hàng
  - Cập nhật trạng thái đơn hàng
  - Lọc đơn theo ngày và trạng thái
- Quản lý người dùng
  - Xem danh sách tài khoản
  - Phân quyền người dùng
  - Khóa / mở khóa tài khoản

---

## Công nghệ sử dụng

### Frontend
- HTML
- CSS
- JavaScript
- AJAX
- Cookie

### Backend
- PHP thuần
- MySQL
- PHP Session

### Công cụ khác
- XAMPP
- phpMyAdmin

---

## Cơ sở dữ liệu

Hệ thống sử dụng MySQL với các bảng chính:

| Bảng | Chức năng |
|------|------------|
| users | Lưu thông tin người dùng |
| foods | Lưu danh sách món ăn |
| orders | Lưu thông tin đơn hàng |
| order_items | Lưu chi tiết từng món trong đơn hàng |

### Quan hệ giữa các bảng
- Một người dùng có thể có nhiều đơn hàng
- Một đơn hàng có thể chứa nhiều món ăn
- Một món ăn có thể xuất hiện trong nhiều đơn hàng

---

## Cách hoạt động của hệ thống

1. Người dùng đăng ký hoặc đăng nhập
2. Xem thực đơn và chọn món ăn
3. Thêm món vào giỏ hàng
4. Nhập thông tin giao hàng và đặt món
5. Hệ thống lưu dữ liệu đơn hàng vào database
6. Admin quản lý và cập nhật trạng thái đơn hàng

---

## Tính năng Cookie

Website sử dụng cookie để:
- Lưu món ăn đã xem gần đây
- Hỗ trợ trải nghiệm người dùng
- Lưu tối đa 10 món ăn gần nhất
- Tự động xóa khi đăng xuất

Cookie sử dụng:
```txt
recentViewedItems
```

---

## Giao diện hệ thống
- Trang chủ
- Đăng ký / Đăng nhập
- Thực đơn món ăn
- Giỏ hàng
- Thanh toán
- Lịch sử đơn hàng
- Trang quản trị Admin

---

## Cài đặt và chạy dự án

### Yêu cầu
- XAMPP
- PHP
- MySQL

### Các bước chạy project

1. Clone project:
```bash
git clone <repository-url>
```

2. Copy project vào thư mục:
```txt
htdocs/
```

3. Khởi động:
- Apache
- MySQL

4. Import database bằng phpMyAdmin

5. Truy cập:
```txt
http://localhost/project-name
```

---

## Ưu điểm
- Giao diện trực quan, dễ sử dụng
- Quản lý đơn hàng rõ ràng
- Phân quyền người dùng và admin
- Tốc độ xử lý ổn định
- Có chức năng lưu món đã xem bằng cookie

---

## Hạn chế
- Chưa tối ưu tốt cho mobile
- Chưa có đánh giá món ăn
- Chưa hỗ trợ email xác nhận đơn hàng
- Chưa hỗ trợ đăng nhập Google/Facebook

---

## Hướng phát triển
- Responsive cho thiết bị di động
- Đăng nhập Google/Facebook
- Đánh giá món ăn
- Gửi email xác nhận đơn hàng
- Quản lý thông tin tài khoản người dùng

---

## Thành viên thực hiện
- Nguyễn Thị Nhật Linh
- Nguyễn Thiên Nam
- Trương Dư Hoài
- Nguyễn Thị Thảo Nhi
- Nguyễn Lê Hương Giang

---

## Thông tin môn học
- Môn học: Lập Trình Web
- Giảng viên hướng dẫn: ThS. Trần Anh Quân
- Trường Đại học Giao thông Vận tải TP.HCM
