<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasze Restauracje</title>
    <link rel="stylesheet" href="../CSS/w_listarestauracji.css">
    <link rel="shortcut icon" type="x-icon" href="../IMG/HH_miniaturka.png">
</head>

<body>
    <header>
        <div>
            <a href="../w_main.html"><img src="../IMG/HH_logo.png" class="img1"></a>
        </div>
        <nav id="topnav">
            <ul class="menu">
                <li><a href="w_register.php">Rejestracja</a></li>
                <li><a href="w_login.php">Logowanie</a></li>
                <li><a href="w_listarestauracji.php">Lista dostępnych restauracji oraz sklepów</a></li>
                <li><a href="w_menu.php">Sklep</a></li>
                <div class="ec-cart-widget"></div>
                <div>
                    <script data-cfasync="false" type="text/javascript"
                        src="https://app.ecwid.com/script.js?88109711&data_platform=code&data_date=2023-06-03"
                        charset="utf-8"></script>
                    <script type="text/javascript">Ecwid.init();</script>
                </div>
            </ul>

        </nav>
    </header><br>
    <div class="lista">
        <ul class="lista">
            <?php
            // definiuje dane restauracji
            $restaurants = array(
                array(
                    'name' => 'McDonald\'s',
                    'description' => 'McDonald\'s to międzynarodowa sieć restauracji fast-food, znana z hamburgerek i frytek.',
                    'partnership' => 'Współpracujemy z McDonald\'s, aby zapewnić naszym klientom smaczne i szybkie posiłki.',
                    'redirect_url' => 'http://localhost/Project/PHP/w_menu.php#!/BigMac/p/561061549/category=0'
                ),
                array(
                    'name' => 'Pasibus',
                    'description' => 'Pasibus to popularna sieć restauracji specjalizujących się w pysznych burgerach.',
                    'partnership' => 'Jesteśmy partnerem Pasibus, aby oferować naszym klientom niezwykle smaczne i oryginalne burgery.',
                    'redirect_url' => 'http://localhost/Project/PHP/w_menu.php#!/Burger-Awokadus/p/561052592/category=0'
                ),
                array(
                    'name' => 'Pizza Hut',
                    'description' => 'Pizza Hut to światowa sieć pizzerii, znana z szerokiego wyboru pysznych pizz.',
                    'partnership' => 'Współpracujemy z Pizza Hut, aby dostarczać naszym klientom różnorodne i smaczne opcje pizz.',
                    'redirect_url' => 'http://localhost/Project/PHP/w_menu.php#!/Srednia-pizza/p/561074019/category=0'
                ),
                array(
                    'name' => 'KFC',
                    'description' => 'KFC to globalna sieć restauracji serwujących smaczne kurczaki i inne potrawy fast-food.',
                    'partnership' => 'Jesteśmy partnerem KFC, aby zapewnić naszym klientom wyjątkowe smaki i aromaty kuchni amerykańskiej.',
                    'redirect_url' => 'http://localhost/Project/PHP/w_menu.php#!/Kebab/p/560969231/category=0'
                )
            );

            foreach ($restaurants as $restaurant) {
                echo '<li onclick="window.location.href=\'' . $restaurant['redirect_url'] . '\'">';
                echo '<h2>' . $restaurant['name'] . '</h2>';
                echo '<p>' . $restaurant['description'] . '</p>';
                echo '<p><strong>Współpraca:</strong> ' . $restaurant['partnership'] . '</p>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
    <div class="menu3">
        <h2 id="n1">Popularne kategorie</h2>
        <ul class="menu4">
            <li><a href="http://localhost/Project/PHP/w_menu.php#!/Inne-dania/c/151140661">Kebab</a></li>
            <li><a href="http://localhost/Project/PHP/w_menu.php#!/Burgery/c/151135768">Burgery</a></li>
            <li><a href="http://localhost/Project/PHP/w_menu.php#!/Inne-dania/c/151140661">Pizza</a></li>
            <li><a href="http://localhost/Project/PHP/w_menu.php#!/Inne-dania/c/151140661">Frytki</a></li>
        </ul>
    </div>
</body>

</html>
