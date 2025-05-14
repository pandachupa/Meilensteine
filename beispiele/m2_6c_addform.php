<!--
 - Praktikum DBWT. Autoren:
 - Lara, Devos, 3649406
 - Kyra, Becker, 3594605
 -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Formular Addform</title>
    <style>
        body {
            color: hotpink;
        }
    </style>
</head>
<body>
<form method="post" action="">
    <label for="a">a:</label>
    <input type="text" id="a" name="a" required>
    <br>
    <label for="b">b:</label>
    <input type="text" id="b" name="b" required>
    <br>
    <button type="submit" name="operation" value="add">Addieren</button> <!--welche Rechenart wird ausgeführt??-->
    <button type="submit" name="operation" value="multiply">Multiplizieren</button>
</form>

<?php
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //nur wenn post methode verwendet wurde
    $a = isset($_POST['a']) ? (float)$_POST['a'] : 0;
    $b = isset($_POST['b']) ? (float)$_POST['b'] : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    if ($operation == 'add') {
        $result = $a + $b;
        echo "<p>Das Ergebnis der Addition von $a und $b ist: $result</p>";
    } elseif ($operation == 'multiply') {
        $result = $a * $b;
        echo "<p>Das Ergebnis der Multiplikation von $a und $b ist: $result</p>";
    }
}
?>
</body>
</html>
