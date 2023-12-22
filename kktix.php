<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>XMLHttpRequest</title>
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="stylesheet" href="./plugin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    $json = file_get_contents("kktix.json");
    $kktix = json_decode($json);
    // echo "<pre>";
    // print_r($kktix);
    // echo "</pre>";
    echo "<h4>" . $kktix->title . "</h4>";
    echo "<div>" . $kktix->updated . "</div>";
    echo "<ul class='list-group'>";
    foreach ($kktix->entry as $event) {
        echo "<li class='list-group-item list-group-item-action'>";
        echo "<div>" . $event->title . "</div>";
        echo "<div>" . $event->summary . "</div>";
        echo "<div>" . $event->content . "</div>";
        echo "</li>";
    }
    echo "</ul>";

    ?>
    <script src="./plugin/js/jquery.js"></script>
    <script src="./plugin/js/bootstrap.js"></script>
</body>

</html>