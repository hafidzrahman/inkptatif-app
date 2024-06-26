<?php

include "koneksi.php";

// Array to store all data
$data = array();

// Get all table names from the database
$tables = $conn->query("SHOW TABLES");

if ($tables->num_rows > 0) {
    while ($table = $tables->fetch_array()) {
        $tableName = $table[0];

        // Get the table's data
        $result = $conn->query("SELECT * FROM $tableName");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Add row data to the array
                $data[$tableName][] = $row;
            }
        }
    }
}

// Close MySQL connection
$conn->close();

// Set header as JSON
header('Content-Type: application/json');

// Output JSON data
echo json_encode($data, JSON_PRETTY_PRINT);
?>