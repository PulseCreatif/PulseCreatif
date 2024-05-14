<?php

include '..\..\models\Reclamation.php'; // Update the path to the Reclamation model file
require("function.php"); // Ensure that function.php contains the database connection

// Query to retrieve reclamations from the database
$query = "SELECT * FROM reclamation";
$result = $con->query($query);

if (!$result) {
    die("Query failed: " . $con->error);
}

// Check if any reclamations were retrieved
if ($result->num_rows > 0) {
    // Define the filename for the exported CSV file
    $filename = "reclamations.csv";

    // Open the CSV file for writing
    $file = fopen($filename, "w");

    // Write the header row to the CSV file
    $header = array("ID", "Type", "Etat", "Description", "Email", "Name", "Subject");
    fputcsv($file, $header);

    // Iterate through the result set and write reclamations to the CSV file
    while ($row = $result->fetch_assoc()) {
        fputcsv($file, $row);
    }

    // Close the file
    fclose($file);

    // Download the CSV file
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; charset=UTF-8");
    readfile($filename);

    // Exit script
    exit;
} else {
    // If no reclamations were retrieved, display a message
    echo "No reclamations found in the database.";
}

?>
