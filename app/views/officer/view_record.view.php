<?php
if (isset($_GET['id'])) {
    $record_id = $_GET['id'];
    $driver_registration = new Driverregistration();
    $record = $driver_registration->findById($record_id);
    
    if ($record) {
        echo "<h2>Record Details</h2>";
        echo "<p><strong>Name;</strong>" . $record->driverName . "<p/>";
        echo "<p><strong>Email:</strong> ". $record->email . "</p>";
        echo "<p><strong>contact Number:</strong> ". $record->contactNumber ."</p>";
    } else {
        echo "<p>record not found.</p>";
    }
} else {
    echo "<p>Invalid request. </p>";
}
?>