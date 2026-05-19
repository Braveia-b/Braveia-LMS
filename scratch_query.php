<?php
$conn = new mysqli('localhost', 'root', '', 'braveia_db');
$res = $conn->query("SELECT * FROM roles");
while($row = $res->fetch_assoc()) print_r($row);

echo "\nUSERS:\n";
$res2 = $conn->query("SELECT id, name, role_id FROM users");
while($row = $res2->fetch_assoc()) print_r($row);
