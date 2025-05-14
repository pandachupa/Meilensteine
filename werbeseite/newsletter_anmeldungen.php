<?php

/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */

// Validierung von Eingaben
function validiere_eingabe($eingabe): string
{
    // Trimmen und HTML-Sonderzeichen bereinigen, um XSS-Angriffe zu verhindern
    return trim(htmlspecialchars($eingabe));
}

// Überprüfung der E-Mail-Domain
function ist_gueltige_email_domain(string $email): bool
{
    // Liste ungültiger Domains, von denen keine E-Mails akzeptiert werden
    $ungueltige_domains = ['rcpt.at', 'damnthespam.at', 'wegwerfmail.de', 'trashmail.de', 'trashmail.com'];
    // Domain aus der E-Mail-Adresse extrahieren
    $email_domain = substr(strrchr($email, "@"), 1);
    // Überprüfen, ob die E-Mail-Domain in der Liste ungültiger Domains enthalten ist
    foreach ($ungueltige_domains as $domain) {
        if (stripos($email_domain, $domain) !== false) {
            return false;
        }
    }
    return true;
}

// Initialisierung von Variablen
$anrede = $vorname = $nachname = $email = "";
$datenschutz_akzeptiert = false;
$fehlermeldungen = [];

// Verarbeitung des Formulars, wenn abgeschickt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten validieren und bereinigen
    $anrede = validiere_eingabe($_POST['anrede'] ?? '');
    $vorname = validiere_eingabe($_POST['vorname']);
    $nachname = validiere_eingabe($_POST['nachname']);
    $email = validiere_eingabe($_POST['email']);
    $datenschutz_akzeptiert = isset($_POST['datenschutz']);

    // Validierungen
    if (empty($vorname) || empty($nachname) || empty($email) || !$datenschutz_akzeptiert) {
        $fehlermeldungen[] = "Alle Pflichtfelder müssen ausgefüllt werden und den Datenschutzbestimmungen muss zugestimmt werden.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehlermeldungen[] = "Die E-Mail-Adresse ist nicht korrekt formatiert.";
    }
    if (!ist_gueltige_email_domain($email)) {
        $fehlermeldungen[] = "E-Mail-Adressen von bestimmten Domains sind nicht erlaubt.";
    }
    if (empty(trim($vorname)) || empty(trim($nachname))) {
        $fehlermeldungen[] = "Vorname und Nachname dürfen nicht nur aus Leerzeichen bestehen.";
    }

    // Wenn keine Fehler vorliegen, Daten speichern
    if (empty($fehlermeldungen)) {
        $daten = [
            'anrede' => $anrede,
            'vorname' => $vorname,
            'nachname' => $nachname,
            'email' => $email,
        ];
        $daten_string = json_encode($daten) . PHP_EOL;

        if (file_put_contents('newsletter_anmeldungen.txt', $daten_string, FILE_APPEND)) {
            echo "<p>Vielen Dank für Ihre Anmeldung!</p>";
        } else {
            echo "<p>Es gab einen Fehler bei der Speicherung Ihrer Daten. Bitte versuchen Sie es später erneut.</p>";
        }
    }
}
