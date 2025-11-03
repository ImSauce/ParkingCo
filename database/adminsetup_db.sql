-- Run this SQL to set up admin tables

-- Create admins table
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin (username: admin, password: admin123)
INSERT INTO `admins` (`username`, `password`, `full_name`, `email`) VALUES
('Admin', '$2y$10$eD7VPbxR5cW0Z9kJY8nQf.Xhc9C1F3eKjL7aP5nBwD6zR2xT8vH4G', 'System Administrator', 'admin@parkingco.com');

-- Create users table for customer accounts
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample users
INSERT INTO `users` (`username`, `email`, `password`, `full_name`, `phone`, `status`) VALUES
('john_Boy', 'johnnyBoy@example.com', 'NigherKa', 'Johnny Boy', '09123456789', 'active'),
('Bitoy_pera', 'bitoy@example.com', 'Nigher', 'Pepito Manaloto', '09187654321', 'active');

-- Create products table
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample products
INSERT INTO `products` (`product_name`, `description`, `price`, `stock`, `category`) VALUES
('Monthly Parking Pass', 'Unlimited parking access for 30 days', 2500.00, 50, 'Passes'),
('Premium Car Wash', 'Full interior and exterior cleaning', 500.00, 100, 'Services'),
('Valet Service', 'Professional valet parking service', 200.00, 30, 'Services');

-- Note: Password for default admin and sample users is 'admin123'