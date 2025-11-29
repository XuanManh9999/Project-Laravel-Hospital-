# Hệ thống Quản lý Bệnh viện

Hệ thống quản lý lịch hẹn, bác sĩ và dịch vụ cho bệnh viện/phòng khám.

## Tính năng

### Admin

- Quản lý tài khoản (tạo tài khoản bác sĩ, tiếp viên)
- CRUD dịch vụ
- CRUD bài viết
- Chấp nhận/từ chối/xóa lịch hẹn
- Xóa/sửa tài khoản bệnh nhân
- Quản lý thanh toán (lọc, tìm kiếm, cập nhật trạng thái)
- Quản lý hoàn tiền

### Bác sĩ

- Xem và chỉnh sửa thông tin cá nhân
- Xem danh sách lịch hẹn
- Chấp nhận hoặc từ chối lịch hẹn
- Xem lịch sử các buổi hẹn

### Tiếp viên

- Xem và chỉnh sửa thông tin cá nhân
- Xem danh sách lịch hẹn của phòng khám

### Bệnh nhân

- Đăng ký, đăng nhập tài khoản
- Xem và chỉnh sửa thông tin cá nhân
- Xem thông tin các bác sĩ
- Đặt lịch hẹn (tối thiểu 3 ngày, tối đa 2 tuần)
- Thanh toán VNPay
- Xem lịch sử các buổi hẹn
- Nhận email khi lịch hẹn được chấp nhận/từ chối
- Nhận email về hoàn tiền khi hủy lịch đã thanh toán

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

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_db
DB_USERNAME=root
DB_PASSWORD=
```

4. Cấu hình VNPay trong .env:

```
VNPAY_TMN_CODE=your_tmn_code
VNPAY_HASH_SECRET=your_hash_secret
VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
VNPAY_RETURN_URL=http://localhost/vnpay/return
```

5. Chạy migrations và seed dữ liệu mẫu:

```bash
php artisan migrate
php artisan db:seed
```

6. Tạo storage link (nếu cần):

```bash
php artisan storage:link
```

7. Build assets:

```bash
npm install
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

```
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

- Đặt lịch hẹn: Tối thiểu 3 ngày, tối đa 2 tuần trước
- Email notifications cần cấu hình mail server trong .env
- VNPay cần cấu hình đúng thông tin merchant
