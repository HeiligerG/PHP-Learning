<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Song 99 Bottles of Beer</title>
</head>
<body>
<?php

echo "Lyrics of the song 99 Bottles of Beer<br><br><br>";

function beerCount($count) {
    for($i = $count; $i > 0; $i--) {
        $bottle = ($i == 1) ? "bottle" : "bottles";

        echo "$i $bottle of beer on the wall, $i $bottle of beer.<br>";

        if($i-1 == 0) {
            echo "Take one down and pass it around, no more bottles of beer on the wall.<br><br>";
        } else {
            //if     true      else// Neu gelernt und sehr interessant https://www.php.net/manual/de/regexp.reference.conditional.php
            $nextBottle = ($i-1 == 1) ? "bottle" : "bottles";
            echo "Take one down and pass it around, " . ($i-1) . " $nextBottle of beer on the wall.<br><br>";
        }
    }

    echo "No more bottles of beer on the wall, no more bottles of beer.<br>";
    echo "Go to the store and buy some more, 99 bottles of beer on the wall.<br>";
}

beerCount(99);
?>
</body>
</html>