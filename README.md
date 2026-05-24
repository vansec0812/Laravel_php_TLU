# Tổng Hợp Dự Án Phát Triển Web - Laravel & Angular

Repository này tổng hợp các dự án học tập, thực hành và kiểm tra về phát triển ứng dụng Web, chủ yếu sử dụng các công nghệ **PHP/Laravel (Backend/RESTful API/MVC)** và **Angular (Frontend SPA)**.

---

## 📂 Danh Sách Các Dự Án Trong Repository

| Tên Thư Mục | Công Nghệ Chính | Mô Tả Dự Án | Trạng Thái / Ghi Chú |
| :--- | :--- | :--- | :--- |
| **[testAI](./testAI)** | Angular 21, Vanilla CSS | Ứng dụng Single Page App quản lý hồ sơ Học sinh - Sinh viên phường Kim Liên kết hợp Todo List công việc của cán bộ phường. Hỗ trợ xuất báo cáo Excel CSV/JSON, lưu trữ LocalStorage, đổi giao diện Sáng/Tối. | Đã hoàn thành |
| **[projectQLSV](./projectQLSV)** | PHP, Laravel | Hệ thống quản lý thông tin sinh viên (Quản lý sinh viên - QLSV). | Dự án thực hành |
| **[projectQLNV](./projectQLNV)** | PHP, Laravel | Hệ thống quản lý thông tin nhân viên trong doanh nghiệp (QLNV). | Dự án thực hành |
| **[RESFulAPI](./RESFulAPI)** | Laravel API | Xây dựng hệ thống các dịch vụ RESTful API cấp dữ liệu cho phía Client. | Dự án thực hành |
| **[project2MVC](./project2MVC)** | PHP thuần | Dự án thực hành xây dựng ứng dụng web theo mô hình kiến trúc Model-View-Controller (MVC) chuẩn. | Học phần kiến trúc |
| **[projectQLVL](./projectQLVL)** | PHP, Laravel | Dự án quản lý thông tin việc làm / vật liệu. | Dự án thực hành |
| **[projectQLTL1](./projectQLTL1)** | PHP, Laravel | Dự án quản lý tài liệu / tài liệu học tập (Phiên bản 1). | Thực hành nhóm/cá nhân |
| **[projectQLTL2](./projectQLTL2)** | PHP, Laravel | Dự án quản lý tài liệu / tài liệu học tập (Phiên bản 2). | Thực hành nhóm/cá nhân |
| **[projectKiemTra](./projectKiemTra)** | PHP, Laravel | Dự án làm bài kiểm tra thực hành học phần. | Bài kiểm tra |
| **[projectFirst](./projectFirst)** | PHP, Laravel | Dự án đầu tiên để tiếp cận cấu trúc và luồng dữ liệu của Laravel. | Dự án làm quen |

---

## ⚙️ Hướng Dẫn Khởi Chạy

### 1. Đối với các dự án PHP / Laravel (Backend)
Hầu hết các thư mục dự án Laravel đều yêu cầu các bước cài đặt chuẩn sau:

1. **Di chuyển vào thư mục dự án**:
   ```bash
   cd <ten-thu-muc-du-an>
   ```
2. **Cài đặt các gói phụ thuộc (Composer)**:
   ```bash
   composer install
   ```
3. **Cấu hình môi trường**:
   * Sao chép file cấu hình mẫu `.env.example` thành `.env`:
     ```bash
     cp .env.example .env
     ```
   * Cập nhật thông tin kết nối Cơ sở dữ liệu (Database Name, Username, Password) trong file `.env` vừa tạo phù hợp với MySQL của bạn (ví dụ sử dụng XAMPP hoặc Laragon).
4. **Tạo mã khóa bảo mật ứng dụng**:
   ```bash
   php artisan key:generate
   ```
5. **Chạy Migration & Seeder để khởi tạo bảng và dữ liệu mẫu**:
   ```bash
   php artisan migrate --seed
   ```
6. **Khởi chạy Server phát triển**:
   ```bash
   php artisan serve
   ```
   *Ứng dụng thường sẽ chạy tại địa chỉ: `http://127.0.0.1:8000`*

### 2. Đối với dự án Angular Frontend ([testAI](./testAI))
1. **Di chuyển vào thư mục dự án**:
   ```bash
   cd testAI
   ```
2. **Cài đặt các gói phụ thuộc (npm)**:
   ```bash
   npm install
   ```
3. **Chạy ứng dụng chế độ Development**:
   ```bash
   npm run start
   ```
   *Mở trình duyệt và truy cập: `http://localhost:4200`*

---

## 🛠️ Yêu Cầu Hệ Thống Khuyên Dùng

* **PHP**: Phiên bản `>= 8.1`
* **Composer**: Phiên bản `>= 2.0`
* **Node.js**: Phiên bản `>= 18.0.0`
* **NPM**: Phiên bản `>= 9.0.0`
* **Hệ quản trị CSDL**: MySQL/MariaDB (khuyên dùng qua Laragon hoặc XAMPP)
* **IDE**: Visual Studio Code với các tiện ích mở rộng hỗ trợ PHP, Laravel Blade và Angular.
