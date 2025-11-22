# Hướng dẫn cấu hình file .env

## Copy nội dung sau vào file .env của bạn:

```env
APP_NAME="Hospital Management"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_db
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@hospital.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# VNPay Configuration
VNPAY_TMN_CODE=your_tmn_code_here
VNPAY_HASH_SECRET=your_hash_secret_here
VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
VNPAY_RETURN_URL=http://localhost:8000/vnpay/return

# Zalo contact for refund
ZALO_CONTACT=09xxxxx
```

---

## Hướng dẫn chi tiết từng phần:

### 1. DATABASE (MySQL)

**Cần sửa:**
- `DB_DATABASE`: Tên database (tạo database này trước trong MySQL)
- `DB_USERNAME`: Username MySQL của bạn
- `DB_PASSWORD`: Password MySQL (để trống nếu không có)

**Ví dụ:**
```env
DB_DATABASE=hospital_db
DB_USERNAME=root
DB_PASSWORD=
```

**Lưu ý:**
- Tạo database trước: `CREATE DATABASE hospital_db;`
- XAMPP/WAMP: thường username là `root`, password để trống
- Laragon: có thể cần password

---

### 2. VNPAY CONFIGURATION

**Cách lấy thông tin VNPay:**

1. **Đăng ký tài khoản:**
   - Test: https://sandbox.vnpayment.vn/
   - Production: https://www.vnpayment.vn/

2. **Lấy thông tin từ merchant account:**
   - `VNPAY_TMN_CODE`: Mã Terminal ID (ví dụ: `2QXUI4J4`)
   - `VNPAY_HASH_SECRET`: Secret Key (ví dụ: `RAOCTRKLRXJDMDHHFKGKADZXVNMEHODN`)

**Cần sửa:**
```env
VNPAY_TMN_CODE=YOUR_TMN_CODE_HERE
VNPAY_HASH_SECRET=YOUR_SECRET_KEY_HERE
VNPAY_RETURN_URL=http://localhost:8000/vnpay/return
```

**Lưu ý:**
- Môi trường test: dùng `sandbox.vnpayment.vn`
- Môi trường production: dùng `www.vnpayment.vn`
- `VNPAY_RETURN_URL` phải khớp với URL đã đăng ký trong VNPay

---

### 3. MAIL CONFIGURATION

#### Option 1: Gmail (Khuyến nghị cho test)

**Cần sửa:**
```env
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
```

**Cách lấy App Password Gmail:**
1. Vào Google Account → Security
2. Bật 2-Step Verification
3. Tạo App Password cho "Mail"
4. Copy password 16 ký tự vào `MAIL_PASSWORD`

#### Option 2: Mailtrap (Cho development)

```env
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
```

Đăng ký tại: https://mailtrap.io/

#### Option 3: SMTP Server khác

```env
MAIL_HOST=smtp.your-domain.com
MAIL_PORT=587
MAIL_USERNAME=noreply@your-domain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

---

### 4. APP CONFIGURATION

**Cần sửa:**
```env
APP_URL=http://localhost:8000
```

**Sau khi tạo file .env, chạy lệnh:**
```bash
php artisan key:generate
```
Lệnh này sẽ tự động tạo `APP_KEY` cho bạn.

---

### 5. ZALO CONTACT

**Cần sửa:**
```env
ZALO_CONTACT=09xxxxx
```

Số Zalo này sẽ được hiển thị trong email hoàn tiền khi bệnh nhân hủy lịch đã thanh toán.

---

## Các bước thực hiện:

1. **Tạo file .env:**
   ```bash
   cp .env.example .env
   ```
   Hoặc tạo file `.env` mới và copy nội dung ở trên vào.

2. **Sửa các thông tin trong file .env:**
   - Database credentials
   - VNPay credentials
   - Mail credentials
   - Zalo contact

3. **Tạo APP_KEY:**
   ```bash
   php artisan key:generate
   ```

4. **Tạo database:**
   ```sql
   CREATE DATABASE hospital_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

5. **Chạy migrations:**
   ```bash
   php artisan migrate
   ```

6. **Tạo storage link:**
   ```bash
   php artisan storage:link
   ```

7. **Tạo admin user (optional):**
   ```bash
   php artisan db:seed
   ```
   Hoặc tạo thủ công:
   - Email: `admin@hospital.com`
   - Password: `password`

---

## Kiểm tra cấu hình:

- **Database:** `php artisan migrate:status`
- **Mail:** Test gửi email từ hệ thống
- **VNPay:** Test thanh toán (sandbox)

