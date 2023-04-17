<?php

// Load the database configuration file 
include_once 'connection.php';

// Fetch records from database 
$query = $conn->query("SELECT * FROM poster ORDER BY like_count ASC");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "poster-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer 
    $f = fopen('php://memory', 'w');

    // Set column headers 
    $fields = array('p name', ' p user', 'view', ' like', ' dislike');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['p_name'], $row['p_user'], $row['view'], $row['like_count'], $row['dislike_count']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file 
    fseek($f, 0);

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer 
    fpassthru($f);
}
exit;

?>