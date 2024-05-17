<?php
// Pfad zur Datei mit den visitorcounts
$visitor_count_path = 'besucher_zaehler.txt';

// Pfad zur Datei mit den Gerichten
$meal_data_path = 'meal_data.txt';

// Pfad zur Datei mit den Newsletter-Anmeldungen
$newsletter_subscribers_path = 'newsletter_anmeldungen.txt';


// Erhöhung des visitorcounts
function increment_visitor_count($filePath) {
    if (file_exists($filePath) && is_writable($filePath)) {
        // Lesen der aktuellen Besucherzahl
        $count = (int)file_get_contents($filePath);
        // Inkrementieren der Besucherzahl um eins
        $count++;
        // Schreiben der neuen Besucherzahl in die Datei
        file_put_contents($filePath, $count);
    }
}

// Anzeige der visitorcount
function display_visitor_count($filePath) {
    if (file_exists($filePath)) {
        // Lesen der aktuellen Besucherzahl
        $count = (int)file_get_contents($filePath);
        // Ausgabe der Besucherzahl
        echo "<p>Anzahl Besucher: $count</p>";
    }
}


// Anzeige --> Anzahl der gespeicherten Gerichte
function display_meal_count($filePath) {
    if (file_exists($filePath)) {
        // Gerichte einlesen und zählen der Zeilen
        $count = count(file($filePath, FILE_SKIP_EMPTY_LINES));
        // Ausgabe der Anzahl der Gerichte
        echo "<p>Anzahl Gerichte: $count</p>";
    }
}

// Anzeige der Anzahl von den Newsletter-Anmeldungen
function display_newsletter_subscribers_count($filePath) {
    if (file_exists($filePath)) {
        // Lesen der Anmeldungen zum Newsletter und Zählen der Zeilen
        $count = count(file($filePath, FILE_SKIP_EMPTY_LINES));
        // Ausgabe der Anzahl der Newsletter-Anmeldungen
        echo "<p>Anzahl Newsletter-Anmeldungen: $count</p>";
    }
}


// Besucherzähler +1 bei jedem Seitenaufruf
increment_visitor_count($visitor_count_path);
?>

    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Werbeseite</title>
    </head>
    <body>

    <h1>Werbeseite</h1>
    <h2>Zahlen</h2>

    <?php
    // show visitorcount
    display_visitor_count($visitor_count_path);

    // Anzeige der Anzahl der gespeicherten Gerichte
    display_meal_count($meal_data_path);

    // Anzahl Newsletter supscriptions
    display_newsletter_subscribers_count($newsletter_subscribers_path);
    ?>

    </body>
    </html>
<?php
