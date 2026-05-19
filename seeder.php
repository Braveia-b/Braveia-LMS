<?php
$mysqli = new mysqli("localhost", "root", "", "braveia_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 1. Insert Roles
$roles = [
    [1, 'Super Admin', 'Hak akses penuh'],
    [2, 'Admin', 'Manajemen sistem'],
    [3, 'Mentor', 'Akses mentor pelatihan'],
    [4, 'Peserta', 'Akses pengguna umum'],
    [5, 'Corporate', 'Akses akun perusahaan']
];

foreach ($roles as $role) {
    $mysqli->query("INSERT IGNORE INTO roles (id, name, description) VALUES ({$role[0]}, '{$role[1]}', '{$role[2]}')");
}

// 2. Insert Super Admin User
$hash = password_hash('admin123', PASSWORD_DEFAULT);
$mysqli->query("INSERT IGNORE INTO users (id, role_id, name, email, password, is_active) VALUES (1, 1, 'Super Administrator', 'admin@braveia.com', '$hash', 1)");

// 3. Insert Dummy Categories
$categories = [
    [1, 'Web Development', 'web-development'],
    [2, 'Data Science', 'data-science'],
    [3, 'UI/UX Design', 'ui-ux-design']
];
foreach ($categories as $cat) {
    $mysqli->query("INSERT IGNORE INTO training_categories (id, name, slug) VALUES ({$cat[0]}, '{$cat[1]}', '{$cat[2]}')");
}

echo "Seeding completed successfully!\n";
