<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}
?>
<html>
<head>
    <title>JJJ</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div id=welkom>
        <p>Profiel van <?php echo $_SESSION["username"]; ?></p>
    </div>
    <nav>
        <div>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
               aria-current="page" href="/">Home</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/profile' ? 'active' : ''); ?>"
               aria-current="page" href="/profile">Profiel</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>
</header>
<main>
    <section>
        <article>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/schoolprestaties' ? 'active' : ''); ?>"
                    aria-current="page" href="/schoolprestaties">Schoolprestaties</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/hobbies' ? 'active' : ''); ?>"
               aria-current="page" href="/hobbies">Hobby's</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/werkervaring' ? 'active' : ''); ?>"
               aria-current="page" href="/werkervaring">Werkervaring</a>
        </article>
    </section>
</main>
<footer>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
       aria-current="page" href="/">Home</a>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/profile' ? 'active' : ''); ?>"
       aria-current="page" href="/profile">Profiel</a>
    <a href="/logout">Logout</a>
</footer>
</body>
</html>