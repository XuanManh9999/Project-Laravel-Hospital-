# Hệ thống Quản lý Bệnh viện

Hệ thống quản lý lịch hẹn, bác sĩ và dịch vụ cho bệnh viện/phòng khám.

## Tính năng

### Công khai (Dành cho khách truy cập)

- Xem danh sách dịch vụ y tế của bệnh viện
- Xem danh sách và thông tin các bác sĩ chuyên khoa
- Đọc các bài viết, tin tức y khoa và chia sẻ sức khỏe

### Admin (Quản trị viên)

- Quản lý tài khoản (tạo tài khoản bác sĩ, tiếp viên, chỉnh sửa/xóa tài khoản bệnh nhân)
- Quản lý dịch vụ khám bệnh (CRUD)
- Quản lý bài viết, tin tức y khoa (CRUD)
- Phê duyệt (chấp nhận/từ chối/xóa) lịch hẹn khám của bệnh nhân
- Quản lý các giao dịch thanh toán (lọc, tìm kiếm, cập nhật trạng thái)
- Quản lý và xử lý các yêu cầu hoàn tiền cho bệnh nhân

### Bác sĩ

- Xem và chỉnh sửa thông tin hồ sơ cá nhân
- Xem danh sách các lịch hẹn khám được phân công
- Chấp nhận hoặc từ chối lịch hẹn của bệnh nhân
- Thực hiện quy trình khám bệnh (Bắt đầu khám, Hoàn thành khám)
- Xem lịch sử chi tiết các buổi hẹn khám đã thực hiện

### Tiếp viên (Lễ tân)

- Xem và chỉnh sửa thông tin hồ sơ cá nhân
- Xem danh sách và chi tiết toàn bộ lịch hẹn của phòng khám để hỗ trợ điều phối bệnh nhân tại quầy

### Bệnh nhân

- Đăng ký và đăng nhập tài khoản bệnh nhân
- Xem và chỉnh sửa thông tin hồ sơ cá nhân
- Xem thông tin chi tiết các bác sĩ và đặt lịch hẹn khám
- Đặt lịch hẹn trực tuyến (yêu cầu đặt trước tối thiểu 3 ngày, tối đa 2 tuần)
- Hủy lịch hẹn đã đặt và gửi yêu cầu hoàn tiền (nếu đã thanh toán trước)
- Thanh toán trực tuyến nhanh chóng, bảo mật qua cổng VNPay
- Theo dõi chi tiết lịch sử và trạng thái các buổi hẹn khám
- Nhận email thông báo tự động khi lịch hẹn được chấp nhận/từ chối hoặc khi được duyệt hoàn tiền thành công

## Cài đặt

1. Cài đặt dependencies:

```bash
composer install
npm install
```

2. Copy file .env.example thành .env và cấu hình:

```bash
cp .env.example .env
# Hoặc trên Windows:
copy .env.example .env
php artisan key:generate
```

3. Cấu hình database trong .env:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_db
DB_USERNAME=root
DB_PASSWORD=
```

4. Cấu hình VNPay trong .env:

```env
VNPAY_TMN_CODE=your_tmn_code
VNPAY_HASH_SECRET=your_hash_secret
VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
VNPAY_RETURN_URL=http://localhost:8000/vnpay/return
```

5. Chạy migrations và seed dữ liệu mẫu:

```bash
php artisan migrate
php artisan db:seed
```

6. Tạo storage link để hiển thị ảnh:

```bash
php artisan storage:link
```

7. Build assets:

```bash
npm run build
```

8. Chạy server:

```bash
php artisan serve
```

Hoặc với host và port cụ thể:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

## Khắc phục lỗi 419 (Page Expired)

- Đảm bảo các biến trong `.env` trỏ đúng domain bạn đang truy cập, ví dụ:

```env
APP_URL=http://127.0.0.1:8000
SESSION_DOMAIN=127.0.0.1
SESSION_SECURE_COOKIE=false
```

- Sau khi chỉnh `.env`, chạy:

```bash
php artisan config:clear
php artisan cache:clear
```

- Khởi động lại server (`php artisan serve`) và làm mới trang đăng nhập. Nếu trình duyệt vẫn giữ phiên cũ, hãy xóa cookie cho `127.0.0.1`.

## Cấu trúc Database

- users: Tài khoản người dùng (admin, doctor, receptionist, patient)
- doctors: Thông tin bác sĩ
- patients: Thông tin bệnh nhân
- receptionists: Thông tin tiếp viên
- services: Dịch vụ
- posts: Bài viết
- appointments: Lịch hẹn
- payments: Thanh toán
- refunds: Hoàn tiền

## Lưu ý

- Đặt lịch hẹn: Tối thiểu 3 ngày, tối đa 2 tuần trước.
- Email notifications cần cấu hình mail server trong .env.
- VNPay cần cấu hình đúng thông tin merchant Sandbox hoặc Live.

