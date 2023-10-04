<?php

// Database connection parameters
$servername = "localhost";
$username = "pandin";
$password = "P@nd1n@P";
$dbname = "tabledb";

try {
    // Attempt to create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    echo "<p class='error'>Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.</p>";
    exit; // Terminate the script since it's not possible to proceed without the connection
}

// Check connection
if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
}

// Process and insert the data into a dynamically named table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a table name based on the current timestamp
    date_default_timezone_set('America/Sao_Paulo');
    $table_name = date("d_m_y__H_i");

    // Remove characters that are not allowed in table names
    $table_name = preg_replace('/[^a-zA-Z0-9_]/', '_', $table_name);

    // Create a SQL statement to create the new table with 24 columns
    $create_table_sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,";
    
    // Add 24 columns to the table with names in the format "00:00" to "23:00"
    for ($hour = 0; $hour < 24; $hour++) {
        $hour_str = str_pad($hour, 2, '0', STR_PAD_LEFT); // Format as "00", "01", ..., "23"
        $create_table_sql .= " `$hour_str:00` VARCHAR(255),";
    }

    $create_table_sql .= " created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($create_table_sql) === false) {
        die("Erro ao criar tabela: " . $conn->error);
    }

    // Generate column names in the format "00:00" to "23:00"
    $column_names = implode(', ', array_map(function ($hour) {
        $hour_str = str_pad($hour, 2, '0', STR_PAD_LEFT); // Format as "00", "01", ..., "23"
        return "`$hour_str:00`";
    }, range(0, 23)));
    
    // Prepare the INSERT statement with placeholders for the 24 columns
    $query = "INSERT INTO $table_name ($column_names) VALUES (" . implode(", ", array_fill(0, 24, "?")) . ")";

    // Define an array to hold the column values
    $column_values = array();

    // Loop through rows
    for ($linha = 1; $linha <= 10; $linha++) {
        // Inside this loop, you can access $linha and populate $column_values accordingly
        // For example:
        
        // Populate the $column_values array with the values from the form for this row
        $row_values = array();
        for ($coluna = 0; $coluna < 24; $coluna++) {
            $row_values[] = $_POST['celula'][$linha][$coluna];
        }

        // Append the row values to the column_values array
        $column_values[] = $row_values;
    }

    // Prepare the INSERT statement
    $stmt = $conn->prepare($query);

    // ...
if ($stmt) {
    // Create an array to hold the parameter types (assuming all are strings)
    $param_types = str_repeat("s", 24); // 24 "s" for strings

    // Variable to track if all rows were successfully inserted
    $allRowsInserted = true;

    // Bind the parameters dynamically
    // You should bind the entire row as a single parameter in this case
    foreach ($column_values as $row) {
        $stmt->bind_param($param_types, ...$row);

        // Execute the statement for each row
        if (!$stmt->execute()) {
            // If there's an error in any row, set $allRowsInserted to false
            $allRowsInserted = false;
            echo "<p class='error'>Error inserting data: " . $stmt->error . "</p>";
        }
    }

    // Close the statement
    $stmt->close();

    // Display success message only once if all rows were successfully inserted
    if ($allRowsInserted) {
        echo "<p class='success'>Dados inseridos com sucesso!</p>";
    } else {
        echo "<p class='error'>Algumas linhas não foram adicionadas.</p>";
    }
} else {
    echo "<p class='error'>Falha ao preparar a declaração.</p>";
}

// Close the database connection
$conn->close();
    }
?>