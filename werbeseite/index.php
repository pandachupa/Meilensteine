<?php
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
include 'gerichte_array.php';
include 'newsletter_anmeldungen.php';
$gerichte = [
    [
        'name' => 'Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie Nudeln',
        'preisIntern' => '3,50',
        'preisExtern' => '6,20',
        'bild' => 'mienudeln.jpeg'
    ],
    [
        'name' => 'Spinatrisotto mit Samosateigecken und gemischter Salat',
        'preisIntern' => '2,90',
        'preisExtern' => '5,30',
        'bild' => 'spinat-risotto.jpg'
    ],
    [
        'name' => 'Vegetarische Tortellini',
        'preisIntern' => '3,00',
        'preisExtern' => '5,50',
        'bild' => 'vegetarische-tortellini-pfanne.jpg'
    ],
    [
        'name' => 'Kartoffelcurry',
        'preisIntern' => '3,20',
        'preisExtern' => '5,90',
        'bild' => 'kartoffelcurry.jpg'
    ],
];
// Besucherzähler (einfach)
$besucherDatei = 'besucher.txt';
$besucher = 0;

if (file_exists($besucherDatei)) {
    $besucher = (int) file_get_contents($besucherDatei);
}
$besucher++;
file_put_contents($besucherDatei, $besucher);

$anzahlGerichte = count($gerichte);

$newsletterDatei = 'newsletter_anmeldungen.txt';
$anzahlAnmeldungen = file_exists($newsletterDatei) ? count(file($newsletterDatei)) : 0;

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <style>
        .gerichtsbild {
            width: 200px;
            height: auto;
        }
        body {
            border: solid 1px black;
            font-family: 'Comic Sans MS', cursive;
        }

        main {
            padding-right: 200px;
            padding-left: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            margin-bottom: 40px;
            border-bottom: solid black 1px;
        }

        #logo{
            float: left;
            margin-right: 20px;
        }

        nav {
            box-sizing: content-box;
            border: solid 1px black;
            margin-bottom: 20px;
        }

        nav li {
            display: inline;
            color: mediumturquoise;
            text-decoration: underline;
            padding-right: 20px;
        }

        nav a {
            color:mediumturquoise;
        }

        .Ende {
            text-align: center;
        }

        #foot {
            display: flex;
            justify-content: space-evenly;
            margin-bottom: 20px;
        }

        .impressum {
            color: mediumturquoise;
            text-decoration: underline;
        }

        .footer_inhalt {
            border-right: grey 1px solid;
            padding-right: 17px;
        }

        .footer_inhalt:last-child {
            border-right: none;
        }

        .köstlichkeiten {
            border: 2px solid black;
        }

        td, tr {
            border: 1px dotted black;
        }

        .Zahlen {
            display: flex;
            justify-content: space-between;
            padding: 60px;
            }
        .zahlenInhalt {
            margin: 60px;
        }


    </style>
</head>
<body>
<header>
    <img id="logo" src="Logo.jpg" alt="logo" width="60" height="70">
    <nav>
        <ul>
            <li class="navelement"> <a href="#eins">Ankündigung</a></li>
            <li class="navelement"> <a href="#zwei">Speisen</a></li>
            <li class="navelement"> <a href="#drei">Zahlen</a></li>
            <li class="navelement"> <a href="#vier">Kontakt</a></li>
            <li class="navelement"> <a href="#fuenf">Wichtig für uns</a></li>
        </ul>
    </nav>
</header>
<main>
    <img src="mensa_essen.jpg" alt="Platzhalterbild" width="800px" height="400px">

    <h1 id="eins">Bald gibt es Essen auch online ;)</h1>
    <fieldset>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum
            sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
            justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
            vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum
            semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu,
            consequat vitae, eleifend ac, enim. Aliquam lorem ante,
            dapibus in, viverra quis, feugiat a, tellus.</p>
    </fieldset>

        <!-- Aufgabe 6 -->
        <h1>Köstlichkeiten, die Sie erwarten</h1>

        <table class="köstlichkeiten">
            <tr>
                <td></td>
                <td>Preis Intern</td>
                <td>Preis extern</td>
            </tr>
            <?php foreach ($gerichte as $gericht): ?> <!-- Variable wird nicht richtig erkannt,klappt aber trotzdem?-->
                <tr>
                    <td><?php echo $gericht['name']; ?></td>
                    <td><?php echo $gericht['preisIntern']; ?></td>
                    <td><?php echo $gericht['preisExtern']; ?></td>
                </tr>
                <tr> <!--Bilder werden nicht richtig angezeigt, weiß nicht woran es liegt, Pfad???-->
                    <td colspan="3"><img src="<?php echo $gericht['bild']; ?>" alt="<?php echo $gericht['name']; ?>" class="gerichtsbild"></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <h1 id="drei">E-Mensa in Zahlen</h1>
    <div class="Zahlen">
        <p class = "zahlenInhalt"><?php echo $besucher; ?> Besuche</p>
        <p class = "zahlenInhalt"><?php echo $anzahlAnmeldungen; ?> Anmeldungen Newsletter</p>
        <p class = "zahlenInhalt"><?php echo $anzahlGerichte; ?> Speisen</p>
    </div>

    <!--interesse geweckt, Formular-->

    <h1 id="vier">Interesse geweckt? Wir informieren Sie!</h1>

    <form method="post" action="index.php">
        <label for="anrede">Anrede:</label><br>
        <select name="anrede" id="anrede">
            <option value="Herr">Herr</option>
            <option value="Frau">Frau</option>
        </select><br><br>

        <label for="vorname">Vorname:</label><br>
        <input type="text" name="vorname" id="vorname" required><br><br>

        <label for="nachname">Nachname:</label><br>
        <input type="text" name="nachname" id="nachname" required><br><br>

        <label for="email">E-Mail:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <input type="checkbox" name="datenschutz" id="datenschutz" required>
        <label for="datenschutz">Ich stimme den Datenschutzbestimmungen zu</label><br><br>

        <input type="submit" value="Anmelden">
    </form>

    <?php
     foreach ($fehlermeldungen as $f) {
       echo  "<p style=\"color: red;\">" . $f . "</p>";
    }
    ?>

    <h1 id="fuenf">Das ist uns wichtig</h1>
    <ul>
        <li>Beste frische Saisonale Zutaten</li>
        <li>Ausgewogene abwechslungsreiche Gerichte</li>
        <li>Sauberkeit</li>
    </ul> <br>

    <h1 class="Ende">Wir freuen uns auf Ihren Besuch!</h1>
</main>

<hr>
<footer id="foot">
    <div class="footer_inhalt">(c) E-Mensa GmbH</div>
    <div class="footer_inhalt">Lara Devos, Lennox Bäcker</div>
    <div class="footer_inhalt impressum">Impressum</div>
</footer>
</body>

</html>