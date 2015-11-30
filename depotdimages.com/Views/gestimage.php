<?php
include_once("../Controller/functions.php");
showHeader();
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>All your photos organized and easy to find</title>
        <link href="../css/style.css" rel="stylesheet" media="all" type="text/css">
    </head>

    <body>
    <div class="wrap">
        <h1>Upload your photos: </h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" id="files">
            <input class="button" type="submit" value="Upload" />
        </form>
    </div>
    </body>
    </html>
<?php
showFooter();