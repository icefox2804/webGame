# 🎮 WebGame - Website Bán Game Trực Tuyến

## 📋 Giới Thiệu

WebGame là một nền tảng thương mại điện tử chuyên về bán game . Website được xây dựng bằng Laravel Framework 10, cung cấp trải nghiệm mua sắm trực tuyến hiện đại, mượt mà và đầy đủ tính năng cho cả người dùng và quản trị viên.

## ✨ Tính Năng Hiện Có

### 🌐 Phía Người Dùng (Frontend)

#### 🏠 **Trang Chủ & Hiển Thị Sản Phẩm**
- Giao diện hiện đại, responsive
- Hiển thị danh sách sản phẩm game theo danh mục
- Tìm kiếm và lọc sản phẩm
- Xem chi tiết sản phẩm (mô tả, giá, hình ảnh, video)

#### 🛒 **Giỏ Hàng & Thanh Toán**
- Thêm sản phẩm vào giỏ hàng
- Mua ngay (Buy Now) - chuyển thẳng đến trang thanh toán
- Cập nhật số lượng sản phẩm trong giỏ
- Xóa sản phẩm khỏi giỏ hàng
- Xóa toàn bộ giỏ hàng
- Hiển thị số lượng sản phẩm trong giỏ (real-time)
- Trang checkout với form thông tin đầy đủ
- Xác nhận đơn hàng thành công

#### 📦 **Quản Lý Đơn Hàng**
- Theo dõi trạng thái đơn hàng
- Lịch sử mua hàng
- Chi tiết đơn hàng


#### 🔐 **Xác Thực Người Dùng**
- Đăng ký tài khoản mới
- Đăng nhập/Đăng xuất
- Quản lý thông tin cá nhân

### 👨‍💼 Phía Quản Trị (Admin Panel)

#### 📊 **Dashboard**

- Số lượng sản phẩm
- Sản phẩm bán chạy
- Biểu đồ thống kê

#### 📁 **Quản Lý Danh Mục**
- Thêm/Sửa/Xóa danh mục
- Soft delete (xóa mềm)
- Khôi phục danh mục đã xóa
- Xóa vĩnh viễn

#### 🎮 **Quản Lý Sản Phẩm**
- Thêm sản phẩm mới (tên, mô tả, giá, hình ảnh, video)
- Chỉnh sửa thông tin sản phẩm
- Xóa sản phẩm (soft delete)
- Khôi phục sản phẩm đã xóa
- Xóa vĩnh viễn
- Quản lý tồn kho (stock)
- Upload hình ảnh và video sản phẩm

#### 📧 **Quản Lý Liên Hệ**
- Xem danh sách liên hệ từ khách hàng
- Xem chi tiết tin nhắn
- Xóa tin nhắn (soft delete)
- Khôi phục và xóa vĩnh viễn

#### 🗑️ **Thùng Rác (Trash)**
- Dashboard tổng hợp các mục đã xóa
- Khôi phục hoặc xóa vĩnh viễn
- Áp dụng cho: Products, Categories, Contacts, Users


#### 🔒 **Xác Thực Admin**
- Đăng nhập admin riêng biệt
- Phân quyền theo role
- Bảo mật cao với middleware

## 🛠️ Công Nghệ Sử Dụng

### Backend
- **Framework:** Laravel 10.x
- **PHP:** ^8.1
- **Database:** MySQL/MariaDB
- **Authentication:** Laravel Sanctum 3.3
- **ORM:** Eloquent
- **Email:** Laravel Mail với Queue support

### Frontend
- **Template Engine:** Blade
- **CSS Framework:** Bootstrap / TailwindCSS (tùy implementation)
- **JavaScript:** Vanilla JS / Alpine.js
- **Build Tool:** Vite 5.0
- **HTTP Client:** Axios 1.6.4

