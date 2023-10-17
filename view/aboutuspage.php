<html>
    <head>
        <title>JJJ</title>
        <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <div id=welkom>
                <p>About Us</p>
            </div>
            <nav>
                <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
                   aria-current="page" href="/">Home</a>
                <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/opdrachten' ? 'active' : ''); ?>"
                   aria-current="page" href="/opdrachten">Opdrachten</a>
                <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about' ? 'active' : ''); ?>"
                   aria-current="page" href="/about">About</a>
            </nav>
        </header> 
        <main>
            <section>
                <p>Joerie</p>
                <article> (info Joerie) </article>
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
 