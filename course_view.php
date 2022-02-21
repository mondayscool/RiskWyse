<?php
    session_start();

    $course_id = filter_input(INPUT_GET, 'course_id');

    $user_id = $_SESSION["user_id"];
    $f_name = $_SESSION["f_name"];
    $l_name = $_SESSION["l_name"];

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");

    $course_info_query = "SELECT * FROM courses WHERE ID=${course_id};";
    $course_info_result = mysqli_query($connection, $course_info_query) or die(mysqli_error($connection));

    $course_info_array = mysqli_fetch_array($course_info_result);
    $course_name = $course_info_array["name"];
    $course_description = $course_info_array["description"];

    $course_videos_query = "SELECT * FROM videos WHERE course_id=${course_id}; ";
    $videos_result = mysqli_query($connection, $course_videos_query) or die(mysqli_error($connection));

    $table = "";
    if(mysqli_num_rows($videos_result) > 0) {
        while($row = mysqli_fetch_array($videos_result)) {
            $table .= "<tr>";
            $table .= "<td>${row["title"]}</td>";
            $table .= "<td>${row["description"]}</td>";
            $table .= "<td><a class='btn btn-primary' href='video_view.php?course_id=${course_id}&video_id=${row["ID"]}'>WATCH NOW</a></td>";
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
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>

        </nav>

        <div class="container w-50 mt-4 mb-4">
            <a class="btn btn-secondary" href="user_dashboard.php"><< Back</a>
            <h1 class="text-primary"><?php echo $course_name; ?></h1>
            <div class="container">
                <?php echo $course_description; ?>
            </div>

            <table class="table table-hover">
                <thead>
                    <th class="w-25">Module Title</th>
                    <th>Module Description</th>
                </thead>
                <tbody>
                    <?php echo $table; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>