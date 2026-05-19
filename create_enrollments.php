<?php
$conn = new mysqli('localhost', 'root', '', 'braveia_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "CREATE TABLE IF NOT EXISTS user_enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    training_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY user_training_unique (user_id, training_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table user_enrollments created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