### Tools & Libraries
- **Guzzle HTTP:** ^7.2 - HTTP client
- **Laravel Tinker:** ^2.8 - REPL tool
- **Faker PHP:** ^1.9.1 - Generate fake data
- **PHPUnit:** ^10.1 - Testing
- **Laravel Pint:** ^1.0 - Code style
- **Spatie Laravel Ignition:** ^2.0 - Error page

### Development Tools
- **Concurrently:** ^9.2.1 - Chạy nhiều commands
- **Laravel Sail:** ^1.18 - Docker development environment
- **Composer:** Dependency management
- **NPM:** Package management

## 💻 Yêu Cầu Hệ Thống

### Yêu Cầu Bắt Buộc
- **PHP:** >= 8.1
- **Composer:** >= 2.0
- **Node.js:** >= 18.x
- **NPM:** >= 9.x
- **MySQL:** >= 5.7 hoặc **MariaDB:** >= 10.3
- **Web Server:** Apache 2.4+ hoặc Nginx 1.18+

### PHP Extensions Required
```
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- cURL PHP Extension
- GD Library (cho xử lý ảnh)
```

### Khuyến Nghị
- **RAM:** Tối thiểu 512MB, khuyến nghị 1GB+
- **Disk Space:** Tối thiểu 500MB
- **OS:** Windows 10/11, macOS, hoặc Linux (Ubuntu 20.04+)

## 📥 Cài Đặt

### Bước 1: Clone Repository

```bash
# Clone project từ Git
git clone https://github.com/yourusername/webGame.git

# Di chuyển vào thư mục project
cd webGame
```

### Bước 2: Cài Đặt Dependencies

```bash
# Cài đặt PHP dependencies qua Composer
composer install

# Cài đặt Node.js dependencies
npm install
```

### Bước 3: Cấu Hình Environment

```bash
# Tạo file .env từ .env.example
copy .env.example .env
# Hoặc trên Linux/Mac:
# cp .env.example .env

# Generate application key
php artisan key:generate
```

### Bước 4: Cấu Hình Database

Mở file `.env` và cập nhật thông tin database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webgame
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Bước 5: Tạo Database

```bash
# Tạo database trong MySQL
mysql -u root -p
CREATE DATABASE webgame CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Bước 6: Chạy Migration và Seeder

```bash
# Chạy migrations để tạo bảng
php artisan migrate

# Chạy seeders để tạo dữ liệu mẫu
php artisan db:seed

# Hoặc chạy cả hai cùng lúc:
php artisan migrate:fresh --seed
```

**Lưu ý:** Seeder sẽ tạo tài khoản admin mặc định:
- **Email:** admin@example.com
- **Password:** password

### Bước 7: Tạo Storage Link

```bash
# Tạo symbolic link cho storage
php artisan storage:link
```

### Bước 8: Cấu Hình File Upload (Tùy chọn)

Đảm bảo thư mục có quyền ghi:

```bash
# Windows (PowerShell với quyền Admin)
icacls storage /grant Everyone:(OI)(CI)F /T
icacls bootstrap/cache /grant Everyone:(OI)(CI)F /T

# Linux/Mac
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## 🚀 Cách Chạy Ứng Dụng

### Môi Trường Development

#### Option 1: Chạy Riêng Lẻ

**Terminal 1 - Backend Server:**
```bash
php artisan serve
# Server sẽ chạy tại: http://127.0.0.1:8000
```

**Terminal 2 - Frontend Build:**
```bash
npm run dev
# Vite dev server sẽ chạy tại: http://127.0.0.1:5173
```

#### Option 2: Chạy Cùng Lúc (Khuyến Nghị)

```bash
npm run dev-all
# Chạy đồng thời cả Laravel server và Vite
```

### Truy Cập Website

- **Frontend (User):** http://127.0.0.1:8000
- **Admin Panel:** http://127.0.0.1:8000/admin/login
- **Login Admin:**
  - Email: admin@gmail.com
  - Password: 123456

## 🗂️ Cấu Trúc Thư Mục Quan Trọng

