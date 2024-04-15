<?php

// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create user_ids_to_be_deleted table
$sql = "CREATE TABLE IF NOT EXISTS user_ids_to_be_deleted (
        user_id INT
    )";
$conn->query($sql);

// Insert user IDs into the table
$sql = "INSERT INTO user_ids_to_be_deleted (user_id)
        SELECT user_id 
        FROM wp_usermeta 
        WHERE meta_key = 'last_login_gtm' 
        AND TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(meta_value), NOW()) >= 1";
$conn->query($sql);

// Delete users from wp_users based on the user IDs in user_ids_to_be_deleted
$sql = "DELETE FROM wp_users
        WHERE ID IN (SELECT user_id FROM user_ids_to_be_deleted)";
$conn->query($sql);

// Delete rows from wp_usermeta containing user IDs in user_ids_to_be_deleted
$sql = "DELETE FROM wp_usermeta
        WHERE user_id IN (SELECT user_id FROM user_ids_to_be_deleted)";
$conn->query($sql);

// Drop the table after deletion
$sql = "DROP TABLE IF EXISTS user_ids_to_be_deleted";
$conn->query($sql);

// Close connection
$conn->close();

?>
