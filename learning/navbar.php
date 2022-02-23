<?php
    echo "<nav class='navbar navbar-expand-lg bg-secondary'>";
        echo "<div class='container-fluid'>";
            echo "<ul class='navbar-nav'>";
                echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='learning_home.php'>Home</a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='#'>About</a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                    if(!isset($_SESSION["user_id"])) {
                        echo "<a class='nav-link' href='login.php'>Login</a>";
                    } else {
                        echo "<a class='nav-link' href='logout.php'>Logout</a>";
                    }
                echo "</li>";
            echo "</ul>";
        echo "</div>";
    echo "</nav>";
