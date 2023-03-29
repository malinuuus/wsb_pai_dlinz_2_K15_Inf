<?php
// skrypt do usuwania miast
require_once "./connect.php";
$sql = "DELETE FROM cities WHERE id = $_GET[deleteCityId]";
$deleteCity = 0;

try {
    $conn->query($sql);

    if ($conn->affected_rows != 0) {
        $deleteCity = $_GET["deleteCityId"];
    }
} catch (Exception $e) {}

// cofa i odświeża
header("location: ../4_db/4_db_table_add.php?table=cities&deleteCity=$deleteCity");
