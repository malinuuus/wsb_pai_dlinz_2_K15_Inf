<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dołączanie pliku</title>
</head>
<body>
  <h4>Początek strony</h4>
  <?php
    // opcje dołączania pliku:
    // include 
    // include_once - nie dodaje jeśli wcześniej zostały dodany
    // require - wymagany plik (fatal error jeśli nie ma pliku)
    // require_once

    include "./scripts/lista.php";
    include_once "./scripts/lista.php";

    // mimo błędu kod wykonuje się do końca
    // @ - tuszuje warning

    // require "./scripts/lista.php";
    require "./scripts/lista.php";
  ?>
  <h4>Koniec strony</h4>
</body>
</html>