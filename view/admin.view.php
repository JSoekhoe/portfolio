<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}
include "database/admin.php"
?>
<html>
<head>
    <title>JJJ</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div id="welkom">
        <p>Welkom Admin</p>
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
            <table>
                <tr>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo ($user['is_enabled'] == 1) ? 'Enabled' : 'Disabled'; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                <input type="submit" name="action" value="enable" <?php echo ($user['is_enabled'] == 1) ? 'disabled' : ''; ?>>
                                <input type="submit" name="action" value="disable" <?php echo ($user['is_enabled'] == 0) ? 'disabled' : ''; ?>>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </article>
    </section>
</main>
<footer>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>"
       aria_current="page" href="/">Home</a>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/profile' ? 'active' : ''); ?>"
       aria_current="page" href="/profile">Profiel</a>
    <a href="/logout">Logout</a>
</footer>
</body>
</html>