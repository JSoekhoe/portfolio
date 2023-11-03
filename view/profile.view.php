<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}
?>
<html>
<head>
    <title>Your Profile</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div id="welkom">
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

<!-- Add a Delete button with a confirmation dialog -->
<section>
    <article>
        <button id="deleteProfileButton">Delete Profile</button>
    </article>
</section>

<script>
    // JavaScript code to show a confirmation dialog when the Delete button is clicked
    document.getElementById("deleteProfileButton").addEventListener("click", function() {
        if (confirm("Are you sure you want to delete your profile? This action cannot be undone.")) {
            // Redirect to the PHP script that handles the profile deletion
            window.location.href = "database/profile.php";
        }
    });
</script>

</body>
</html>
