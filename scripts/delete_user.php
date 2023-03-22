<?php
// skrypt do usuwania użytkowników
require_once "./connect.php";
$sql = "DELETE FROM users WHERE id = $_GET[deleteUserId]";
$conn->query($sql);
$deleteUser = 0;

if ($conn->affected_rows != 0) {
    // echo "Usunięto rekord";
    $deleteUser = $_GET["deleteUserId"];
} else {
    // echo "Nie usunięto rekordu";
    $deleteUser = 0;
}

// cofa i odświeża
header("location: ../4_db/3_db_table_delete.php?deleteUser=$deleteUser");
?>
<!---->
<!--<script>-->
<!--    // wszystkie dane w formularzu zostają oprócz hasła-->
<!--    history.back();-->
<!--</script>-->
