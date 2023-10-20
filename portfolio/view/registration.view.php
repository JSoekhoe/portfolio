<html>
<head>
    <title>JJJ</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous">
</head>
<body>
<header>
    <div id=welkom>
        <p>Login</p>
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
        <div>
            <form action="../database/registration.php" method="post">
                Name: <input type="text" name="name"><br>
                Lastname: <input type="text" name="lastname"><br>
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit" value="Register">
            </form>
        </div>
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