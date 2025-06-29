CREATE DATABASE OrderingFoodDB;
USE OrderingFoodDB;

-- Bảng người dùng
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'user'
);

-- Bảng món ăn
CREATE TABLE foods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_mon VARCHAR(100) NOT NULL,
    mo_ta TEXT,
    gia DECIMAL(10,2) NOT NULL,
    hinh_anh VARCHAR(255),
    loai VARCHAR(50),
    is_available BOOLEAN DEFAULT TRUE
);

-- Bảng đơn hàng
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_don VARCHAR(20) UNIQUE,
    user_id INT,              
    ho_ten VARCHAR(100) NOT NULL,
    sdt VARCHAR(20) NOT NULL,
    dia_chi TEXT NOT NULL,
    khu_vuc VARCHAR(100) NOT NULL,
    tong_tien DECIMAL(10,2) NOT NULL,
    thoi_gian_dat DATETIME DEFAULT CURRENT_TIMESTAMP,
    trang_thai VARCHAR(50) DEFAULT 'Đang xử lý',
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Bảng chi tiết đơn hàng
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    food_id INT NOT NULL,
    so_luong INT NOT NULL,
    don_gia DECIMAL(10,2) NOT NULL,
    ghi_chu TEXT,
    FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY(food_id) REFERENCES foods(id)
);