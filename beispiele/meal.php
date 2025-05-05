<?php
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
// Definieren der konstanten GET-Parameter
const GET_PARAM_MIN_STARS = 'search_min_stars'; // GET-Parameter für die Mindestanzahl von Sternen
const GET_PARAM_SEARCH_TEXT = 'search_text'; // GET-Parameter für den Suchtext
const GET_SHOW_DESCRIPTION = 'show_description'; // GET-Parameter zur Anzeige der Beschreibung
const GET_LANGUAGE = 'sprache'; // GET-Parameter für die Sprachauswahl
const GET_TOP_FLOPP = 'top_flopp'; // GET-Parameter für TOP/FLOPP Bewertungen

// Arrays für die dynamischen Texte in verschiedenen Sprachen
$dynamic_texts = [
    'de' => [
        'title' => 'Gericht: ',
        'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
        'filter_label' => 'Allergene',
        'search_placeholder' => 'Suchen',
        'search_button' => 'Suchen',
        'ratings_heading' => 'Bewertungen (Insgesamt: ',
        'stars' => 'Sterne)',
        'author' => 'Autor/in',
        'top_button' => 'Top',
        'flopp_button' => 'Flopp'
    ],
    'en' => [
        'title' => 'Dish: ',
        'description' => 'The sweet potatoes are carefully cut open and filled with cream cheese.',
        'filter_label' => 'Allergens',
        'search_placeholder' => 'Search',
        'search_button' => 'Search',
        'ratings_heading' => 'Ratings (Total: ',
        'stars' => 'stars)',
        'author' => 'Author',
        'top_button' => 'Top',
        'flopp_button' => 'Flopp'
    ]
];

// Standardwerte für die statischen Texte
$lang = isset($_GET[GET_LANGUAGE]) && ($_GET[GET_LANGUAGE] == 'en') ? 'en' : 'de';
$showDescription = isset($_GET[GET_SHOW_DESCRIPTION]) ? $_GET['show_description'] : '0';


// Dynamische Texte abhängig von der ausgewählten Sprache
$title = $dynamic_texts[$lang]['title']; // Titel des Gerichts
$description = $dynamic_texts[$lang]['description']; // Beschreibung des Gerichts
$filter_label = $dynamic_texts[$lang]['filter_label']; // Filterbeschriftung
$search_placeholder = $dynamic_texts[$lang]['search_placeholder']; // Platzhalter für die Sucheingabe
$search_button = $dynamic_texts[$lang]['search_button']; // Beschriftung des Suchbuttons
$ratings_heading = $dynamic_texts[$lang]['ratings_heading']; // Überschrift für Bewertungen
$stars = $dynamic_texts[$lang]['stars']; // Beschriftung für Sterne
$author = $dynamic_texts[$lang]['author']; // Beschriftung für Autor/in
$top_button = $dynamic_texts[$lang]['top_button']; // Beschriftung für Top/Flopp Button
$flopp_button = $dynamic_texts[$lang]['flopp_button']; // Beschriftung für Top/Flopp Button


// allergene
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

// meal
$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13, 17],
    'amount' => 42
];

// Bewertungen
$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

