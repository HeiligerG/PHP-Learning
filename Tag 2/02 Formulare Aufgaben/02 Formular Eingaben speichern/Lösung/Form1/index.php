<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST) && !empty($_POST)) {
        $csvFile = 'Daten/data.csv';

        $fileHandle = fopen($csvFile, 'a');

        if ($fileHandle !== false) {
            if (filesize($csvFile) == 0){
                fputcsv($fileHandle, array_keys($_POST));
            }

            fputcsv($fileHandle, $_POST);

            fclose($fileHandle);
        }
    }

    if (empty($_POST["name"])) {
        $errors[] = "Bitte geben Sie einen Namen ein.";
    }

    if (empty($_POST["email"])) {
        $errors[] = "Bitte geben Sie eine Email ein.";
    } elseif (!str_contains($_POST["email"], "@")) {
        $errors[] = "Die Email-Adresse \"{$_POST["email"]}\" ist ungültig.";
    }

    if (empty($_POST["phone"])) {
        $errors[] = "Bitte geben Sie eine Telefonnummer ein.";
    } elseif (!preg_match("/^[0-9+ ]*$/", $_POST["phone"])) {
        $errors[] = "Die Telefonnummer \"{$_POST["phone"]}\" ist ungültig.";
    }

    if (empty($_POST["people"])) {
        $errors[] = "Bitte geben Sie die Anzahl teilnehmender Personen ein.";
    } elseif (!is_numeric($_POST["people"])) {
        $errors[] = "Bitte geben Sie für die Anzahl Personen nur Zahlen ein.";
    }

    if (empty($_POST["hotel"])) {
        $errors[] = "Bitte wählen Sie ein Hotel für die Übernachtung aus.";
    }
}

$name = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$phone = $_POST["phone"] ?? "";
$people = $_POST["people"] ?? "";
$hotel = $_POST["hotel"] ?? "InterContinental Davos";
$program = $_POST["program"] ?? "";
$note = $_POST["note"] ?? "";

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Formular</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <style>
        .wrapper {
            margin-top: 2em;
            width: 80%;
            max-width: 550px;
            margin: 2em auto 0;
        }
        .error-container {
            border: 1px solid #dc3545;
            background-color: #f8d7da;
            color: #dc3545;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .error-container ul {
            margin: 0;
            padding-left: 20px;
        }
        .success-message {
            border: 1px solid #28a745;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
        ?>
        <div class="success-message">
            <h2>Anmeldung erfolgreich</h2>
            <p>Vielen Dank für Ihre Anmeldung. Wir haben diese erfolgreich entgegengenommen.</p>
        </div>
        <?php
    } else {
        if (!empty($errors)) {
            ?>
            <div class="error-container">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
        }
        ?>

        <h1 class="form-title">Anmeldung für Kundenevent</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend class="form-legend">Kontaktdaten</legend>
                <div class="form-group">
                    <label class="form-label" for="name">Ihr Name</label>
                    <input class="form-control" type="text" id="name" name="name"
                           value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Ihre Email-Adresse</label>
                    <input class="form-control" type="email" id="email" name="email"
                           value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">Ihre Telefonnummer</label>
                    <input class="form-control" type="text" id="phone" name="phone"
                           value="<?php echo htmlspecialchars($phone); ?>">
                </div>
            </fieldset>

            <fieldset>
                <legend class="form-legend">Unterkunft</legend>
                <div class="form-group">
                    <label class="form-label" for="people">Wie viele Personen werden von Ihrer Firma teilnehmen?</label>
                    <input class="form-control" min="0" type="number" id="people" name="people"
                           value="<?php echo htmlspecialchars($people); ?>">
                </div>
                <div class="form-group option-group">
                    <p class="form-label">In welchem Hotel möchten Sie übernachten?</p>
                    <div class="radio">
                        <label for="hotel1">
                            <input type="radio" name="hotel" id="hotel1" value="InterContinental Davos"
                                <?php echo $hotel === "InterContinental Davos" ? "checked" : ""; ?>>
                            InterContinental Davos
                        </label>
                    </div>
                    <div class="radio">
                        <label for="hotel2">
                            <input type="radio" name="hotel" id="hotel2" value="Steinberger Grandhotel Belvédère"
                                <?php echo $hotel === "Steinberger Grandhotel Belvédère" ? "checked" : ""; ?>>
                            Steinberger Grandhotel Belvédère
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="form-legend">Ihr individuelles Programm</legend>
                <div class="form-group">
                    <label class="form-label" for="program">Was möchten Sie am Abend unternehmen?</label>
                    <select class="form-control" id="program" name="program">
                        <option value="" <?php echo $program === "" ? "selected" : ""; ?>>
                            Kein Abendprogramm
                        </option>
                        <option value="Billardturnier" <?php echo $program === "Billardturnier" ? "selected" : ""; ?>>
                            Billardturnier
                        </option>
                        <option value="Bowlingturnier" <?php echo $program === "Bowlingturnier" ? "selected" : ""; ?>>
                            Bowlingturnier
                        </option>
                        <option value="Weindegustation" <?php echo $program === "Weindegustation" ? "selected" : ""; ?>>
                            Weindegustation
                        </option>
                        <option value="Asiatischer Kochkurs" <?php echo $program === "Asiatischer Kochkurs" ? "selected" : ""; ?>>
                            Asiatischer Kochkurs
                        </option>
                        <option value="Tanzkurs für Webentwickler" <?php echo $program === "Tanzkurs für Webentwickler" ? "selected" : ""; ?>>
                            Tanzkurs für Webentwickler
                        </option>
                        <option value="Ying & Yang Yoga Einsteigerkurs" <?php echo $program === "Ying & Yang Yoga Einsteigerkurs" ? "selected" : ""; ?>>
                            Ying & Yang Yoga Einsteigerkurs
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="note" class="form-label">Haben Sie sonst noch einen Wunsch oder eine Bemerkung?</label>
                    <textarea name="note" id="note" rows="3" class="form-control"><?php echo htmlspecialchars($note); ?></textarea>
                </div>
            </fieldset>

            <div class="form-actions">
                <input class="btn btn-primary" type="submit" value="Anmelden">
                <a href="http://www.google.com" class="btn">Anmeldung abbrechen</a>
            </div>
        </form>
    <?php } ?>
</div>
</body>
</html>