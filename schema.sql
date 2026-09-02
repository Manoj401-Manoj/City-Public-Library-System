-- Create and use database
CREATE DATABASE IF NOT EXISTS library_section_system;
USE library_section_system;

-- ============================================
-- CREATE ALL TABLES
-- ============================================

-- Users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id VARCHAR(50) UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    department VARCHAR(100),
    role ENUM('admin', 'student') DEFAULT 'student',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Libraries table
CREATE TABLE IF NOT EXISTS libraries (
    library_id INT PRIMARY KEY AUTO_INCREMENT,
    library_name VARCHAR(100) NOT NULL,
    library_code VARCHAR(20) UNIQUE,
    address TEXT NOT NULL,
    area VARCHAR(50),
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    total_seats INT DEFAULT 0,
    open_time TIME DEFAULT '09:00:00',
    close_time TIME DEFAULT '20:00:00',
    phone VARCHAR(20),
    email VARCHAR(100),
    facilities TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seats table
CREATE TABLE IF NOT EXISTS seats (
    seat_id INT PRIMARY KEY AUTO_INCREMENT,
    library_id INT NOT NULL,
    seat_number VARCHAR(20) NOT NULL,
    seat_type ENUM('regular', 'premium', 'computer', 'group') DEFAULT 'regular',
    floor INT DEFAULT 1,
    status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
    price_per_hour DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (library_id) REFERENCES libraries(library_id) ON DELETE CASCADE,
    UNIQUE KEY unique_library_seat (library_id, seat_number)
);

-- Bookings table
CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_code VARCHAR(50) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    seat_id INT NOT NULL,
    library_id INT NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    booking_status ENUM('confirmed', 'cancelled', 'completed') DEFAULT 'confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (seat_id) REFERENCES seats(seat_id) ON DELETE CASCADE,
    FOREIGN KEY (library_id) REFERENCES libraries(library_id) ON DELETE CASCADE
);

-- Attendance table
CREATE TABLE IF NOT EXISTS attendance (
    attendance_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    check_in_time TIME,
    check_out_time TIME,
    status ENUM('present', 'absent', 'late') DEFAULT 'absent',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_date (user_id, date)
);

-- Reviews table
CREATE TABLE IF NOT EXISTS reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    library_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (library_id) REFERENCES libraries(library_id) ON DELETE CASCADE
);

-- ============================================
-- INSERT SAMPLE DATA
-- ============================================

-- Insert Admin (Password: admin123)
INSERT INTO users (student_id, full_name, email, password_hash, phone, department, role) VALUES
('ADMIN001', 'Library Admin', 'admin@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9444000000', 'Administration', 'admin');

-- Insert Student (Password: student123)
INSERT INTO users (student_id, full_name, email, password_hash, phone, department, role) VALUES
('STU001', 'Rajesh Kumar', 'student@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543210', 'Engineering', 'student');

-- Insert Chennai Libraries
INSERT INTO libraries (library_name, library_code, address, area, latitude, longitude, total_seats, open_time, close_time, phone, email) VALUES
('Anna Centenary Library', 'ACL001', 'Kotturpuram, Chennai - 600085', 'Kotturpuram', 13.0109, 80.2456, 50, '08:00:00', '20:00:00', '044-24480000', 'anna@library.com'),
('Connemara Public Library', 'CPL002', 'Pantheon Road, Egmore, Chennai - 600008', 'Egmore', 13.0724, 80.2607, 40, '09:00:00', '18:00:00', '044-28193751', 'connemara@library.com'),
('British Council Library', 'BCL004', '737, Anna Salai, Chennai - 600002', 'Anna Salai', 13.0827, 80.2707, 30, '10:00:00', '18:00:00', '044-42050600', 'british@library.com'),
('IIT Madras Library', 'IIT008', 'IIT Madras, Sardar Patel Road, Chennai - 600036', 'Adyar', 12.9916, 80.2335, 60, '08:00:00', '22:00:00', '044-22578000', 'iit@library.com');

-- Insert seats for Anna Library
INSERT INTO seats (library_id, seat_number, seat_type, status) VALUES
(1, 'A01', 'regular', 'available'), (1, 'A02', 'regular', 'available'), (1, 'A03', 'premium', 'occupied'), (1, 'A04', 'regular', 'available'), (1, 'A05', 'computer', 'available'),
(1, 'B01', 'regular', 'available'), (1, 'B02', 'premium', 'available'), (1, 'B03', 'regular', 'available'), (1, 'B04', 'group', 'available'), (1, 'B05', 'computer', 'available');

-- Insert seats for Connemara Library
INSERT INTO seats (library_id, seat_number, seat_type, status) VALUES
(2, 'C01', 'regular', 'available'), (2, 'C02', 'regular', 'available'), (2, 'C03', 'premium', 'available'), (2, 'C04', 'regular', 'available'), (2, 'C05', 'computer', 'occupied');

-- Insert seats for British Council
INSERT INTO seats (library_id, seat_number, seat_type, status) VALUES
(3, 'B01', 'regular', 'available'), (3, 'B02', 'premium', 'available'), (3, 'B03', 'computer', 'available'), (3, 'B04', 'regular', 'available'), (3, 'B05', 'regular', 'available');

-- Insert seats for IIT Library
INSERT INTO seats (library_id, seat_number, seat_type, status) VALUES
(4, 'I01', 'regular', 'available'), (4, 'I02', 'premium', 'available'), (4, 'I03', 'computer', 'occupied'), (4, 'I04', 'regular', 'available'), (4, 'I05', 'regular', 'available');

-- Insert sample reviews
INSERT INTO reviews (user_id, library_id, rating, comment) VALUES
(2, 1, 5, 'Excellent library! Very peaceful and well-maintained.'),
(2, 2, 4, 'Great heritage building with good collection.'),
(2, 3, 5, 'Best digital resources in Chennai!');

-- Update total seats count
UPDATE libraries l SET total_seats = (SELECT COUNT(*) FROM seats s WHERE s.library_id = l.library_id);

SELECT '✅ Database setup complete!' as Status;
SELECT library_name, total_seats as Seats FROM libraries;