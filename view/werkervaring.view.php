<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}
include "database/werkervaring.php"
?>

<html>
<head>
    <title>JJJ</title>
    <link href="../css/profileapp.css" rel="stylesheet" integrity="" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div id="welkom">
        <p>Work Experience of <?php echo $_SESSION["username"]; ?></p>
    </div>
    <nav>
        <div>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>" aria-current="page" href="/">Home</a>
            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/profile' ? 'active' : ''); ?>" aria-current="page" href="/profile">Profile</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>
</header>
<main>
    <section>
        <article>
            <h2>Work Experience</h2>
            <table>
                <tr>
                    <th>Company</th>
                    <th>Job Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($workExperiences as $experience) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($experience['company']); ?></td>
                        <td><?php echo htmlspecialchars($experience['job_title']); ?></td>
                        <td><?php echo convertToEuropeanDate($experience['start_date']); ?></td>
                        <td><?php echo convertToEuropeanDate($experience['end_date']); ?></td>
                        <td>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="edit_id" value="<?php echo $experience['id']; ?>">
                                <input type="submit" name="edit_experience" value="Edit">
                            </form>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $experience['id']; ?>">
                                <input type="submit" name="delete_experience" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php if (isset($_POST['edit_experience']) && $_POST['edit_id'] == $experience['id']) { ?>
                        <tr>
                            <td colspan="5">
                                <!-- Edit Experience Form -->
                                <form method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $experience['id']; ?>">
                                    <label for="edited_company">Company:</label>
                                    <input type="text" name="edited_company" value="<?php echo $experience['company']; ?>" required><br>
                                    <label for="edited_job_title">Job Title:</label>
                                    <input type="text" name="edited_job_title" value="<?php echo $experience['job_title']; ?>" required><br>
                                    <label for="edited_start_date">Start Date:</label>
                                    <input type="date" name="edited_start_date" value="<?php echo $experience['start_date']; ?>" required><br>
                                    <label for="edited_end_date">End Date:</label>
                                    <input type="date" name="edited_end_date" value="<?php echo $experience['end_date']; ?>" required><br>
                                    <input type="submit" name="submit_edit" value="Submit Edit">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
            <h2>Add New Work Experience</h2>
            <form method="post">
                <label for="company">Company:</label>
                <input type="text" name="company" required><br>
                <label for="job_title">Job Title:</label>
                <input type="text" name="job_title" required><br>
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" required><br>
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" required><br>
                <input type="submit" name="add_experience" value="Add">
            </form>
        </article>
    </section>
</main>
<footer>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>" aria-current="page" href="/">Home</a>
    <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/profile' ? 'active' : ''); ?>" aria-current="page" href="/profile">Profile</a>
    <a href="/logout">Logout</a>
</footer>
</body>
</html>