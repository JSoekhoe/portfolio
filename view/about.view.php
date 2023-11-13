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
        <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/login' ? 'active' : ''); ?>"
           aria-current="page" href="/login">Login</a>
        <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about' ? 'active' : ''); ?>"
           aria-current="page" href="/about">About</a>
    </nav>
</header>
<main>
    <section>
        <h1>Welkom op de portfoliopage van Tripple J</h1>
        <br></br>
        <p> Deze pagina is bedoeld om te laten zien wie Tripple J nou eigenlijk is en wie erachter zit</p>
        <p>Ons groepje bestaat uit 3 jonge en ambititeuze mannen. Wij volgen de opleiding AD Softwaredevelopment aan Windesheim.</p>
        <P> Onze naam komt voor uit het feit dat onze namen allemaal beginnen met een J, verder zullen wij ons in het kort individueel voorstellen. </p>
        <br> </br>
        <h3> Jeremy Kenton</h3>
        <br></br>
        <p> Ik ben een 23 jarige jongen uit Amsterdam, in mijn vrije tijd bevind ik me 9 van de 10 keer</p>
        <p> in de sportschool. Natuurlijk hou ik ook van lekker eten, mijn favoriete gerechten zouden toch wel uit </p>
        <p> de Marokkaanse keuken komen. Ik heb voor de opleiding AD Software development gekozen, omdat ik dit zeer interessant vind om te leren.</p>
        <p> In de twee jaar van deze opleiding hoop ik veel kennis op te doen en te ontwikkelen tot een top progammeur! </p>

        <h3> Joerie Soekhoe</h3>
        <p> Mijn naam is Joerie Soekhoe, ik ben 21 jaar oud en ik ben een eerstejaars student</p>
        <p> aan de hogeschool Windesheim. Aan de windesheim volg ik de AD software development</p>

        <h3>Jayrobbiene Hooker </h3>

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