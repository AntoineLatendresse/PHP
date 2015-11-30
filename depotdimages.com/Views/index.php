<?php
include_once("../Controller/functions.php");
showHeader();
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>All your photos organized and easy to find</title>
    <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>

<div class="wrap">
    <h1>Your photos: </h1>
    <?php
    getImages();
    ?>
</div>
<div class="wrap">
    <h1>Upload your photos: </h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image"/>
        <input class="button" type="submit" value="Upload Image" name="upload_img" />
    </form>
</div>
<div class="wrap">
<form action="" method="post">
    <h1>Delete your photos: </h1>
    <input type="text" name="filename" title=""/>
    <input type="submit" value="Delete Image" name="delete_img"/>
</form>
</div>
</body>
</html>
<?php
showFooter();
?>