// Preis formatieren (2 Nachkommstellen, per Komma trennen, tausender mit punkt getrennt)
$price_intern_formatted = number_format($meal['price_intern'], 2, ',', '.') . '€';
$price_extern_formatted = number_format($meal['price_extern'], 2, ',', '.') . '€';

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = strtolower($_GET[GET_PARAM_SEARCH_TEXT]); // groß und kleinschreibung ändern
    foreach ($ratings as $rating) {
        if (strpos(strtolower($rating['text']), $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_TOP_FLOPP])) { // Überprüfen, ob TOP/FLOPP angefordert wurde
    $top_flopp = $_GET[GET_TOP_FLOPP];
    $starsArray = array_column($ratings, 'stars'); // Alle Sterne in ein Array extrahieren
    $maxStars = max($starsArray); // Maximale Anzahl von Sternen finden
    $minStars = min($starsArray); // Minimale Anzahl von Sternen finden
    if ($top_flopp == 'TOP') {
        foreach ($ratings as $rating) {
            if ($rating['stars'] == $maxStars) { // Alle Bewertungen mit den meisten Sternen hinzufügen
                $showRatings[] = $rating;
            }
        }
    } else if ($top_flopp == 'FLOPP') {
        foreach ($ratings as $rating) {
            if ($rating['stars'] == $minStars) { // Alle Bewertungen mit den wenigsten Sternen hinzufügen
                $showRatings[] = $rating;
            }
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars']; // Summiere die Sterne aller Bewertungen
    }
    return count($ratings) > 0 ? $sum / count($ratings) : 0; // Berechne den Durchschnitt, wenn es Bewertungen gibt, sonst gib 0 zurück, um Division durch Null zu vermeiden
}

// Überprüfen, ob die Beschreibung angezeigt werden soll
if ($showDescription == 0) {
    $description = ''; // Beschreibung leeren, wenn show_description=0 ist
}

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $title . $meal['name']; ?></title>

    <style>
        * {
            font-family: Arial, serif;
        }
        .rating {
            color: darkgray;
        }
        .stars {
            color: orange;
        }
    </style>


</head>
<body>
<h1><?php echo $title . $meal['name']; ?></h1>

<p>Interner Preis: <?php echo $price_intern_formatted; ?></p>
<p>Externer Preis: <?php echo $price_extern_formatted; ?></p>

<p><?php echo $description; ?></p>
<p><?php echo $filter_label; ?></p>
<ul>
    <?php foreach ($meal['allergens'] as $allergen_id): ?>
        <li><?php echo $allergens[$allergen_id]; ?></li> <!-- Liste der Allergene ausgeben -->
    <?php endforeach; ?>
</ul>
<h1><?php echo $ratings_heading . calcMeanStars($ratings) . $stars; ?></h1> <!-- Durchschnittliche Sterne anzeigen -->
<form method="get">
    <label for="search_text"><?php echo $filter_label; ?>:</label>
    <!-- Hier wird der vorherige Suchtext eingefügt -->
    <input id="search_text" type="text" name="<?php echo GET_PARAM_SEARCH_TEXT; ?>" placeholder="<?php echo $search_placeholder; ?>" value="<?php echo isset($_GET[GET_PARAM_SEARCH_TEXT]) ? htmlspecialchars($_GET[GET_PARAM_SEARCH_TEXT]) : ''; ?>">
    <input type="submit" value="<?php echo $search_button; ?>">
</form>
<form method="get">
    <input type="hidden" name="<?php echo GET_LANGUAGE; ?>" value="<?php echo $lang; ?>">
    <button type="submit" name="<?php echo GET_TOP_FLOPP; ?>" value="TOP"><?php echo $top_button; ?></button> <!-- Button für TOP Bewertungen -->
    <button type="submit" name="<?php echo GET_TOP_FLOPP; ?>" value="FLOPP"><?php echo $flopp_button; ?></button> <!-- Button für FLOPP Bewertungen -->
</form>
<table class="rating">
    <thead>
    <tr>
        <td>Text</td>
        <td><?php echo $stars; ?></td>
        <td><?php echo $author; ?></td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($showRatings as $rating) {
        echo "<tr><td class='rating_text'>{$rating['text']}</td>
                              <td class='rating_stars'>";
        // Anzeige der Sterne anstatt als Zahl
        for ($i = 0; $i < $rating['stars']; $i++) {
            echo "<span class='stars'>&#9733;</span>"; // Unicode-Symbol für Sterne
        }
        echo "</td>
                              <td class='rating_author'>{$rating['author']}</td> <!-- Zeigt den Autor/die Autorin an -->
                          </tr>";
    }
    ?>
    </tbody>
</table>

<!-- Sprachwahl-Links -->
<div>
    <a href="?<?php echo GET_LANGUAGE; ?>=de">Deutsch</a> | <a href="?<?php echo GET_LANGUAGE; ?>=en">English</a>
</div>

</body>
</html>
