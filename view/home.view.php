<html>
    <head>
        <title>JJJ</title>
        <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
    </head>
    <body>
        <header>
            <div id=welkom>
                <p>Welkom Bij De ProfileAPP van Triple J</p>
            </div>
            <nav>
                <div>
                    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
                       aria-current="page" href="/">Home</a>
                    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/login' ? 'active' : ''); ?>"
                       aria-current="page" href="/login">Login</a>
                    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about' ? 'active' : ''); ?>"
                       aria-current="page" href="/about">About</a>
                </div>
            </nav>
        </header> 
        <main>
            <section>
                <article>In deze ProfileApp gaan wij gebruikers helpen met het bijhouden van hun prestatievoortgang.</article>
            </section>
        </main>
        <footer>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
               aria-current="page" href="/">Home</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/login' ? 'active' : ''); ?>"
               aria-current="page" href="/login">Login</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about' ? 'active' : ''); ?>"
               aria-current="page" href="/about">About</a>
        </footer>
    </body>
 </html>