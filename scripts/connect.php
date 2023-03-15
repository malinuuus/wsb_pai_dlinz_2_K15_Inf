<?php
  // połączenie z bazą danych
  // new mysqli(hostname, username, password, database)
  $conn = new mysqli("localhost", "root", "", "wsb_pai_dlinz_k15");
  // echo $conn->connect_errno; // komunikat o połączeniu, 0 - dobrze
?>