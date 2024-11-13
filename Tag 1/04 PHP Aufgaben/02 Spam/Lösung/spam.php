<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spam Filter</title>
</head>
<body>
<?php

$input = [
    'Neue Aktionen von Ihrem Computerteile-Händler.',
    'Vergrössern Sie jetzt ihr SPAM mit SPAM.',
    'SPAM kann ihnen dabei helfen wieder ruhig zu schlafen.',
    'Kennen Sie Justin Bieber? Finden Sie andere Singles in Ihrer Nähe.',
    'Wenn spam zum Problem wird, haben Sie ein Problem.'
];

function spamScan($text) {
    return stripos($text, 'spam') !== false;
}

function spamScanExtended($text) {
    return stripos($text, 'spam') !== false || stripos($text, 'singles') !== false;
}

foreach($input as $key => $text) {
    $isSpam = spamScanExtended($text);
    echo "Satz $key ist " . ($isSpam ? "SPAM" : "OK") . "<br>";
}
?>
</body>
</html>