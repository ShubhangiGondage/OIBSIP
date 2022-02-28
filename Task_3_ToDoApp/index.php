<?php
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Antique&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2 id="title" style="color: white; margin-left: 43%; margin-top:8px;">To-Do list Application</h2>


    <!-- filters section -->
    <div class="filter-list">
        <center><br>
            <form method="POST" name="index.php">
                <input type="submit" name="done" value="Show Done">
                <input type="submit" name="pending" value="Show Pending">
                <input type="submit" name="clear" value="Clear Filter">
            </form>
        </center>
    </div>

    <div class="main-section">

        <div class="add-section">
            <!-- created the form -->
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                    <input type="text" name="title" style="border-color: #ff6666" placeholder="This field is required" />
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>

                <?php } else { ?>
                    <input type="text" name="title" placeholder="What do you need to do?" />
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php } ?>
            </form>
        </div>
        <?php
        $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>

        <!-- Fillters section -->
        <?php

        if (isset($_POST['done'])) {
            $todos = $conn->query("SELECT * FROM todos WHERE checked = '1' ORDER BY id ASC");
        } elseif (isset($_POST['pending'])) {

            $todos = $conn->query("SELECT * FROM todos WHERE checked = 0 ORDER BY id ASC");
        } elseif (isset($_POST['clear'])) {

            $todos = $conn->query("SELECT * FROM todos ORDER BY id ASC");
        } else {
            $todos = $conn->query("SELECT * FROM todos ORDER BY id ASC");
        }
        ?>

        <!-- todo section -->
        <div class="show-todo-section">
            <?php if ($todos->rowCount() <= 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>

                <div class="todo-item">
                    <!-- setting the id as a todo's id -->

                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                    <?php if ($todo['checked']) { ?>
                        <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                        <!-- printing the title -->
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php } else { ?>
                        <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>

                    <!-- setting the data_time -->

                    <small>created: <?php echo $todo['date_time'] ?></small>
                </div>
            <?php } ?>


        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>


</body>

</html>