<?php
// Validation von Eingaben
function validate_input($data): string {
    // Trimmen und HTML-Sonderzeichen in $data bereinigen, um XSS-Angriffe zu verhindern
    return trim(htmlspecialchars($data));
}

// Überprüfung der E-Mail-Domain
function is_valid_email_domain(string $email): bool {
    // Liste ungültiger Domains, von denen keine E-Mails akzeptiert werden
    $invalid_domains = ['rcpt.at', 'damnthespam.at', 'wegwerfmail.de', 'trashmail.de', 'trashmail.com'];
    // Domain aus der E-Mail-Adresse extrahieren
    $email_domain = substr(strrchr($email, "@"), 1);
    // Überprüfen, ob die E-Mail-Domain in der Liste ungültiger Domains enthalten st
    foreach ($invalid_domains as $domain) {
        if (stripos($email_domain, $domain) !== false) {
            return false; // Die Domain ist böse
        }
    }
    return true; // Die Domain ist in ordnung
}

// Initialisierung von Variablen
$anrede = $vorname = $nachname = $email = $interval = "";
$datenschutz = false;
$errors = [];

// Verarbeitung des Formulars, wenn abgeschickt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten validieren und bereinigen
    $anrede = validate_input($_POST['anrede'] ?? ''); // ?? ist der Null-Coalescing-Operator, der den Standardwert '' setzt, falls $_POST['anrede'] nicht gesetzt ist
    $vorname = validate_input($_POST['vorname']);
    $nachname = validate_input($_POST['nachname']);
    $email = validate_input($_POST['email']);
    $interval = validate_input($_POST['interval']);
    $datenschutz = isset($_POST['datenschutz']); // prüfen ob datenschutz angenommen wurde

    // validierungen der eingaben
    if (empty($vorname) || empty($nachname) || empty($email) || !$datenschutz) {
        $errors[] = "Alle Pflichtfelder müssen ausgefüllt werden und den Datenschutzbestimmungen muss zugestimmt werden.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Die E-Mail-Adresse ist nicht korrekt formatiert.";
    }
    if (!is_valid_email_domain($email)) {
        $errors[] = "E-Mail-Adressen von bestimmten Domains sind nicht erlaubt.";
    }
    if (empty(trim($vorname)) || empty(trim($nachname))) {
        $errors[] = "Vorname und Nachname dürfen nicht nur aus Leerzeichen bestehen.";
    }

    // Wenn keine Fehler vorliegen, Daten speichern
    if (empty($errors)) {
        // Daten in Array speichern
        $data = [
            'anrede' => $anrede,
            'vorname' => $vorname,
            'nachname' => $nachname,
            'email' => $email,
            'interval' => $interval
        ];
        // Daten in JSON-Format konvertieren
        $data_string = json_encode($data) . PHP_EOL;

        // Daten in Textdatei speichern und Feedback
        if (file_put_contents('newsletter_anmeldungen.txt', $data_string, FILE_APPEND)) {
            echo "<p>Vielen Dank für Ihre Anmeldung!</p>";
        } else {
            echo "<p>Es gab einen Fehler bei der Speicherung Ihrer Daten. Bitte versuchen Sie es später erneut.</p>";
        }
    } else {
        // Fehler anzeigen
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