```
webGame/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controllers cho routes
│   │   │   ├── Admin/          # Admin controllers
│   │   │   └── Auth/           # Authentication controllers
│   │   └── Middleware/         # Custom middleware
│   └── Models/                 # Eloquent models
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── public/
│   ├── images/                 # Hình ảnh sản phẩm
│   └── videos/                 # Video sản phẩm
├── resources/
│   ├── views/                  # Blade templates
│   │   ├── admin/              # Admin views
│   │   ├── pages/              # Frontend pages
│   │   └── layouts/            # Layout templates
│   ├── css/                    # Stylesheets
│   └── js/                     # JavaScript files
├── routes/
│   └── web.php                 # Web routes
├── storage/
│   └── app/public/             # User uploaded files
├── .env                        # Environment configuration
└── composer.json               # PHP dependencies
```

## 📚 Các Lệnh Artisan Hữu Ích

```bash
# Xóa cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Tạo cache cho production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate                    # Chạy migrations
php artisan migrate:rollback           # Rollback migration cuối
php artisan migrate:fresh              # Drop all tables và migrate lại
php artisan migrate:fresh --seed       # Migrate lại và seed data
php artisan db:seed                    # Chạy seeders

# Tạo file mới
php artisan make:controller ControllerName
php artisan make:model ModelName -m    # Với migration
php artisan make:migration migration_name
php artisan make:seeder SeederName

# Queue (nếu sử dụng)
php artisan queue:work                 # Chạy queue worker
```

## 🏗️ Build cho Production

```bash
# Build frontend assets
npm run build

# Optimize Laravel
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 🧪 Testing

```bash
# Chạy tất cả tests
php artisan test

# Hoặc dùng PHPUnit
vendor/bin/phpunit
```

## 🐛 Troubleshooting

### Lỗi: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Lỗi: "SQLSTATE[HY000] [1049] Unknown database"
- Đảm bảo bạn đã tạo database trong MySQL
- Kiểm tra thông tin database trong file `.env`

### Lỗi: "Class 'X' not found"
```bash
composer dump-autoload
```

### Lỗi: "The stream or file could not be opened"
```bash
# Windows
icacls storage /grant Everyone:(OI)(CI)F /T

# Linux/Mac
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Lỗi: "Vite manifest not found"
```bash
npm run build
# Hoặc đảm bảo npm run dev đang chạy
```

## 🔒 Bảo Mật

- Thay đổi tài khoản admin mặc định sau khi cài đặt
- Không commit file `.env` lên Git
- Sử dụng HTTPS trong môi trường production
- Cập nhật dependencies thường xuyên: `composer update` và `npm update`
- Cấu hình CORS hợp lý trong `config/cors.php`

## 📝 Tài Khoản Mặc Định

### Admin Account
- **Email:** admin@gmail.com
- **Password:** 123456
- **Role:** admin

### User Account (nếu có seed)
- **Email:** user@gmail.com
- **Password:** 123456
- **Role:** user

> ⚠️ **Lưu ý:** Hãy thay đổi các mật khẩu này ngay sau khi cài đặt!

## 🤝 Contributing

Nếu bạn muốn đóng góp cho project:

1. Fork repository
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

👨‍💻 Tác Giả

- Tên: Lê Tấn Bửu

- Vai trò: Fullstack Developer (Laravel / MySQL / Bootstrap / JS)

- Email: icefox2804@gmail.com

- GitHub: https://github.com/icefox2804



## 📄 License

Project này được phát hành dưới [MIT License](https://opensource.org/licenses/MIT).

## 📞 Liên Hệ & Hỗ Trợ

- **Email:** support@webgame.com
- **Website:** https://webgame.com
- **Issues:** https://github.com/yourusername/webGame/issues

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap/TailwindCSS
- Tất cả các open-source packages được sử dụng trong project

---

**Made with ❤️ by Lê Tấn Bửu**

*Cập nhật lần cuối: Tháng 10, 2025*
