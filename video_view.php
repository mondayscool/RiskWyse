<?php
    session_start();

    $course_id = filter_input(INPUT_GET, 'course_id');
    $video_id = filter_input(INPUT_GET, 'video_id');

    $user_id = $_SESSION["user_id"];
    $f_name = $_SESSION["f_name"];
    $l_name = $_SESSION["l_name"];

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");

    $course_name_query = "SELECT name FROM courses WHERE ID=${course_id};";
    $course_name_result = mysqli_query($connection, $course_name_query) or die(mysqli_error($connection));

    $course_name_array = mysqli_fetch_array($course_name_result);
    $course_name = $course_name_array["name"];

    $video_query = "SELECT * FROM videos WHERE ID=${video_id};";
    $video_result = mysqli_query($connection, $video_query) or die(mysqli_error($connection));

    $video_result_array = mysqli_fetch_array($video_result);
    $video_title = $video_result_array["title"];
    $video_description = $video_result_array["description"];
    $video_url = $video_result_array["url"];
    $video_seq_num = $video_result_array["seq_num"];

    $pieces = explode("/", $video_url);
    $vimeo_id_1 = $pieces[3];
    $vimeo_id_2 = $pieces[4];

    $course_videos_query = "SELECT * FROM videos WHERE course_ID=${course_id} AND NOT id = ${video_id};";
    $course_videos_result = mysqli_query($connection, $course_videos_query) or die(mysqli_error($connection));

    $table = "";
    if(mysqli_num_rows($course_videos_result) > 0) {
        while($row = mysqli_fetch_array($course_videos_result)) {
            $table .= "<tr>";
            $table .= "<td>${row["seq_num"]}: <a class='link-primary' href='video_view.php?course_id=${course_id}&video_id=${row["ID"]}'>${row["title"]}</a></td>";
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
            <a class="btn btn-secondary" href="course_view.php?course_id=<?php echo $course_id; ?>"><< Back</a>
            <div class="row">
                <div class="col-9">
                    <h1 class="text-primary"><?php echo $course_name; ?></h1>
                    <h4 class="text-secondary"><?php echo $video_seq_num.": ".$video_title; ?></h4>
                    <div class="container">
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php echo $vimeo_id_1; ?>?h=<?php echo $vimeo_id_2; ?>&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="2022-02-11 20-36-35"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                        <div>
                            <?php echo $video_description; ?>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    Up next...
                    <table class="table table-hover">
                        <?php echo $table; ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
