<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>All your photos organized and easy to find</title>
    <link href="style.css" rel="stylesheet" media="all" type="text/css">
</head>

<body>
<div class="wrap">
    <?php
    $image_types = array(
        'gif' => 'image/gif',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
    );
    $dir = "images/";
    foreach (scandir('images') as $entry) {
        if (!is_dir($entry)) {
            if (in_array(mime_content_type('images/'. $entry), $image_types)) {
                // do something with image
                echo "<img src='$dir$entry' width='600px'/>";
            }
        }
    }
    ?>
<h1>Upload your photos: </h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" id="files">
            <input class="button" type="submit" value="Upload" />
        </form>
</div>
</body>
</html>