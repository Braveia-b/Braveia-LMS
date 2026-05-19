<?php
$conn = new mysqli('localhost', 'root', '', 'braveia_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $table = $row[0];
    echo "TABLE: $table\n";
    $res2 = $conn->query("DESCRIBE $table");
    while ($col = $res2->fetch_assoc()) {
        echo "  " . $col['Field'] . " - " . $col['Type'] . "\n";
    }
}
$conn->close();
