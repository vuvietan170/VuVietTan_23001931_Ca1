CREATE DATABASE IF NOT EXISTS vue_products_week9 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE vue_products_week9;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    stock INT NOT NULL,
    image VARCHAR(255) NULL
);

-- Import một lần để có đúng 12 sản phẩm mẫu.
INSERT INTO products (name, price, stock) VALUES
('Bút bi', 5000, 20),
('Vở ô ly', 12000, 15),
('Thước kẻ', 8000, 0),
('Bút chì', 4000, 30),
('Tẩy', 3000, 25),
('Hộp bút', 35000, 10),
('Balo', 250000, 8),
('Sổ tay', 20000, 16),
('Bút màu', 45000, 12),
('Giấy A4', 75000, 9),
('Kéo', 15000, 18),
('Keo dán', 10000, 22);
