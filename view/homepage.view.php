<html>
    <head>
        <title>JJJ</title>
        <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
    </head>
    <body>
        <header>
            <div id=welkom>
                <p>Welkom Bij De Portfolio van Triple J</p>
            </div>
            <nav>
                <div>
                    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
                    aria-current="page" href="/">Home</a>
                    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/opdrachten' ? 'active' : ''); ?>"
                       aria-current="page" href="/opdrachten">Opdrachten</a>
                    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about' ? 'active' : ''); ?>"
                       aria-current="page" href="/about">About</a>
                </div>
            </nav>
        </header> 
        <main>
            <section>
                <p> <?php
                    echo "<table>";
                    foreach ($users as $user) {

                        echo "<tr>";
                        echo "<td>" . $user['username'] . "</td>
                          <td>" . "<a href='portfolio/homepage.php?id=" . $user['id'] . "'>hobbies</a>" . "</td>
                          <td>" . "<a href='profiles.php?id=" . $user['id'] . "'>profile</a>" . "</td>";
                        echo "<tr>";
                    }
                    echo "</table>";
                    ?>
                </p>
                <article>In deze Portfolio staan onze opdrachten van AD Software Development.
                        Wij hebben op basis van al onze opdrachten een website gemaakt, hierdoor
                        kunnen we op een efficiënte manier laten zien wat wij hebben geprogrammeerd.
                </article>
            </section>
        </main>
        <footer>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
               aria-current="page" href="/">Home</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/opdrachten' ? 'active' : ''); ?>"
               aria-current="page" href="/opdrachten">Opdrachten</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about' ? 'active' : ''); ?>"
               aria-current="page" href="/about">About</a>
        </footer>
    </body>
 </html>