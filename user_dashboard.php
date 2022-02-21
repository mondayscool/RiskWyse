<?php
    session_start();

    include('auth_check.php');

    $user_id = $_SESSION["user_id"];
    $f_name = $_SESSION["f_name"];
    $l_name = $_SESSION["l_name"];

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");
    $user_courses_query = "SELECT c.id, c.name, c.description FROM user_courses uc, courses c WHERE uc.course_ID = c.ID AND uc.user_ID=${user_id};";
    $course_result = mysqli_query($connection, $user_courses_query) or die(mysqli_error($connection));

    $table = "";
    if(mysqli_num_rows($course_result) > 0) {
        while($row = mysqli_fetch_array($course_result)) {
            $table .= "<tr>";
            $table .= "<td>${row["name"]}</td>";
            $table .= "<td>${row["description"]}</td>";
            $table .= "<td><a class='btn btn-primary' href='course_view.php?course_id=${row["id"]}'>WATCH NOW</a></td>";
            $table .= "</tr>";
        }
    }

    mysqli_close($connection);
?>
<html>
    <head>
        <title>RiskWyse : Financial Learning</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg bg-secondary">

            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="learning_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <?php
                    if(!isset($_SESSION["user_id"])) {
                        echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
                    }
                    ?>
                </ul>
            </div>

        </nav>

        <div class="container w-50 mt-4 mb-4">
            Welcome, <?php echo $f_name; ?>

            <table class="table table-hover">
                <thead>
                    <th class="w-25">Course Name</th>
                    <th>Course Description</th>
                </thead>
                <tbody>
                    <?php echo $table; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

