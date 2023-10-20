<?php session_start();
if (!isset($_SESSION["user_id"])) {
header("Location: login.view.php"); // Redirect to the login page if not logged in
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
        <p>Welcome, <?php echo $_SESSION["username"]; ?></p>
    </div>
    <nav>
        <div>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
               aria-current="page" href="/">Home</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/dashboard' ? 'active' : ''); ?>"
               aria-current="page" href="/dashboard">Dashboard</a>
            <a href="../database/logout.php">Logout</a>
        </div>
    </nav>
</header>
<main>
    <section>
        <article>.</article>
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