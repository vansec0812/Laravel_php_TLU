# Hệ Thống Quản Lý Học Sinh - Sinh Viên Phường Kim Liên

Hệ thống được phát triển bằng **Angular 21** phục vụ nhu cầu quản lý thông tin cư trú, học tập và quản lý công việc (Todo List) liên quan đến đối tượng Học sinh & Sinh viên trên địa bàn **Phường Kim Liên, Quận Đống Đa, Hà Nội**.

---

## 🚀 Các Tính Năng Chính

### 1. Quản lý Hồ sơ Học sinh - Sinh viên (CRUD)
* **Thêm mới & Chỉnh sửa**: Quản lý thông tin chi tiết bao gồm:
  * Mã số định danh (Mã HS/SV)
  * Họ và tên, Ngày sinh, Giới tính
  * Phân loại (Sinh viên Đại học/Cao đẳng hoặc Học sinh Trung học)
  * Trường học đang theo học
  * Diện cư trú trên địa bàn phường (Thường trú hoặc Tạm trú tại các khu trọ, chung cư mini)
  * Thông tin liên lạc (Số điện thoại, Email)
  * Địa chỉ chi tiết cư trú trong phường (tổ dân phố, ngõ, số nhà, số phòng tập thể...)
* **Xóa hồ sơ**: Xóa tài liệu kèm hộp thoại xác nhận tùy chỉnh đẹp mắt tránh thao tác nhầm lẫn.
* **Tìm kiếm & Bộ lọc**: Tìm kiếm động tức thời theo tên, mã số, trường học, ngõ ngách kết hợp với các bộ lọc phân loại cấp học, diện cư trú và giới tính.

### 2. Quản lý Công việc Hỗ trợ & Xác minh (Todo List)
* Lên danh sách các nhiệm vụ hành chính liên quan như: Xác minh tạm trú, Phát học bổng khuyến học, Khảo sát dân cư, Kiểm tra nghĩa vụ quân sự...
* **Tích hợp liên kết**: Mỗi đầu việc có thể liên kết trực tiếp với hồ sơ của một học sinh/sinh viên cụ thể trong danh sách.
* Quản lý mức độ ưu tiên (Cao, Trung bình, Thấp) và cài đặt Hạn hoàn thành (Due Date).
* Đánh dấu hoàn thành trực tiếp bằng hộp kiểm nhanh với các hiệu ứng gạch ngang sinh động.
* Thanh theo dõi tiến độ công việc tổng quan theo dạng phần trăm (%).

### 3. Bảng Phân Tích & Thống Kê (Dashboard)
* Thẻ tóm tắt thông tin số lượng (Tổng số HS-SV, Sinh viên, Tạm trú, Tiến độ công việc).
* Thống kê trực quan tỉ lệ phân bố giữa học sinh và sinh viên.
* Thống kê diện tạm trú chiếm tỉ lệ bao nhiêu phần trăm trong địa bàn phường.
* Liệt kê danh sách top các Trường học phổ biến nhất có học sinh/sinh viên cư trú tại phường kèm theo thanh tỷ lệ phần trăm trực quan.
* Widget danh sách hồ sơ mới cập nhật gần đây giúp cán bộ nắm bắt thông tin nhanh chóng.

### 4. Tiện ích Xuất Báo Cáo
* **Xuất Excel (CSV)**: Tải xuống danh sách toàn bộ học sinh, sinh viên định dạng CSV hỗ trợ đầy đủ mã UTF-8 (mở trực tiếp trên Microsoft Excel không bị lỗi phông chữ tiếng Việt).
* **Xuất Báo Cáo Phường (JSON)**: Tải xuống bản sao lưu cấu trúc dữ liệu JSON để phục vụ lưu trữ hoặc tích hợp hệ thống quản lý dân cư của quận.

### 5. Giao diện Tối ưu Hóa (Vanilla CSS & UX)
* Hỗ trợ chuyển đổi nhanh **Giao diện Sáng (Light Theme)** và **Giao diện Tối (Dark Theme)** bằng nút chuyển đổi trực quan ở góc dưới màn hình.
* Hệ thống thông báo nổi (Toasts) mượt mà phản hồi các hành động CRUD thành công hoặc cảnh báo lỗi nhập liệu.
* Thiết kế đáp ứng (Responsive Layout) tương thích tốt trên cả màn hình máy tính để bàn (Desktop) và các thiết bị di động (Mobile).
* Trải nghiệm ứng dụng không cần tải lại trang (SPA) mượt mà, lưu trữ dữ liệu tự động vào **LocalStorage** của trình duyệt.

---

## 🛠️ Công Nghệ Sử Dụng

* **Core Framework**: Angular v21 (Standalone Components, Signals Reactivity API)
* **Forms**: Angular FormsModule (Hỗ trợ Two-way data binding)
* **Styling**: Vanilla CSS (CSS Variables, Flexbox, Grid, CSS Transitions/Animations)
* **Icons**: FontAwesome v6.4.0 (CDN)
* **Fonts**: Google Font 'Outfit'

---

## 📂 Cấu Trúc Thư Mục Quan Trọng

```text
testAI/
├── src/
│   ├── main.ts               # Điểm khởi chạy ứng dụng Angular
│   ├── index.html            # File HTML nền của ứng dụng, nạp Font và CSS ngoài
│   ├── styles.css            # Custom CSS hệ thống giao diện, hiệu ứng và Dark/Light mode
│   └── app/
│       ├── app.ts            # Component chính chứa logic điều khiển, Signals và CRUD actions
│       ├── app.component.html # Template HTML giao diện các Tabs, Modals và Toasts
│       ├── app.config.ts     # Cấu hình Providers cho ứng dụng
│       └── app.routes.ts     # Cấu hình tuyến đường đi (để trống vì dùng SPA Tab)
├── angular.json              # File cấu hình build của Angular CLI
├── package.json              # Quản lý thư viện phụ thuộc và scripts chạy
└── tsconfig.json             # Cấu hình TypeScript compiler
```

---

## ⚙️ Hướng Dẫn Cài Đặt & Chạy Ứng Dụng

### Yêu cầu hệ thống
Đảm bảo máy tính của bạn đã cài đặt **Node.js** (Khuyên dùng phiên bản `>= v18.0.0`) và **npm**.

### Bước 1: Di chuyển vào thư mục dự án
Mở terminal và di chuyển tới thư mục `testAI`:
```bash
cd testAI
```

### Bước 2: Cài đặt các thư viện phụ thuộc (Dependencies)
```bash
npm install
```

### Bước 3: Khởi chạy Server Phát Triển (Development Server)
```bash
npm run start
```
Ứng dụng sẽ được biên dịch và chạy local. Mở trình duyệt và truy cập địa chỉ:
👉 **[http://localhost:4200/](http://localhost:4200/)**

*Ứng dụng sẽ tự động tải lại (auto-reload) mỗi khi bạn lưu thay đổi trong các file mã nguồn.*

### Bước 4: Biên dịch Đóng gói Sản phẩm (Production Build)
Khi cần xuất bản phiên bản chạy thực tế, thực hiện lệnh:
```bash
npm run build
```
Các tệp tin sau khi tối ưu hóa sẽ được lưu trữ tại thư mục `dist/angular-app/browser`.
