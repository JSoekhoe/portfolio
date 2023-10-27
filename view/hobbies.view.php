<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
} include "database/hobbies.php"
?>
<html>
<head>
    <title>Your Page Title</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div id="welkom">
        <p>Hobby's van <?php echo $_SESSION["username"]; ?></p>
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
            <form method="post">
                <input type="text" name="new_hobby" placeholder="Enter a new hobby">
                <input type="submit" name="add_hobby" value="Add Hobby">
            </form>
            <ul>
                <?php
                foreach ($hobbies as $hobby) {
                    echo "<li>" . htmlspecialchars($hobby['hobby_name']);

                    // Add an edit and delete form for each hobby
                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='text' name='edited_hobby_name' placeholder='Edit hobby'>";
                    echo "<input type='hidden' name='edit_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "<input type='submit' name='edit_hobby' value='Edit'>";
                    echo "</form>";

                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='hidden' name='delete_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "<input type='submit' name='delete_hobby' value='Delete'>";
                    echo "</form>";
                }
                ?>
            </ul>
        </article>
        <article></article>
    </section>
</main>
<footer>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
       aria-current="page" href="/">Home</a>
    <a class "nav-link <?= ($_SERVER['REQUEST_URI'] == '/profile' ? 'active' : ''); ?>"
    aria-current="page" href="/profile">Profiel</a>
    <a href="/logout">Logout</a>
</footer>
</body>
</html>