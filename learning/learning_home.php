<?php
    session_start();

    include('../global.php');

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");
    $course_query = "SELECT * FROM courses";
    $course_result = mysqli_query($connection, $course_query) or die(mysqli_error($connection));
    $table = "";

    if(mysqli_num_rows($course_result) > 0) {
        while($row = mysqli_fetch_array($course_result)) {
            $table .= "<tr>";
            $table .= "<td>{$row["name"]}</td>";
            $table .= "<td>{$row["description"]}</td>";
            $table .= "<td><a class='btn btn-danger' href='#'>BUY NOW</a></td>";
            $table .= "</tr>";
        }
    }

    mysqli_close($connection);
?>
<html>
    <head>
        <title>RiskWyse : Financial Learning</title>
        <link rel="stylesheet" href="<?php if (isset($css_path)) {
            echo $css_path;
        } ?>" />
        <script src="<?php if (isset($js_path)) {
            echo $js_path;
        } ?>"></script>
    </head>

    <body>

        <?php include('navbar.php'); ?>

        <div class="container w-50">
            <table class="table table-hover">
                <?php echo $table; ?>
            </table>
        </div>

    </body>
</html>
