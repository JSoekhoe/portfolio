<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /login"); // Redirect to the login page if not logged in
    exit();
}
include "database/hobbies.php";
?>

<html>
<head>
    <title>JJJ</title>
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
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="new_hobby" placeholder="Enter a new hobby">
                <input type="file" name="hobby_image">
                <input type="submit" name="add_hobby" value="Add Hobby">
            </form>
        </article>
        <article>
            <?php
            // Loop through the hobbies
            foreach ($hobbies as $hobby) {
                echo "<li>" . htmlspecialchars($hobby['hobby_name']);

                // Display the description if it exists
                if (!empty($hobby['hobby_description'])) {
                    echo "<p>Description: " . htmlspecialchars($hobby['hobby_description']) . "</p>";

                    // Add an edit description form
                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='text' name='edited_description' placeholder='Edit description'>";
                    echo "<input type='hidden' name='edit_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "<input type='submit' name='edit_description' value='Edit Description'>";
                    echo "</form>";

                    // Add a delete description form
                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='hidden' name='delete_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "<input type='submit' name='delete_description' value='Delete Description'>";
                    echo "</form>";
                } else {
                    // If there's no description, provide an option to add one
                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='text' name='new_description' placeholder='Add description'>";
                    echo "<input type='hidden' name='add_description_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "<input type='submit' name='add_description' value='Add Description'>";
                    echo "</form>";
                }

                // Display the current image if it exists
                if (!empty($hobby['image_data']) && !empty($hobby['image_type'])) {
                    $image_data = base64_encode($hobby['image_data']);
                    $image_type = $hobby['image_type'];
                    $src = "data:$image_type;base64,$image_data";
                    ?>
                    <img class="hobby-image" src='<?php echo $src; ?>' alt='<?php echo htmlspecialchars($hobby['hobby_name']); ?>'>
                    <?php
                }

                // Add an edit form for the hobby
                echo "<form method='post' style='display: inline;'>";
                echo "<input type='text' name='edited_hobby_name' placeholder='Edit hobby'>";
                echo "<input type='hidden' name='edit_id' value='" . $hobby['hobby_id'] . "'>";
                echo "<input type='submit' name='edit_hobby' value='Edit Hobby'>";
                echo "</form>";

                // Add a delete form for the hobby
                echo "<form method='post' style='display: inline;'>";
                echo "<input type='hidden' name='delete_id' value='" . $hobby['hobby_id'] . "'>";
                echo "<input type='submit' name='delete_hobby' value='Delete Hobby'>";
                echo "</form>";

                // If there is an associated image, add edit and delete buttons for the image
                if (!empty($hobby['image_data']) && !empty($hobby['image_type'])) {
                    echo "<form method='post' enctype='multipart/form-data' style='display: inline;'>";
                    echo "<input type='file' name='new_hobby_image' accept='image/*'>";
                    echo "<input type='submit' name='edit_image' value='Edit Image'>";
                    echo "<input type='hidden' name='edit_image_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "</form>";

                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='submit' name='delete_image' value='Delete Image'>";
                    echo "<input type='hidden' name='delete_image_id' value='" . $hobby['hobby_id'] . "'>";
                    echo "</form>";
                }
            }
            ?>
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