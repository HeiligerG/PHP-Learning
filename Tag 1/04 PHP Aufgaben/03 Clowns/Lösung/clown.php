<!doctype html>
<?php
$clowns = array("Herschel Krustofski", "Oleg Popow", "Carl Godlewski", "Charlie Rivel",
    "Alfredo Smaldini", "Eugen Rosai");

sort($clowns);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clown</title>
    <style>
        .markiert {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php

echo "<ul>";
foreach ($clowns as $clown) {
    if (substr(strtolower($clown), -3) === 'ski') {
        echo "<li class='markiert'>" . htmlspecialchars($clown) . "</li>";
    } else {
        echo "<li>" . htmlspecialchars($clown) . "</li>";
    }
}
echo "</ul>";
?>
</body>
</html>