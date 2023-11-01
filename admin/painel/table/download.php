<?php
include "conn.php";

$conn->set_charset("utf8");

if (isset($_GET['table'])) {
    // Get the table name from the GET request
    $tableName = $_GET['table'];

    // SQL query to select all records from the table
    $sql = "SELECT * FROM " . $tableName;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // File name for download
        $filename = $tableName . ".csv";

        // Set HTTP headers for download with a semicolon (;) as the delimiter
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Open an output file pointer in write mode
        $output = fopen('php://output', 'w');
        
        echo "\xEF\xBB\xBF";

        // Specify the semicolon (;) as the delimiter
        $delimiter = ';';

        // Write the header row to the CSV
        $header = [];
        while ($fieldinfo = $result->fetch_field()) {
            $header[] = $fieldinfo->name;
        }
        fputcsv($output, $header, $delimiter);

        // Write the data rows to the CSV with the semicolon delimiter
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row, $delimiter);
        }

        fclose($output);
    } else {
        echo "No data found in the table.";
    }
} else {
    echo "Table not specified.";
}

// Close the database connection
$conn->close();
?>
