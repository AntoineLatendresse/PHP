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
    $repertoire = "upload/";

    $fichiers = scandir($repertoire);

    if ($fichiers !== FALSE)
    {
        for ($i = 0; $i < sizeof($fichiers); $i++)
        {
            $nomFichier = $fichiers[$i];
            if ($nomFichier[0] != ".")
            {
                echo $nomFichier . "width=\"800\" height=\"600\" <br>";
            }
        }
    }
    else
    {
        die("Erreur: repertoire invalide");
    };
    ?>
<h1>Upload your photos: </h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
            <input class="button" type="submit" value="Upload" />
        </form>
</div>
</body>
</html>