<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}
include "database/schoolprestaties.php"
?>

<html>
<head>
    <title>JJJ</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div id="welkom">
        <p>Schoolprestaties van <?php echo $_SESSION["username"]; ?></p>
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
                    <th>School Name</th>
                    <th>Study</th>
                    <th>Class</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($grades as $grade) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($grade['school_name']); ?></td>
                        <td><?php echo htmlspecialchars($grade['study']); ?></td>
                        <td><?php echo htmlspecialchars($grade['class']); ?></td>
                        <td><?php echo htmlspecialchars($grade['grade']); ?></td>
                        <td>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="edit_id" value="<?php echo $grade['school_id']; ?>">
                                <input type="submit" name="edit_grade" value="Edit">
                            </form>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $grade['school_id']; ?>">
                                <input type="submit" name="delete_grade" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php if (isset($_POST['edit_grade']) && $_POST['edit_id'] == $grade['school_id']) { ?>
                        <tr>
                            <td colspan="4">
                                <!-- Edit Grade Form -->
                                <form method="post">
                                    <input type="hidden" name="edit_school_id" value="<?php echo $grade['school_id']; ?>">
                                    <label for="edited_school_name">School Name:</label>
                                    <input type="text" name="edited_school_name" value="<?php echo htmlspecialchars($grade['school_name']); ?>"><br>

                                    <label for="edited_study">Study:</label>
                                    <input type="text" name="edited_study" value="<?php echo htmlspecialchars($grade['study']); ?>"><br>

                                    <label for="edited_class">Class:</label>
                                    <input type="text" name="edited_class" value="<?php echo htmlspecialchars($grade['class']); ?>"><br>

                                    <label for="edited_grade">Grade:</label>
                                    <input type="number" name="edited_grade" step="0.1" min="0" max="10.0" value="<?php echo $grade['grade']; ?>"><br>

                                    <input type="submit" name="submit_edit" value="Submit Edit">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </article>
    </section>
    <article>
        <!-- Form for adding a new grade -->
        <form method="post">
            <input type="text" name="school_name" placeholder="School Name">
            <input type="text" name="study" placeholder="Study">
            <input type="text" name="class" placeholder="Class">
            <input type="number" name="grade" step="0.1" min="0" max="10.0" placeholder="Grade">
            <input type="submit" name="add_grade" value="Add Grade">
        </form>
    </article>
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
