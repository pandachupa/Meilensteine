<?php
include 'gerichte_array.php';
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
                    <td colspan="3"><img src="werbeseite/<?php echo $gericht['bild']; ?>" alt="<?php echo $gericht['name']; ?>" class="gerichtsbild"></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <h1 id="drei">E-Mensa in Zahlen</h1>
    <div class="Zahlen">
        <p>x Besuche</p>
        <p>y Anmeldungen Newsletter</p>
        <p>z Speisen</p>
    </div>

    <!--interesse geweckt, Formular-->

    <h1 id="vier">Interesse geweckt? Wir informieren Sie!</h1>

    <form>
        <label for="name"> Ihr Name: </label><br>
        <input type="text" id="name" name="name" required> <br><br>

        <label for="email"> Ihre Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sprache"> Sprache wählen:</label><br>
        <select id="sprache" name="sprache">
            <option value="englisch"> Englisch</option>
            <option value="deutsch"> Deutsch</option>
            <option value="französisch"> Französisch</option>


        </select> <br><br>

        <input type="checkbox" id="datenschutz" name="datenschutz" required>
        <label for="datenschutz"> Den Datenschutzbestimmungen stimme ich zu</label><br>
        <input type="submit" value="Zum Newsletter anmelden">

    </form>


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
    <div class="footer_inhalt">Lara Devos, Kyra Becker</div>
    <div class="footer_inhalt impressum">Impressum</div>
</footer>
</body>

</html>