<?php
/*
$host = 'sql306.infinityfree.com';
$dbname = 'if0_37871836_movie_trailer_db';
$username = 'if0_37871836';
$password = 'Jamesbona1212';
*/
$host = 'localhost';
$dbname = 'movie_trailer_db';
$username = 'root';
$password = '';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
