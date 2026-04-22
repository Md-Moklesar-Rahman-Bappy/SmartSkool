-- Settings Table for School Management System
-- Run this SQL in phpMyAdmin or MySQL CLI

-- Create settings table
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert default values
INSERT INTO settings (setting_key, setting_value) VALUES 
('school_name', 'SmartSkool Management System'),
('email', 'info@smartskool.com'),
('phone', '+1 234 567 890'),
('address', '123 Education Street, City, Country'),
('website_url', 'http://localhost/sms')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);
