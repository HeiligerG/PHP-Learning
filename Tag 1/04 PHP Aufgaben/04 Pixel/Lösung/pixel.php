<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/styles.css">
    <title>Pixel Generator</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            width: 30px;
            height: 30px;
            border: 1px solid black;
        }
        .mark {
            background-color: black;
        }
    </style>
</head>
<body>
<?php
$cols = $_GET['cols'] ?? 4;
$rows = $_GET['rows'] ?? 4;

$cols = (int)$cols;
$rows = (int)$rows;

$cols = max(1, min(60, $cols));
$rows = max(1, min(60, $rows));

$pixels = $_GET['pixels'] ?? [];
$markedPixels = [];

foreach ($pixels as $pixel) {
    $coordinates = explode('|', $pixel);
    if (count($coordinates) === 2) {
        $x = (int)$coordinates[0];
        $y = (int)$coordinates[1];
        if ($x >= 1 && $x <= $cols && $y >= 1 && $y <= $rows) {
            $markedPixels[$y][$x] = true;
        }
    }
}

echo "<table>";
for ($y = 1; $y <= $rows; $y++) {
    echo "<tr>";
    for ($x = 1; $x <= $cols; $x++) {
        $class = isset($markedPixels[$y][$x]) ? ' class="mark"' : '';
        echo "<td$class></td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>

