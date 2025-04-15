# Hospital Uniform Management System

A simple PHP web app to manage hospital uniform inventory.

## Features
- Add uniform items (name, size, color, price)
- View all uniforms
- Search uniforms by name

## Requirements
- XAMPP (PHP + MySQL)
- Web browser

## Setup
1. Place files in `htdocs/hospital_uniforms`
2. Create MySQL database `uniform_db`
3. Run SQL: 
```
CREATE TABLE uniforms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  size VARCHAR(20) NOT NULL,
  color VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
4. Start Apache/MySQL in XAMPP
5. Visit http://localhost/hospital_uniforms
